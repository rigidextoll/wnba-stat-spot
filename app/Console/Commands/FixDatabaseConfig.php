<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class FixDatabaseConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:fix-config {--force : Force configuration changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Diagnose and fix database configuration issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔧 Database Configuration Fixer');
        $this->newLine();

        // Check current configuration
        $this->checkCurrentConfig();

        // Test connections
        $this->testConnections();

        // Suggest fixes
        $this->suggestFixes();

        return 0;
    }

    private function checkCurrentConfig()
    {
        $this->info('📋 Current Configuration:');

        $defaultConnection = config('database.default');
        $this->line("  Default connection: {$defaultConnection}");

        $envConnection = env('DB_CONNECTION');
        $this->line("  Environment DB_CONNECTION: " . ($envConnection ?: 'not_set'));

        if ($defaultConnection !== $envConnection && $envConnection) {
            $this->warn("  ⚠️  Mismatch: config says '{$defaultConnection}' but env says '{$envConnection}'");
        }

        // Show all environment variables
        $this->line('  Environment variables:');
        $envVars = [
            'DB_CONNECTION' => env('DB_CONNECTION'),
            'DB_HOST' => env('DB_HOST'),
            'DB_PORT' => env('DB_PORT'),
            'DB_DATABASE' => env('DB_DATABASE'),
            'DB_USERNAME' => env('DB_USERNAME'),
            'DB_PASSWORD' => env('DB_PASSWORD') ? '***set***' : 'not_set'
        ];

        foreach ($envVars as $key => $value) {
            $status = $value ? '✅' : '❌';
            $this->line("    {$status} {$key}: " . ($value ?: 'not_set'));
        }

        $this->newLine();
    }

    private function testConnections()
    {
        $this->info('🔍 Testing Database Connections:');

        // Test default connection
        try {
            DB::connection()->getPdo();
            $this->line('  ✅ Default connection: OK');
        } catch (\Exception $e) {
            $this->line('  ❌ Default connection: FAILED');
            $this->line('    Error: ' . substr($e->getMessage(), 0, 100) . '...');

            if (str_contains($e->getMessage(), 'database.sqlite')) {
                $this->warn('    🔍 This is a SQLite error - likely configuration issue');
            }
        }

        // Test PostgreSQL specifically
        try {
            DB::connection('pgsql')->getPdo();
            $this->line('  ✅ PostgreSQL connection: OK');
        } catch (\Exception $e) {
            $this->line('  ❌ PostgreSQL connection: FAILED');
            $this->line('    Error: ' . substr($e->getMessage(), 0, 100) . '...');
        }

        // Test SQLite (should fail in production)
        try {
            DB::connection('sqlite')->getPdo();
            $this->line('  ⚠️  SQLite connection: OK (but should not be used in production)');
        } catch (\Exception $e) {
            $this->line('  ✅ SQLite connection: FAILED (good for production)');
        }

        $this->newLine();
    }

    private function suggestFixes()
    {
        $this->info('💡 Suggested Fixes:');

        $defaultConnection = config('database.default');
        $envConnection = env('DB_CONNECTION');

        if ($defaultConnection === 'sqlite') {
            $this->warn('  1. Change default database connection from SQLite to PostgreSQL');
            $this->line('     - This has been fixed in config/database.php');
            $this->line('     - Ensure DB_CONNECTION=pgsql in your environment');
        }

        if (!$envConnection) {
            $this->error('  2. Set DB_CONNECTION environment variable');
            $this->line('     - Add DB_CONNECTION=pgsql to your Render environment');
        }

        if (!env('DB_HOST')) {
            $this->error('  3. Set database host environment variable');
            $this->line('     - Add DB_HOST to your Render environment');
        }

        if (!env('DB_DATABASE')) {
            $this->error('  4. Set database name environment variable');
            $this->line('     - Add DB_DATABASE to your Render environment');
        }

        if (!env('DB_USERNAME')) {
            $this->error('  5. Set database username environment variable');
            $this->line('     - Add DB_USERNAME to your Render environment');
        }

        if (!env('DB_PASSWORD')) {
            $this->error('  6. Set database password environment variable');
            $this->line('     - Add DB_PASSWORD to your Render environment');
        }

        // Check for localhost connection in production
        if (env('DB_HOST') === '127.0.0.1' || env('DB_HOST') === 'localhost') {
            $this->error('  7. Database host is set to localhost');
            $this->line('     - This will not work in production (Render)');
            $this->line('     - Render should provide the actual database host');
            $this->line('     - Check your Render database service configuration');
        }

        if (!env('DB_HOST')) {
            $this->error('  8. Database host not set - will default to localhost');
            $this->line('     - This will fail in production');
            $this->line('     - Render should auto-populate DB_HOST from database service');
        }

        $this->newLine();
        $this->info('🚀 Next Steps:');
        $this->line('  1. Ensure all environment variables are set in Render');
        $this->line('  2. Redeploy your application');
        $this->line('  3. Run: php artisan queue:health-check --verbose');
        $this->line('  4. Check queue worker logs: tail -f /tmp/laravel-queue.log');

        if ($this->option('force')) {
            $this->newLine();
            $this->info('🔄 Clearing configuration cache...');
            Artisan::call('config:clear');
            $this->line('  ✅ Configuration cache cleared');

            Artisan::call('config:cache');
            $this->line('  ✅ Configuration cache rebuilt');
        }
    }
}

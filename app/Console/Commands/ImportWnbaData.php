<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WnbaDataService;

class ImportWnbaData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-wnba-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import WNBA team schedule data';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting WNBA data import...');

        $service = new WnbaDataService();

        try {
            // Download and import team schedule data
            $this->info('Downloading team schedule data...');
            $teamSchedulePath = $service->downloadTeamScheduleData();
            $teamScheduleData = $service->parseTeamScheduleData($teamSchedulePath);
            $service->saveTeamScheduleData($teamScheduleData);
            $this->info('Team schedule data imported successfully.');

            // Download and import player box score data (contains player info)
            $this->info('Downloading player box score data...');
            $boxScorePath = $service->downloadBoxScoreData();
            $boxScoreData = $service->parseBoxScoreData($boxScorePath);
            $service->saveBoxScoreData($boxScoreData);
            $this->info('Player box score data imported successfully.');

        } catch (\Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
            return 1;
        }

        $this->info('WNBA data import completed successfully!');
        return 0;
    }
}

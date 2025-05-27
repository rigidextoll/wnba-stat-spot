#!/bin/sh

echo "🔍 Queue Monitoring Script"
echo "=========================="

# Function to show queue status
show_queue_status() {
    echo "📊 Queue Status:"
    echo "---------------"

    # Check if queue worker is running
    if pgrep -f "queue:work" > /dev/null; then
        echo "✅ Queue worker is running"
        echo "   PIDs: $(pgrep -f 'queue:work' | tr '\n' ' ')"
    else
        echo "❌ Queue worker is NOT running"
    fi

    # Show supervisord status
    echo ""
    echo "🔧 Supervisord Status:"
    if command -v supervisorctl > /dev/null; then
        supervisorctl status laravel-queue 2>/dev/null || echo "Cannot get supervisord status"
    else
        echo "supervisorctl not available"
    fi

    echo ""
}

# Function to show queue statistics
show_queue_stats() {
    echo "📈 Queue Statistics:"
    echo "-------------------"

    cd /var/www/html

    # Run health check
    php artisan queue:health-check 2>/dev/null || echo "Health check failed"

    echo ""
}

# Function to show recent logs
show_recent_logs() {
    echo "📋 Recent Queue Logs:"
    echo "--------------------"

    if [ -f "/tmp/laravel-queue.log" ]; then
        echo "Last 20 lines from queue log:"
        tail -20 /tmp/laravel-queue.log
    else
        echo "Queue log file not found"
    fi

    echo ""
    echo "Last 10 lines from supervisord log:"
    if [ -f "/tmp/supervisord.log" ]; then
        tail -10 /tmp/supervisord.log
    else
        echo "Supervisord log file not found"
    fi

    echo ""
}

# Function to show system resources
show_system_resources() {
    echo "💻 System Resources:"
    echo "-------------------"

    # Memory usage
    echo "Memory usage:"
    free -h 2>/dev/null || echo "free command not available"

    echo ""

    # Disk usage
    echo "Disk usage:"
    df -h / 2>/dev/null || echo "df command not available"

    echo ""

    # Process information
    echo "PHP processes:"
    ps aux | grep php | grep -v grep || echo "No PHP processes found"

    echo ""
}

# Function to restart queue worker
restart_queue() {
    echo "🔄 Restarting Queue Worker..."
    echo "-----------------------------"

    if command -v supervisorctl > /dev/null; then
        supervisorctl restart laravel-queue
        sleep 2
        supervisorctl status laravel-queue
    else
        echo "supervisorctl not available, trying manual restart..."
        pkill -f "queue:work"
        sleep 2
        echo "Queue processes killed, supervisord should restart them automatically"
    fi
}

# Function to clear failed jobs
clear_failed_jobs() {
    echo "🧹 Clearing Failed Jobs..."
    echo "-------------------------"

    cd /var/www/html
    php artisan queue:failed --json 2>/dev/null | head -5
    echo ""
    read -p "Clear all failed jobs? (y/N): " confirm
    if [ "$confirm" = "y" ] || [ "$confirm" = "Y" ]; then
        php artisan queue:flush
        echo "Failed jobs cleared"
    else
        echo "Cancelled"
    fi
}

# Main menu
while true; do
    echo ""
    echo "🎛️  Queue Monitor Menu:"
    echo "1) Show queue status"
    echo "2) Show queue statistics"
    echo "3) Show recent logs"
    echo "4) Show system resources"
    echo "5) Restart queue worker"
    echo "6) Clear failed jobs"
    echo "7) Run full diagnostic"
    echo "8) Exit"
    echo ""
    read -p "Choose an option (1-8): " choice

    case $choice in
        1) show_queue_status ;;
        2) show_queue_stats ;;
        3) show_recent_logs ;;
        4) show_system_resources ;;
        5) restart_queue ;;
        6) clear_failed_jobs ;;
        7)
            show_queue_status
            show_queue_stats
            show_recent_logs
            show_system_resources
            ;;
        8)
            echo "Goodbye!"
            exit 0
            ;;
        *)
            echo "Invalid option. Please choose 1-8."
            ;;
    esac
done

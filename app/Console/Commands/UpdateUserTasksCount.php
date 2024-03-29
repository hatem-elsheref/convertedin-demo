<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateUserTasksCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:update-user-tasks-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update The Total Count Of Tasks For Each User';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $lastCheck = cache()->get('statistics_last_check');



        cache()->put('statistics_last_check', now());
    }
}

<?php

namespace App\Jobs;

use App\Models\Statistics;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class UpdateUsersTotalCount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;
    private $total;

    /**
     * Create a new job instance.
     */
    public function __construct($user, $total = null)
    {
        $this->user  = $user;
        $this->total = $total ? $total : $user->total;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Statistics::query()->updateOrCreate(['user_id' => $this->user->id], [
            'total_tasks' => $this->total
        ]);
    }
}

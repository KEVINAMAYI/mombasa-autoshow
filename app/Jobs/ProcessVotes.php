<?php

namespace App\Jobs;

use App\Events\VotesProcessed;
use App\Models\Vote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessVotes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transactionId;
    protected $userId;
    protected $vehicleId;
    protected $votes;

    /**
     * Create a new job instance.
     */
    public function __construct($transactionId, $userId, $vehicleId, $votes)
    {
        $this->transactionId = $transactionId;
        $this->userId = $userId;
        $this->vehicleId = $vehicleId;
        $this->votes = $votes;
    }

    public function handle()
    {
        $voteData = [];

        for ($i = 1; $i <= $this->votes; $i++) {
            $voteData[] = [
                'transaction_id' => $this->transactionId,
                'user_id' => $this->userId,
                'vehicle_id' => $this->vehicleId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Vote::insert($voteData);

        //dispatch event
        broadcast(new VotesProcessed($this->userId, $this->vehicleId));

    }
}

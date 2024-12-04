<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\Vote;

class UpdateVotesBasedOnTransactions extends Command
{
    protected $signature = 'votes:update'; // Name of the command
    protected $description = 'Update votes based on transaction amount every 30 minutes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $transactions = Transaction::all();

        foreach ($transactions as $transaction) {
            $votes = floor(round($transaction->amount, 2) / 50);
            $existingVotesCount = Vote::where('transaction_id', $transaction->id)
                ->where('vehicle_id', $transaction->vehicle_id)
                ->count();

            $votesToInsert = $votes - $existingVotesCount;

            if ($votesToInsert > 0) {
                // Insert new votes
                $voteData = [];
                for ($i = 1; $i <= $votesToInsert; $i++) {
                    $voteData[] = [
                        'transaction_id' => $transaction->id,
                        'user_id' => $transaction->user_id,
                        'vehicle_id' => $transaction->vehicle_id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }

                Vote::insert($voteData);
                $this->info("Updated {$votesToInsert} votes for transaction ID {$transaction->id}");
            } elseif ($votesToInsert < 0) {
                // Delete excess votes
                $votesToDelete = abs($votesToInsert);
                Vote::where('transaction_id', $transaction->id)
                    ->where('vehicle_id', $transaction->vehicle_id)
                    ->orderBy('created_at', 'desc')
                    ->take($votesToDelete)
                    ->delete();

                $this->info("Deleted {$votesToDelete} votes for transaction ID {$transaction->id}");
            } else {
                $this->info("No updates needed for transaction ID {$transaction->id}");
            }
        }

        $this->info('Votes updated successfully.');
    }
}

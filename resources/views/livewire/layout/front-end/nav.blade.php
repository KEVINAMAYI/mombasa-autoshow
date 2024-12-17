<?php

use App\Livewire\Actions\Logout;
use App\Models\Transaction;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Volt\Component;

new class extends Component {

    use LivewireAlert;

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout)
    {
        $logout();
        return redirect()->route('front-end.index');
    }

    public function refreshVotes()
    {
        DB::beginTransaction();

        try {
            // Fetch all completed transactions
            $transactions = Transaction::where('status', 'completed')->get();

            foreach ($transactions as $transaction) {
                $votesFromTransaction = floor($transaction->amount / 50);

                $existingVotesCount = Vote::where('transaction_id', $transaction->id)
                    ->count();

                $votesToInsert = $votesFromTransaction - $existingVotesCount;

                // Insert votes if necessary
                if ($votesToInsert > 0) {
                    $voteData = [];
                    for ($i = 1; $i <= $votesToInsert; $i++) {
                        $voteData[] = [
                            'transaction_id' => $transaction->id,
                            'user_id' => auth()->user()->id,
                            'vehicle_id' => $transaction->vehicle_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    Vote::insert($voteData);
                }

                // Delete excess votes if necessary
                if ($votesToInsert < 0) {
                    $votesToDelete = abs($votesToInsert);
                    Vote::where('transaction_id', $transaction->id)
                        ->where('vehicle_id', $transaction->vehicle_id)
                        ->orderBy('created_at', 'desc')
                        ->take($votesToDelete)
                        ->delete();
                }
            }

            DB::commit();
            $this->alert('success', 'Votes Refreshed successfully!.');


        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', 'An Error occurred while Refreshing the Votes!.');
        }
    }


}; ?>
@push('css')
    <style>
        #verify-btn:hover {
            color: white !important;
        }
    </style>
@endpush
<div id="main-menu">
    <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('front-end.index') }}">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front-end.about') }}">ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front-end.car-awards') }}">CAR OF THE YEAR</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('front-end.contactus') }}">CONTACT US</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                MY ACCOUNT
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                                @if (!auth()->user()->hasVerifiedEmail())
                                    <li>
                                        <div class="alert alert-warning" style="margin: 10px; font-size: 14px;">
                                            Your account is not verified. <a id="verify-btn"
                                                                             class="btn mt-3 btn-md btn-outline-warning text-warning"
                                                                             href="{{ route('verification.notice') }}">Verify
                                                Now</a>
                                        </div>
                                    </li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('front-end.my-profile') }}">My
                                            Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('front-end.car-awards') }}">Car of the
                                            year</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('front-end.my-votes') }}">My Votes</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ route('front-end.my-transactions') }}">My
                                            Transactions</a></li>
                                    <!--====== for super admins view only =========-->
                                    @if(auth()->user()->is_admin)
                                        <li><a class="dropdown-item" href="{{ route('front-end.results') }}">Voting
                                                Results</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('front-end.transactions') }}">All
                                                Transactions</a></li>
                                        <li><a class="dropdown-item" href="{{ route('front-end.vehicles') }}">All
                                                Vehicles</a>
                                        </li>
                                        <li><a class="dropdown-item" href="{{ route('front-end.users') }}">All Users</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('front-end.audit-logs') }}">
                                                Reward History
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('front-end.bulk-sms') }}">
                                                Bulk SMS
                                            </a>
                                        </li>
                                        <li>
                                            <button wire:click="refreshVotes" class="dropdown-item"
                                                    style="font-weight:bold; font-size:14px; color: white; transition: color 0.3s ease;"
                                                    onmouseover="this.style.color='black';"
                                                    onmouseout="this.style.color='white';">
                                                Sync Votes
                                            </button>
                                        </li>
                                    @endif
                                <!--====== for super admins view only =========-->
                                    <li>
                                        <button wire:click="logout" class="dropdown-item"
                                                style="font-weight:bold; font-size:15px; color: white; transition: color 0.3s ease;"
                                                onmouseover="this.style.color='black';"
                                                onmouseout="this.style.color='white';">
                                            Log Out
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div> <!--==end of <div id="main-menu">==-->

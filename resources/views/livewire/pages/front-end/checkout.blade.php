<?php

use App\Jobs\ProcessVotes;
use App\Models\MpesaTransaction;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $vehicle_id;
    public $vehicle;
    public $account_number;
    public $referralCode;

    public function mount($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->vehicle = Vehicle::find($this->vehicle_id);

        Transaction::where('user_id', auth()->user()->id)
            ->where('status', 'pending')
            ->delete();

        $this->account_number = $this->generateAccountNumber();
        Transaction::create([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $this->vehicle_id,
            'account_number' => $this->account_number,
            'phone_number' => auth()->user()->phone_number,
        ]);

    }


    public function generateAccountNumber()
    {
        // Get the latest user account number
        $latestAccountNumber = Transaction::latest('id')->first();

        // Default to 'MAA001' if there are no transactions
        if ($latestAccountNumber) {
            $lastAccountNumber = $latestAccountNumber->account_number;

            // Extract the prefix (e.g., 'MAA') and the numeric part (e.g., '001')
            $prefix = substr($lastAccountNumber, 0, 3);  // First 3 characters: 'MAA'
            $lastNumber = (int)substr($lastAccountNumber, 3); // Numeric part after the prefix, e.g., '001'

            // Increment the numeric part
            if ($lastNumber < 999) {
                $newNumber = $lastNumber + 1;
                $newPrefix = $prefix;
            } else {
                // If we reach 999, increment the prefix
                $newNumber = 1;
                $newPrefix = $this->incrementPrefix($prefix); // Get the next prefix (e.g., 'MAB' -> 'MAC')
            }
        } else {
            // If there are no transactions, start with 'MAA001'
            $newNumber = 1;
            $newPrefix = 'MAA';
        }

        // Ensure the numeric part is always 3 digits
        $numericPart = str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        // Combine the prefix and numeric part to form the account number
        $accountNumber = $newPrefix . $numericPart;

        // Ensure the account number is unique
        while (Transaction::where('account_number', $accountNumber)->exists()) {
            $newNumber++;
            if ($newNumber > 999) {
                $newNumber = 1;
                $newPrefix = $this->incrementPrefix($newPrefix); // Increment the prefix if needed
            }
            $numericPart = str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            $accountNumber = $newPrefix . $numericPart;
        }

        return $accountNumber;
    }

    private function incrementPrefix($currentPrefix)
    {
        // Increment the last character of the prefix ('A' -> 'B')
        $prefixArray = str_split($currentPrefix);
        $lastChar = $prefixArray[2];

        // If last character is 'Z', roll over to the previous letter
        if ($lastChar == 'Z') {
            if ($prefixArray[1] == 'Z') {
                $prefixArray[0] = chr(ord($prefixArray[0]) + 1); // Increment first character
                $prefixArray[1] = 'A'; // Reset second character
            } else {
                $prefixArray[1] = chr(ord($prefixArray[1]) + 1); // Increment second character
            }
            $prefixArray[2] = 'A'; // Reset third character
        } else {
            $prefixArray[2] = chr(ord($lastChar) + 1); // Increment last character
        }

        return implode('', $prefixArray);
    }

    public function calculateRewards($amount_transacted)
    {
        // List of primes
        $primes = [7, 11, 13, 17, 19];

        // Generate a random six-digit number
        $randomNumber = rand(100000, 999999);

        // Initialize the prime that the number is a multiple of
        $multipleOf = null;

        // Check if the number is a multiple of any of the primes
        foreach ($primes as $prime) {
            if ($randomNumber % $prime === 0) {
                $multipleOf = $prime;
                break; // No need to check further
            }
        }

        // Assuming $multipleOf and $amount_transacted are already defined
        if ($multipleOf) {

            // Calculate points based on the given formula
            $calculatedPoints = ($amount_transacted * 2) / 50;

            // Get the logged-in user's ID (assuming a session or authentication system)
            $userId = auth()->id(); // Laravel example. Adjust for your setup.

            // Fetch the user's current points from the user_awards table
            $userAward = DB::table('user_awards')->where('user_id', $userId)->first();

            if ($userAward) {
                // Add the calculated points to the user's current points
                $newPoints = $userAward->points + $calculatedPoints;

                // Update the user_awards table
                DB::table('user_awards')
                    ->where('user_id', $userId)
                    ->update(['points' => $newPoints]);
            } else {

                // If the user has no entry in the user_awards table, create one
                DB::table('user_awards')->insert([
                    'user_id' => $userId,
                    'points' => $calculatedPoints,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return $calculatedPoints;
        }

        return false;
    }


    public function confirmPayment()
    {
        $transaction = Transaction::where('account_number', $this->account_number)->first();

        if ($transaction->status === 'pending') {
            $this->alert('error', 'Kindly complete the transaction and try again!.');
            return;
        }

        if ($transaction->status === 'incomplete') {
            $this->alert('error', 'Your transaction is successful. Zero votes awarded.');
            return;
        }

        if (!empty($this->referralCode)) {
            $transaction->update([
                'ref_code' => $this->referralCode
            ]);
        }


        $votes = floor(round($transaction->amount, 2) / 50);

        // Dispatch job for processing votes
        ProcessVotes::dispatch($transaction->id, auth()->user()->id, $this->vehicle_id, $votes);

        $messages[] = 'You have voted for vehicle ' . substr($this->vehicle->vehicle_reg, 0, strlen($this->vehicle->vehicle_reg) - 4) . ' ' . str_repeat('*', 3) . substr($this->vehicle->vehicle_reg, -1) . ' successfully!';

        $calculatedPoints = $this->calculateRewards($transaction->amount);

        if ($calculatedPoints) {
            $messages[] = 'Congratulations! You have been awarded ' . $calculatedPoints . ' points!';
        }

        session()->flash('success_messages', $messages);
        return redirect()->route('front-end.car-awards');
    }

} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Checkout</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="register">
                    <form wire:submit="confirmPayment" class="row g-3">
                        <div class="col-md-4">
                            <img src="front-end/images/mpesa.png">
                        </div>
                        <div class="col-md-8">
                            <p><strong class="text-success">For every Ksh. 50, you receive one vote</strong>. For
                                example, a payment of Ksh. 100 will earn you
                                2 votes.<br/>
                                <em>Terms and Conditions apply</em></p>
                        </div>

                        <p>
                        <ul style="margin-left:20px;">
                            <li>Go to <strong>Pay Bill</strong> on the <strong>M-Pesa</strong></li>
                            <li>Enter <strong>Business number</strong> - <strong>4002487</strong></li>
                            <li>Enter the <strong>Account Number</strong> - <strong>{{ $account_number }}</strong></li>
                            <li>Enter the <strong>Amount</strong></li>
                            <li>Enter your <strong>M-Pesa PIN</strong></li>
                            <li>Wait for <strong>Confirmation message</strong></li>
                            <li>Click on <strong>Confirm Payment button</strong> to complete voting</li>
                        </ul>
                        </p>

                        <!-- New referral code input -->
                        <div class="col-lg-6 col-md-12">
                            <label for="referral_code" class="form-label">Referral Code (Optional)</label>
                            <input type="text" id="referral_code" wire:model.defer="referralCode" class="form-control"
                                   placeholder="Enter referral code if any">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Confirm Payment
                            </button>
                        </div>
                    </form>
                </div> <!--==end of <div id="register">==-->
            </div> <!--==end of <div id="page-contents">==-->
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="wrapper-inner">==-->


    <div id="newsletter-wrap">
        <div id="container">
            <img src="front-end/images/news-line.jpg" class="news-line">
            <h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
            <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
            <form id="newsletter">
                <input type="email" id="newsInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </form>
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="newsletter-wrap">==-->
</div>

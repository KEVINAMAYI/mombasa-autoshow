<?php

use App\Models\MpesaTransaction;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Vote;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $vehicle_id;
    public $vehicle;
    public $account_number;

    public function mount($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->vehicle = Vehicle::find($this->vehicle_id);

        $transaction = Transaction::where('user_id', auth()->user()->id)
            ->where('vehicle_id', $this->vehicle_id)
            ->where('status', 'pending')
            ->latest()
            ->first();

        if ($transaction) {
            $this->account_number = $transaction->account_number;
        } else {

            $this->account_number = $this->generateAccountNumber();
            Transaction::create([
                'user_id' => auth()->user()->id,
                'vehicle_id' => $this->vehicle_id,
                'account_number' => $this->account_number,
                'phone_number' => auth()->user()->phone_number,
            ]);
        }
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


    public function confirmPayment()
    {
        $transaction = Transaction::where('account_number', $this->account_number)->first();

        if ($transaction->status === 'pending') {
            $this->alert('error', 'Kindly complete the transaction and try again!.');
            return;
        }

        if ($transaction->status === 'incomplete') {
            $this->alert('error', 'Your transaction is successful. Zero votes awarded..');
            return;
        }

        $votes = (int)($transaction->amount / 2);

        for ($i = 1; $i <= $votes; $i++) {
            // Store vote details
            Vote::create([
                'transaction_id' => $transaction->id,
                'user_id' => auth()->user()->id,
                'vehicle_id' => $this->vehicle_id,
            ]);
        }

        session()->flash('success', 'You have voted for vehicle ' . substr($this->vehicle->vehicle_reg, 0, strlen($this->vehicle->vehicle_reg) - 4) . ' ' . str_repeat('*', 3) . substr($this->vehicle->vehicle_reg, -1) . ' successfully!');
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
                            <li>Enter the <strong>Account Number</strong> -
                                <strong>{{ $account_number }}</strong></li>
                            <li>Enter the <strong>Amount</strong></li>
                            <li>Enter your <strong>M-Pesa PIN</strong></li>
                            <li>Wait for <strong>Confirmation message</strong></li>
                            <li>Click on <strong>Confirm Payment button</strong> to complete voting</li>
                        </ul>
                        </p>

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

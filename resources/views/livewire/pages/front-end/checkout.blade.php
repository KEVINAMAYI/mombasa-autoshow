<?php

use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Vote;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $vehicle_id;
    public $vehicle;

    #[Validate('required|integer|min:50')]
    public $amount_payable = 50;

    public function mount($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->vehicle = Vehicle::where('id', $this->vehicle_id)->first();

    }


    public function confirmPayment()
    {
        try {

            // Validate user input
            $this->validate();

            // Store transaction details
            $transaction = Transaction::create([
                'user_id' => auth()->user()->id,
                'vehicle_id' => $this->vehicle_id,
                'amount' => $this->amount_payable,
                'transaction_code' => $this->generateUniqueCode(),
                'vehicle_account_number' => $this->vehicle->account_number,
                'phone_number' => '+254795704301',
                'status' => 'completed',
            ]);

            $votes = $this->amount_payable / 50;

            for ($i = 1; $i <= $votes; $i++) {
                // Store vote details
                Vote::create([
                    'transaction_id' => $transaction->id,
                    'user_id' => auth()->user()->id,
                    'vehicle_id' => $this->vehicle_id,
                ]);
            }

            session()->flash('success', 'You have voted for vehicle ' . substr($this->vehicle->vehicle_reg, 0, strlen($this->vehicle->vehicle_reg) - 4) . ' ' . str_repeat('*', 3) . substr($this->vehicle->vehicle_reg, -1). ' successfully!');
            return redirect()->route('front-end.car-awards');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Handle other exceptions
            session()->flash('error', 'An unexpected error occurred. Please try again.');
            return redirect()->back()->withInput();
        }
    }

    function generateUniqueCode()
    {
        // Define the prefix and suffix
        $prefix = 'SQRT';
        $suffix = 'ER';

        // Generate a random 4-digit number
        $randomNumber = mt_rand(1000, 9999);

        // Combine them into the desired format
        $uniqueCode = $prefix . $randomNumber . $suffix;

        return $uniqueCode;
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
                            <p>For every Ksh. 50, you receive one vote. For example, a payment of Ksh. 100 will earn you
                                2 votes.<br/>
                                <em>Terms and Conditions apply</em></p>
                        </div>

                        <p>
                        <ul style="margin-left:20px;">
                            <li>
                                Enter the amount you wish to pay in the input field below: <br>
                                <input type="number" wire:model.live="amount_payable"
                                       placeholder="Enter the amount here"
                                       style="margin: 10px 0; padding: 5px; font-size: 16px; width: 100%; max-width: 300px;"/>
                                @error('amount_payable')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </li>
                            <hr>
                            <li>Go to <strong>Pay Bill</strong> on the <strong>M-Pesa</strong></li>
                            <li>Enter <strong>Business number</strong> - <strong>4002487</strong></li>
                            <li>Enter the <strong>Account Number</strong> -
                                <strong>{{ $vehicle->account_number }}</strong></li>
                            <li>Enter the <strong>same amount</strong> you specified above</li>
                            <li>Enter your <strong>M-Pesa PIN</strong></li>
                            <li>Wait for <strong>Confirmation message</strong></li>
                            <li>Click on <strong>Confirm Payment button</strong> to complete voting</li>
                        </ul>
                        </p>

                        <div class="col-12">
                            <button type="submit" {{ $amount_payable < 50 ? 'disabled' : '' }} class="btn btn-success">
                                Confirm Payment
                            </button>
                        </div>
                        @if($amount_payable < 50)
                            <strong class="text-danger text-xs pt-1">*If the amount is less than KES 50, you won't be abe to confirm payment </strong>
                        @endif
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

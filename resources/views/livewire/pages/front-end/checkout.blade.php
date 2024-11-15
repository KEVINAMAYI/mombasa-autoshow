<?php

use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\Vote;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $vehicle_id;
    public $vehicle;

    public function mount($vehicle_id)
    {
        $this->vehicle_id = $vehicle_id;
        $this->vehicle = Vehicle::where('id',$this->vehicle_id)->first();

    }


    public function confirmPayment()
    {
        $amount_payable = 2000;

        //store transaction details
        $transaction = Transaction::create([
            'user_id' => auth()->user()->id,
            'vehicle_id' => $this->vehicle_id,
            'amount' => $amount_payable,
            'transaction_code' => $this->generateUniqueCode(),
            'vehicle_account_number' => $this->vehicle->account_number,
            'phone_number' => '+254795704301',
            'status' => 'completed'
        ]);

        $votes = $amount_payable / 50;

        for ($i = 1; $i <= $votes; $i++) {

            // Store vote details
            $vote = Vote::create([
                'transaction_id' => $transaction->id,
                'user_id' => auth()->user()->id,
                'vehicle_id' => $this->vehicle_id
            ]);
        }



        session()->flash('success', 'Your have voted for vehicle ' . $this->vehicle->vehicle_reg . ' successfully!');
        $this->redirectRoute('front-end.car-awards');

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
                                2 votes.Each vote enters you into a weekly draw for a chance to win cash prizes.
                                The more you vote, the higher your chances of winning.<br/>
                                <em>Terms and Conditions apply</em></p>
                        </div>

                        <p>
                        <ul style="margin-left:20px;">
                            <li>Go to Pay Bill on the M-Pesa</li>
                            <li>Business number - 4002487</li>
                            <li>Account Number - <strong>{{ $vehicle->account_number }}</strong></li>
                            <li>Enter Amount</li>
                            <li>Enter your M-Pesa PIN</li>
                            <li>Wait for confirmation.</li>
                        </ul>
                        </p>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Confirm Payment</button>
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

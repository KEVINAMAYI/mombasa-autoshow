<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $search;
    public $transactions;

    public function mount()
    {
        $this->getUserTransactions();
    }


    public function updatedSearch()
    {
        $this->getUserTransactions();
    }

    public function getUserTransactions($searchTerm = null)
    {
        $userId = Auth::id();

        // Initialize the query for transactions where votes are associated with the authenticated user
        $query = Transaction::whereHas('votes.user', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        });

        // If a search term is provided, filter transactions based on vehicle, date, or phone
        if ($this->search) {
            $query->where(function ($query) {
                // Search for vehicle name or registration number
                $query->orWhereHas('votes.vehicle', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('vehicle_reg', 'like', '%' . $this->search . '%');
                });

                $query->orWhereHas('votes.vehicle.make', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });

                $query->orWhereHas('votes.vehicle.vehicle_model', function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });

                // Search for transaction date (adjust field name if necessary)
                $query->orWhereDate('created_at', '=', $this->search);
                $query->orWhere('transaction_code', 'like', '%' . $this->search . '%');
                $query->orWhere('account_number', 'like', '%' . $this->search . '%');
                $query->orWhere('status', 'like', '%' . $this->search . '%');
                $query->orWhere('phone_number', 'like', '%' . $this->search . '%');

                // Search for user phone (adjust field name if necessary)
                $query->orWhereHas('votes.user', function ($query) {
                    $query->where('phone_number', 'like', '%' . $this->search . '%')
                        ->orWhere('first_name', 'like', '%' . $this->search . '%')
                        ->orWhere('last_name', 'like', '%' . $this->search . '%');

                });
            });
        }

        // Include 'votes' and 'vehicle' relations for eager loading
        $this->transactions = $query->with(['votes', 'votes.vehicle'])->get();
    }


} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">My Transactions</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row mb-4 g-8">
                    <div class="col-sm-12">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search votes">
                    </div>

                </div>
                <!-- =======end of Search====-->


                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>Transaction Ref.</strong></td>
                        <td><strong>Account No.</strong></td>
                        <td><strong>Vehicle Name</strong></td>
                        <td><strong>Date/Time</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Votes</strong></td>
                        <td><strong>Phone</strong></td>
                        <td><strong>Status</strong></td>
                    </tr>

                    @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->account_number }}</td>
                            <td>
                                <a href="{{ route('front-end.car-details',$transaction->votes->first()->vehicle->id) }}">{{ $transaction->votes->first()->vehicle->name.' '.$transaction->votes->first()->vehicle->make->name.'-'.$transaction->votes->first()->vehicle->vehicle_model->name }}</a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-M-Y H:i') }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ $transaction->votes->count() }}</td>
                            <td>{{ $transaction->phone_number }}</td>
                            <td>{{ $transaction->status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Transaction Was Found</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>


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

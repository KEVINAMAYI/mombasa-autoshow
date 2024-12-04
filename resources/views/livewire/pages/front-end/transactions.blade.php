<?php

use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.front-end')] class extends Component {

    use WithPagination;

    public $search;
    public $totalAmount;
    protected $paginationTheme = 'bootstrap';

    public function calculateTotalAmount()
    {
        $this->totalAmount = $this->getUserTransactions()->sum('amount'); // Replace 'amount' with the actual field name for the transaction amount in your database.
    }

    public function with()
    {
        return [
            'transactions' => $this->getUserTransactions()->paginate(10)
        ];
    }

    public function updatedSearch()
    {
        $this->getUserTransactions();
        $this->with();
    }

    public function getUserTransactions()
    {
        $query = Transaction::orderBy('created_at', 'DESC')->whereIn('status', ['completed', 'incomplete']);

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

        // Return the query itself for pagination later
        return $query->with(['votes', 'votes.vehicle']);
    }

} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">All Transactions</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row  mb-4 g-3">
                    <div class="col-sm-9">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search votes">
                    </div>
                    <div class="col-sm-3">
                        <p align="right" class="text-success"><strong>Total Amount:
                                Ksh. {{ number_format($totalAmount, 2) }}</strong></p>
                    </div>
                </div>
                <!-- =======end of Search====-->


                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>User Names</strong></td>
                        <td><strong>Transaction Ref.</strong></td>
                        <td><strong>Account No.</strong></td>
                        <td><strong>Vehicle Name</strong></td>
                        <td><strong>Date/Time</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Votes</strong></td>
                        <td><strong>Phone</strong></td>
                        <td><strong>Referral Code</strong></td>
                        <td><strong>Status</strong></td>
                    </tr>
                    @if($transactions->isNotEmpty()) <!-- Use isNotEmpty() for collection check -->
                    @foreach($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->user->first_name.' '.$transaction->user->last_name }}</td>
                            <td>{{ $transaction->transaction_code }}</td>
                            <td>{{ $transaction->account_number }}</td>
                            <td>
                                <a href="{{ route('front-end.car-details',  $transaction->vehicle->id) }}">{{ $transaction->vehicle->name.' '.$transaction->vehicle->make->name.'-'.$transaction->vehicle->vehicle_model->name }}</a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d-M-Y H:i') }}</td>
                            <td>{{ $transaction->amount }}</td>
                            <td>{{ optional($transaction->votes)->count() ?? 0 }}</td>
                            <td>{{ $transaction->phone_number }}</td>
                            <td>{{ $transaction->ref_code ?? 'NA' }}</td>
                            <td>{{ ($transaction->status === 'incomplete') || ($transaction->status === 'completed') ? 'completed' : $transaction->status }}</td>
                        </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">No Transaction Was Found</td>
                        </tr>
                    @endif
                    </tbody>
                </table>

                <div>
                    {{ $transactions->links() }}
                </div>

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

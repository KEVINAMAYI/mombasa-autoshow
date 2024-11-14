<?php

use App\Models\Vote;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $votes;
    public $search;

    public function mount()
    {
        $this->getUserVotes();
    }


    public function updatedSearch()
    {
        $this->getUserVotes();
    }

    public function getUserVotes()
    {

        $userId = Auth::id();

        // Start query for votes with grouping
        $query = Vote::where('user_id', $userId)
            ->select('vehicle_id', \DB::raw('count(*) as vote_count'), \DB::raw('MAX(created_at) as latest_vote'))
            ->with('vehicle') // Include vehicle relationship
            ->groupBy('vehicle_id');

        // Apply search filter if search term is provided
        if ($this->search) {
            $query->whereHas('vehicle', function ($vehicleQuery) {
                $vehicleQuery->where('vehicle_reg', 'like', '%' . $this->search . '%')
                    ->orWhere('name', 'like', '%' . $this->search . '%');
            })->orwhereHas('vehicle.make', function ($makeQuery) {
                $makeQuery->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('vehicle.vehicle_model', function ($modelQuery) {
                $modelQuery->where('name', 'like', '%' . $this->search . '%');
            })->orWhereHas('user', function ($userQuery) {
                $userQuery->where('first_name', 'like', '%' . $this->search . '%')
                    ->orWhere('last_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('phone_number', 'like', '%' . $this->search . '%');
            });
        }

        // Execute the query and get results
        $this->votes = $query->get();
    }

} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">My Votes</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row mb-4 g-8">
                    <div class="col-sm-12">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search users">
                    </div>

                </div>
                <!-- =======end of Search====-->


                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>Vehicle Name</strong></td>
                        <td><strong>Date/Time</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Votes</strong></td>
                        <td><strong>Phone</strong></td>
                    </tr>
                    @forelse($votes as $vote)
                        <tr>
                            <td>
                                <a href="{{ route('front-end.car-details', ['id' => $vote->vehicle->id]) }}">{{ $vote->vehicle->name.' '.$vote->vehicle->make->name.'-'.$vote->vehicle->vehicle_model->name }}</a>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($vote->latest_vote)->format('d-M-Y H:i') }}</td>
                            <td>{{ $vote->vote_count*50 }}</td> <!-- Assuming vehicle ID or other vehicle details -->
                            <td>{{ $vote->vote_count }}</td>
                            <td>{{ auth()->user()->phone_number }}</td> <!-- Using the logged-in user's phone number -->
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Votes Were Found</td>
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

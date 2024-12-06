<?php

use App\Models\UserAward;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $votes;
    public $search;
    public $user_points;


    public function mount()
    {
        $this->getUserVotes();
        $this->user_points = UserAward::where('user_id', auth()->user()->id)->first();

        if ($this->user_points) {
            $this->user_points = $this->user_points->points;
        } else {
            $this->user_points = 0;
        }

    }


    public function updatedSearch()
    {
        $this->getUserVotes();
    }

    public function getUserVotes()
    {

        $userId = Auth::id();

        $query = Vote::where('user_id', $userId)
            ->select(
                'vehicle_id',
                'transaction_id', // Include transaction_id for relationship
                \DB::raw('count(*) as vote_count'),
                \DB::raw('MAX(created_at) as latest_vote')
            )
            ->with(['vehicle', 'transaction']) // Include relationships
            ->groupBy('vehicle_id')// Group by transaction_id as well
            ->orderBy('vote_count', 'DESC'); // Order by vote count in descending order

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
@push('css')
    <style>
        .christmas-container {
            text-align: center;
            position: relative;
        }

        .christmas-text {
            color: purple;
            font-weight: bold;
            margin: 0;
            position: relative;
        }

        .flower-decorations {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            position: relative;
        }

        .flower {
            width: 50px;
            height: 50px;
            background: radial-gradient(circle, #ff69b4 20%, #c2185b 80%);
            border-radius: 50%;
            position: relative;
            box-shadow: 0 0 10px #ff69b4, 0 0 20px #ff69b4;
        }

        .flower:before,
        .flower:after {
            content: '';
            width: 40px;
            height: 40px;
            background: radial-gradient(circle, #ff69b4 20%, #c2185b 80%);
            border-radius: 50%;
            position: absolute;
            box-shadow: 0 0 10px #ff69b4, 0 0 20px #ff69b4;
        }

        .flower:before {
            top: -20px;
            left: 5px;
        }

        .flower:after {
            top: 5px;
            left: -20px;
        }

        .flower-left {
            transform: rotate(-45deg);
        }

        .flower-right {
            transform: rotate(45deg);
        }

    </style>
@endpush
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
                    <div class="col-sm-9">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search votes">
                    </div>
                    <div class="col-sm-3">
                        <h5 class="christmas-text">
                            <span>
                                Awarded Points! {{ $user_points ?? '0'}}
                            </span>
                            <img width="60" height="50" src="/front-end/images/reward_bg.gif" alt="">
                        </h5>
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
                    @if($votes->isNotEmpty())
                        @foreach($votes as $vote)
                            <tr>
                                <td>
                                    <a href="{{ route('front-end.car-details', $vote->vehicle->id) }}">
                                        {{ $vote->vehicle->name.' '.$vote->vehicle->make->name.'-'.$vote->vehicle->vehicle_model->name }}
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($vote->latest_vote)->format('d-M-Y H:i') }}</td>
                                <td>{{ $vote->transaction?->amount ?? 'N/A' }}</td>
                                <td>{{ $vote->vote_count }}</td>
                                <td>{{ auth()->user()->phone_number }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center">No Vote Was Found</td>
                        </tr>
                    @endif
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

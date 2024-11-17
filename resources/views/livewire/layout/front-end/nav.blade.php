<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout)
    {
        $logout();
        return redirect()->route('front-end.index');
    }

}; ?>

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
                                <li><a class="dropdown-item" href="{{ route('front-end.my-profile') }}">My Profile</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('front-end.car-awards') }}">Car of the
                                        year</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('front-end.my-votes') }}">My Votes</a></li>
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
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div> <!--==end of <div id="main-menu">==-->

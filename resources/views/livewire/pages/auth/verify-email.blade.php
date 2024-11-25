<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;


    public function mount()
    {
        if (auth()->check() && auth()->user()->email_verified_at) {
            return redirect()->route('front-end.car-awards');
        }
    }


    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->alert('success', 'A verification email has been sent to your email');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

@push('css')
    <style>
        #thank-you-text {
            font-size: 20px;
            color: #000;
            margin-bottom: 15px;
            display: none; /* Hide by default */
        }

        @media (max-width: 500px) {

            #login {
                display: flex;
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            #thank-you-text {
                display: block; /* Show thank-you text on mobile */
            }

            #title-inner {
                display: none;
            }

            #login {
                gap: 10px; /* Add spacing between elements */
            }

            .btn {
                width: 90%; /* Full-width buttons on mobile */
            }
        }
    </style>
@endpush
<div class="page-content">

    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div style="padding:20px;  font-size:23px;" id="title-inner">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address.') }}
            </div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">

                <div style="border:0px; width:100%; text-align: center; background-color:transparent;" id="login">

                    <div id="thank-you-text">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address.') }}
                    </div>

                    <a style="background-color:green;" href="{{ route('front-end.car-awards') }}"
                            class="btn btn-primary">
                        {{ __('Proceed to Vote') }}
                    </a>

                    <button type="submit" wire:click="sendVerification"
                            class="btn btn-primary">
                        {{ __('Resend Verification Email') }}
                    </button>

                    <button type="submit" wire:click="logout" class="btn btn-primary">
                        {{ __('Logout') }}
                    </button>


                </div> <!--==end of <div id="login">==-->
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



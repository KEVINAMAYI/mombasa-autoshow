<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public LoginForm $form;
    public $showPassword = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->alert('success', 'Login was Successfully');

        if (!empty(auth()->user()->email_verified_at)) {
            $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
        }

        return redirect('verify-email');
    }

    public function togglePasswordVisibility()
    {
        $this->showPassword = !$this->showPassword;
    }
}; ?>

@push('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
        /* Remove background color on hover */
        .input-group .btn:hover {
            background-color: transparent !important;
            border-color: #ccc; /* Optional: you can also set the border color */
        }
    </style>
@endpush

<div class="page-content">

    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Login</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="login">
                    <p style="color:#b39af2;">Please login to access your account</p>
                    <form wire:submit="login">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" wire:model="form.email" id="email" class="form-control"
                                   autofocus autocomplete="username">
                            <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <div class="input-group">
                                <input
                                    type="{{ $showPassword ? 'text' : 'password' }}"
                                    wire:model="form.password"
                                    class="form-control"
                                    id="password"
                                    placeholder="Enter password"
                                >
                                <button type="button" class="btn btn-outline-secondary"
                                        wire:click="togglePasswordVisibility">
                                    <i style="color:purple;"
                                       class="fas {{ $showPassword === false ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                    <!-- Eye icon -->
                                </button>
                            </div>
                            <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>

                        </div>
                        <div class="mb-3 form-check">
                            <input wire:model="form.remember" type="checkbox" class="form-check-input"
                                   id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Remember me</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    @if (Route::has('password.request'))
                        <p style=" text-align:right; margin-top:10px;">
                            <a href="{{ route('password.request') }}">Forgot Password</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a
                                href="{{ route('register') }}">Register</a></p>
                    @endif
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


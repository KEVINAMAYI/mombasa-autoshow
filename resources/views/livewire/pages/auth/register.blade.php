<?php

use App\Models\Country;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public string $first_name = '';
    public string $last_name = '';
    public $country_id = '';
    public $town = '';
    public $countries = '';
    public $accept_terms = '';
    public string $phone_number = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';


    public function mount()
    {
        $this->countries = Country::all();
    }

    /**
     * Handle an incoming registration request.
     */
    public function register()
    {
        $validated = $this->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'country_id' => ['required', 'string', 'max:255'],
            'town' => ['string'],
            'accept_terms' => ['required'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->alert('success', 'You account was created Successful');

        if (auth()->check() && !empty(auth()->user()->email_verified_at)) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return redirect()->route('verify-email');

    }


}; ?>


<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Register</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="register">
                    <form wire:submit="register" class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input wire:model="first_name" name="first_name" type="text" class="form-control"
                                   id="first_name">
                            <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input wire:model="last_name" name="last_name" type="text" class="form-control"
                                   id="last_name">
                            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input wire:model="email" name="email" type="email" class="form-control" id="email">
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone No.</label>
                            <input wire:model="phone_number" name="phone_number" type="text" class="form-control"
                                   id="phone_number">
                            <x-input-error :messages="$errors->get('phone_number')" class="mt-2"/>
                        </div>

                        <div class="col-md-6">
                            <label for="country_id" class="form-label">Country</label>
                            <select wire:model="country_id" id="country_id" class="form-select">
                                <option value="" selected>Choose...</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country_id')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            <label for="town" class="form-label">Town (Optional)</label>
                            <input wire:model="town" name="town" type="text" class="form-control" id="town">
                            <x-input-error :messages="$errors->get('town')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input wire:model="password" name="password" type="password" class="form-control"
                                   id="password">
                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                        </div>
                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input wire:model="password_confirmation" id="password_confirmation" type="password"
                                   class="form-control" name="password_confirmation">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                        </div>
                        <div class="col-12">
                            <input type="checkbox" wire:model="accept_terms" name="accept_terms" value="1"
                                   id="accept_terms">
                            <label class="form-label" for="inputPassword4">
                                I agree to <a href="terms.html" target="_blank">Terms</a> and <a href="privacy.html"
                                                                                                 target="_blank">Privacy
                                    Policy</a>
                            </label>
                            <x-input-error :messages="$errors->get('accept_terms')" class="mt-2"/>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Create Account</button>
                        </div>
                    </form>

                    <p style=" text-align:right; margin-top:10px;"><a href="{{ route('password.request') }}">Forgot
                            Password</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="{{ route('login') }}">Login</a></p>
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



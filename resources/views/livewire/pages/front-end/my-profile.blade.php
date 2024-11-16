<?php

use App\Models\Country;
use App\Models\Town;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Validation\Rules;


new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $first_name;
    public $last_name;
    public $email;
    public $phone_number;
    public $country_id;
    public $countries;
    public $town_id;
    public $towns;
    public $password;
    public $password_confirmation; // Add this for confirmation validation

    public function mount()
    {
        $user = auth()->user();

        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone_number = $user->phone_number;
        $this->country_id = $user->country_id;
        $this->town_id = $user->town_id;

        $this->countries = Country::all();
        $this->towns = Town::all();
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'country_id' => 'required|exists:countries,id',
            'town_id' => 'required|exists:towns,id',
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function updateProfile()
    {
        $this->validate();

        DB::beginTransaction();
        try {
            $userData = [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => $this->email,
                'phone_number' => $this->phone_number,
                'country_id' => $this->country_id,
                'town_id' => $this->town_id,
            ];

            if (!empty($this->password)) {
                $userData['password'] = bcrypt($this->password);
            }

            auth()->user()->update($userData);

            DB::commit();
            $this->alert('success', 'Profile Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->alert('error', 'An error occurred while updating your profile: ' . $e->getMessage());
        }
    }
} ?>
<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">My Profile</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="register">
                    <form wire:submit.prevent="updateProfile" class="row g-3">
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="first_name" wire:model="first_name">
                            @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="last_name" wire:model="last_name">
                            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="phone_number" class="form-label">Phone No.</label>
                            <input type="text" class="form-control" id="phone_number" wire:model="phone_number">
                            @error('phone_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="country_id" class="form-label">Country</label>
                            <select id="country_id" wire:model="country_id" class="form-select">
                                <option value="">Choose...</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="town_id" class="form-label">Town</label>
                            <select id="town_id" wire:model="town_id" class="form-select">
                                <option value="">Choose...</option>
                                @foreach($towns as $town)
                                    <option value="{{ $town->id }}">{{ $town->name }}</option>
                                @endforeach
                            </select>
                            @error('town_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" wire:model="password" name="password" class="form-control"
                                   id="password">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" wire:model="password_confirmation" name="password_confirmation"
                                   class="form-control" id="password_confirmation">
                            @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Update</button>
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

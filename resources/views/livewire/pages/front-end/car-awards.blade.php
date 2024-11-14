<?php

use App\Models\Vehicle;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $vehicles;

    public function mount()
    {
        $this->vehicles = Vehicle::all();
    }

} ?>

<div class="page-content">

    @if (session('success'))
        <div class="alert text-success alert-light" id="success-message"
             style="position: fixed; top: 20px; right: 20px; max-width: 300px; z-index: 1000; padding: 15px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
            {{ session('success') }}
        </div>
    @endif

    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Car of the Year</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <p>The Mombasa Autoshow car awards aim to celebrate and honor those Technology and Automotive products
                    and innovations that have paved the way for the future of these sectors and set benchmarks in their
                    respective fields while helping Kenyans make better decisions when buying cars. The general public
                    is invited to submit their cars for voting. Winners of the competition will receive cash
                    prize,trophies and many more giveaways.</p>

                <div class="row g-3">
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                               placeholder="Search for car by make,model or any keyword" aria-label="Search car">
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('front-end.create-car') }}" class="btn2" style="margin-top:0;">Submit a
                            Car</a>
                    </div>
                </div>
                <!-- =======end of Search====-->
                <div class="row g-3" style="margin-top:5px;">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Category</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Category...</option>
                            <option value="sedan">Sedan</option>
                            <option value="coupe">Coupe</option>
                            <option value="hatchback">Hatchback</option>
                            <option value="station-wagon">Station Wagon</option>
                            <option value="suv">SUV</option>
                            <option value="pick-up">Pick up</option>
                            <option value="van">Van</option>
                            <option value="mini-van">Mini Van</option>
                            <option value="wagon">Wagon</option>
                            <option value="convertible">Convertible</option>
                            <option value="bus">Bus</option>
                            <option value="truck">Truck</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Make</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Make...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Model</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Model...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Year of Award</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Year of Award...</option>
                            <option value="1">2025</option>
                        </select>
                    </div>
                </div>
                <!--===end of filter ==-->

                @forelse($vehicles as $vehicle)
                    <div id="car-wrap">
                        <a style="text-decoration:none;" href="{{ route('front-end.car-details') }}">
                            <img
                                src="{{ $vehicle->images->isNotEmpty() ? $vehicle->images->first()->image_url : 'path/to/placeholder.jpg' }}"
                                class="car-thumb"/>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3">
                                            <strong>{{ $vehicle->name.' '.$vehicle->make->name.'-'.$vehicle->vehicle_model->name }}</strong></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $vehicle->manufacturing_year }}</td>
                                    <td>{{ $vehicle->location }}</td>
                                </tr>
                                <tr>
                                    <td>Total votes:</td>
                                    <td><strong>{{ $vehicle->votes->count() }}</strong></td>
                                </tr>
                                <tr>
                                    <td><a href="{{ route('front-end.checkout',$vehicle->id) }}" type="button"
                                           class="btn btn-primary btn-sm">Vote for me</a>
                                    </td>
                                    <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                    </div>
                @empty
                    <p class="text-center">No Vehicle Found</p>
                @endforelse


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
@push('js')
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 4000); // Hide after 3 seconds
    </script>
@endpush

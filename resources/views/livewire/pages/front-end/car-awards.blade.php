<?php

use App\Models\Category;
use App\Models\Make;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $vehicles;
    public $makes;
    public $categories;
    public $models;
    public $search = '';
    public $category_id;
    public $make_id;
    public $vehicle_model_id;

    public function mount()
    {
        $this->getVehicles();
        $this->makes = Make::all();
        $this->categories = Category::all();
        $this->models = VehicleModel::all();
    }

    public function updatedSearch()
    {
        $this->getVehicles();
    }

    public function updateModels()
    {
        $this->models = VehicleModel::where('make_id', $this->make_id)->get();
        $this->getVehicles();
    }

    public function getVehicles()
    {
        $query = Vehicle::where('published', 1)
            ->with(['make', 'vehicle_model', 'images', 'votes']); // Eager load relationships

        if ($this->search) {
            $query->where('vehicle_reg', 'like', '%' . $this->search . '%')
                ->orWhere('location', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('sacco', 'like', '%' . $this->search . '%')
                ->orWhere('route', 'like', '%' . $this->search . '%')
                ->orWhere('interior_color', 'like', '%' . $this->search . '%')
                ->orWhere('exterior_color', 'like', '%' . $this->search . '%')
                ->orWhere('transmission', 'like', '%' . $this->search . '%')
                ->orWhereHas('make', function ($makeQuery) {
                    $makeQuery->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('vehicle_model', function ($modelQuery) {
                    $modelQuery->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('category', function ($modelQuery) {
                    $modelQuery->where('name', 'like', '%' . $this->search . '%');
                });
        }

        // Make Filter
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }

        // Make Filter
        if ($this->make_id) {
            $query->where('make_id', $this->make_id);
        }

        // Model Filter
        if ($this->vehicle_model_id) {
            $query->where('vehicle_model_id', $this->vehicle_model_id);
        }

        $this->vehicles = $query->get();
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
                    <div class="{{ auth()->user()->is_admin ? 'col-sm-9' : 'col-sm-12' }}">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search for car by make, model, or any keyword">
                    </div>
                    @if(auth()->user()->is_admin)
                        <div class="col-sm-3">
                            <a href="{{ route('front-end.create-car') }}" class="btn2" style="margin-top:0;">Submit a
                                Car</a>
                        </div>
                    @endif
                </div>
                <!-- =======end of Search====-->
                <div class="row g-3" style="margin-top:5px;">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Category</label>
                        <select wire:change="getVehicles" wire:model="category_id" class="form-select"
                                id="autoSizingSelect">
                            <option value="" selected>All Categories...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="make_id">All Makes</label>
                        <select wire:change="updateModels" wire:model="make_id" class="form-select" id="make_id">
                            <option value="" selected>All Makes...</option>
                            @foreach($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="vehicle_model_id">All Models</label>
                        <select wire:change="getVehicles" class="form-select" wire:model="vehicle_model_id"
                                id="vehicle_model_id">
                            <option value="" selected>All Models...</option>
                            @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Year of Award</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option value="2025">2025</option>
                        </select>
                    </div>
                </div>

            @if($vehicles->isNotEmpty()) <!-- Use isNotEmpty() for collection check -->
                @foreach($vehicles as $vehicle)
                    <div id="car-wrap">
                        <a style="text-decoration:none;" href="{{ route('front-end.car-details', $vehicle->id) }}">
                            <img
                                src="{{ $vehicle->images->isNotEmpty() ? $vehicle->images->first()->image_url : 'front-end/images/slider/car.jpg' }}"
                                class="car-thumb"/>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2">
                                        <a href="{{ route('front-end.car-details', $vehicle->id) }}" class="title3">
                                            <strong>{{ $vehicle->name }}
                                                {{ optional($vehicle->make)->name }} -
                                                {{ optional($vehicle->vehicle_model)->name }}</strong>
                                        </a>
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
                                    <td><a href="{{ route('front-end.checkout', $vehicle->id) }}" type="button"
                                           class="btn btn-primary btn-sm">Vote for me</a>
                                    </td>
                                    <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </a>
                    </div>
                @endforeach
                @else
                    <p style="margin-top:20px; font-weight:bold; font-size:18px;" class="text-warning text-center">No
                        Vehicle Found</p>
                @endif
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

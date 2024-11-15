<?php

use App\Models\Vehicle;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    public $vehicle;
    use LivewireAlert;


    public function mount(Vehicle $vehicle)
    {
        $this->vehicle = $vehicle;
    }

    public function updateVehiclePublication(){
        try {

            $vehicle = Vehicle::find($this->vehicle->id);

            if ($vehicle->published) {
                $vehicle->update(['published' => false]);
                $message = 'Vehicle unpublished successfully';

            } else {
                $vehicle->update(['published' => true]);
                $message = 'Vehicle published successfully';
            }

            $this->vehicle = $vehicle;
            $this->alert('success', $message);

        } catch (Exception $exception) {

            $this->alert('error', 'There was an error while updating vehicle');

        }
    }


} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Car Details</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="left-col">
                    <h3 class="title2">{{ $vehicle->name.' '.$vehicle->make->name.'-'.$vehicle->vehicle_model->name }}</h3>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @forelse($vehicle->images as $image )
                                <div class="carousel-item active">
                                    <img src="{{ $vehicle->images->first()->image_url }}" class="d-block w-100" alt="...">
                                </div>
                            @empty
                                <div class="carousel-item active">
                                    <img src="front-end/images/slider/car.jpg" class="d-block w-100" alt="...">
                                </div>
                            @endforelse
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!--==============end of carousel =======-->
                    <h3 class="title2">What is unique about this car?</h3>
                    <p>{{ $vehicle->description }}</p>
                </div> <!--==end of <div id="left-col">==-->
                <div id="right-col">
                    <h3 class="title2">Vehicle Desciption</h3>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="car-details.html" class="title3"><strong>{{ $vehicle->name.' '.$vehicle->make->name.'-'.$vehicle->vehicle_model->name }}</strong></a></td>
                        </tr>
                        <tr>
                            <td>{{ $vehicle->manufacturing_year }}</td>
                            <td>{{ $vehicle->location }}</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>{{$vehicle->votes->count()}}</strong></td>
                        </tr>
                        <tr>
                            <td>Engine CC</td>
                            <td>{{ $vehicle->eng_cc }}</td>
                        </tr>
                        <tr>
                            <td>Transmission</td>
                            <td>{{ $vehicle->transmission }}</td>
                        </tr>
                        <tr>
                            <td>Fuel Type</td>
                            <td>{{ $vehicle->fuel_type }}</td>
                        </tr>
                        <tr>
                            <td>Interior color</td>
                            <td>{{ $vehicle->interior_color }}</td>
                        </tr>
                        <tr>
                            <td>Exterior color</td>
                            <td>{{ $vehicle->exterior_color }}</td>
                        </tr>
                        <tr>
                            <td>Vehicle Registration</td>
                            <td>{{ $vehicle->vehicle_reg }}</td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout',$vehicle->id) }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>
                        <tr>
                            <td><a href="#" class="btn btn-success btn-sm">Edit</a></td>
                            @if($vehicle->published)
                                <td><button wire:click="updateVehiclePublication" class="btn btn-danger btn-sm" style="float:right;">Unpublish</button></td>
                            @else
                                <td><button wire:click="updateVehiclePublication" class="btn btn-info btn-sm text-white" style="float:right;">Publish</button></td>
                            @endif
                        </tr>
                        </tbody>
                    </table>
                </div> <!--==end of <div id="right-col">==-->
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

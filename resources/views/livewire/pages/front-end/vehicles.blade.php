<?php

use App\Models\User;
use App\Models\Vehicle;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {

    use LivewireAlert;

    public $vehicles;
    public $search = '';


    public function mount()
    {
        $this->vehicles = Vehicle::with(['make', 'vehicle_model', 'images', 'votes'])->get();
    }

    public function updatedSearch()
    {
        $this->getVehicles();
    }

    public function getVehicles()
    {
        $query = Vehicle::with(['make', 'vehicle_model', 'images', 'votes']); // Eager load relationships

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

        $this->vehicles = $query->get();
    }


    public function updatesVehicleStatus($vehicle_id)
    {
        try {

            $vehicle = Vehicle::find($vehicle_id);

            if ($vehicle->published) {
                $vehicle->update(['published' => false]);
                $message = 'Vehicle unpublished successfully';
            } else {
                $vehicle->update(['published' => true]);
                $message = 'Vehicle published successfully';
            }

            $this->getVehicles();
            $this->alert('success', $message);

        } catch (Exception $exception) {

            $this->alert('error', 'There was an error while updating user');

        }

    }


} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">All Vehicles</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row mb-4 g-8">
                    <div class="col-sm-12">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search vehicle">
                    </div>

                </div>
                <!-- =======end of Search====-->


                <table id="users_table"
                       class="table">
                    <tbody>
                    <tr>
                        <td><strong>Vehicle</strong></td>
                        <td><strong>Registration</strong></td>
                        <td><strong>Engine CC</strong></td>
                        <td><strong>Fuel Type</strong></td>
                        <td><strong>Transmission</strong></td>
                        <td><strong>Action</strong></td>
                    </tr>

                    @forelse($vehicles as $vehicle)
                        <tr>
                            <td><a style="text-decoration:underline;" href="{{ route('front-end.car-details',$vehicle->id) }}"
                                   class="title3">{{ $vehicle->name.' '.$vehicle->make->name.'-'.$vehicle->vehicle_model->name }}</a></td>
                            <td>{{ $vehicle->vehicle_reg }}</td>
                            <td>{{ $vehicle->eng_cc }}</td>
                            <td>{{ $vehicle->fuel_type }}</td>
                            <td>{{ $vehicle->transmission }}</td>
                            <td>
                                @if($vehicle->published)
                                    <button wire:click="updatesVehicleStatus({{$vehicle->id}})"
                                            class="btn btn-sm btn-outline-warning">Unpublish
                                    </button>
                                @else
                                    <button wire:click="updatesVehicleStatus({{$vehicle->id}})"
                                            class="btn btn-sm btn-outline-success">Publish
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No Users Were Found</td>
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

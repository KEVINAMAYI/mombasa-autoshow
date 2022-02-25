@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Create a car'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">

      {{-- display success message on a successful action --}}
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        {{ Session::get('success') }}
      </div>
      @endif

      {{-- display error on top of the form --}}
      @if ($errors->any())
      <div class="alert alert-danger" role="alert">
          <ul class="list-group">
              @foreach ($errors->all() as $error )
              <li class="list-group-item">
                {{ $error }}  
              </li>
              @endforeach
          </ul>
      </div>
      @endif

    	<div id="car-form">
        	<form id="create-car-form"  action="/upload-car" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
              <div class="col-md-4">
                <label for="carfor" class="form-label"><strong>Submit car for?</strong></label>
                <select  id="carfor" name="carfor" class="form-select">
                  @if (Session::get('carfor') != "")
                  <option selected>{{ Session::get('carfor') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option value="Car of the year award">Car of the year award</option>
                  <option>PSV of the year award</option>
                  <option>Car for Auction</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="category" class="form-label">Category</label>
                <select id="category" name="category" class="form-select" required>
                  @if (Session::get('category') != "")
                  <option selected >{{ Session::get('category') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
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
              <div class="col-md-4">
                <label for="make" class="form-label">Make</label>
                <select id="make" name="make" class="form-select" required>
                  @if (Session::get('make') != "")
                  <option selected>{{ Session::get('make') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  @foreach ($carmakewithmodels as $carmakewithmodel => $carmodels)
                      <option>{{$carmakewithmodel}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label for="model" class="form-label">Model</label>
                <select id="model" name="model" class="form-select" required>
                  @if (Session::get('model') != "")
                  <option selected>{{ Session::get('model') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                </select>
              </div>
              <div class="col-md-4">
                <label for="manufacture_year" class="form-label">Year of Manufacture</label>
                <input type="number" min="1900" max="2023" step="1" name="manufacture_year" id="manufacture_year" value="{{ Session::get('manufacture_year') ?? "2021" }}" class="form-control" id="engine_cc" value="{{ Session::get('vehicle_reg') ?? ""}}" required name="engine_cc" placeholder="1500">
              </div>
              <div class="col-md-4">
                <label for="location" class="form-label">Location</label>
                <select id="location" name="location" class="form-select" required>
                  @if (Session::get('location') != "")
                  <option selected>{{ Session::get('location') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option>Nairobi</option>
                  <option>Mombasa</option>
                  <option>Nakuru</option>
                  <option>Eldoret</option>
                  <option>Embu</option>
                  <option>Garissa</option>
                  <option>Kakamega</option>
                  <option>Lamu</option>
                  <option>Meru</option>
                  <option>Nyeri</option>
                  <option>Thika</option>
                  <option>Kitale</option>
                  <option>Kisumu</option>
                  <option>Bungoma</option>
                  <option>Naivasha</option>
                  <option>Kericho</option>
                  <option>Nanyuki</option>
                  <option>Other</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="engine_cc" class="form-label">Engine cc</label>
  				<input type="text" class="form-control" id="engine_cc" value="{{ Session::get('vehicle_reg') ?? ""}}" required name="engine_cc" placeholder="1500">
              </div>
              <div class="col-md-4">
                <label for="transmission" class="form-label">Transmission</label>
                <select id="transmission" name="transmission" class="form-select" required>
                  @if (Session::get('transmission') != "")
                  <option selected>{{ Session::get('transmission') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option>Automatic</option>
                  <option>Manual</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="fuel_type" class="form-label">Fuel Type</label>
                <select id="fuel_type" name="fuel_type" class="form-select" required>
                  @if (Session::get('fuel_type') != "")
                  <option selected>{{ Session::get('fuel_type') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option>Petrol</option>
                  <option>Diesel</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="interior_color" class="form-label">Interior color</label>
                <select id="interior_color" name="interior_color" class="form-select" required>
                  @if (Session::get('interior_color') != "")
                  <option selected>{{ Session::get('interior_color') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option>Dark</option>
                  <option>White</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="exterior_color" class="form-label">Exterior color</label>
                <select id="exterior_color" name="exterior_color"  class="form-select" required>
                  @if (Session::get('exterior_color') != "")
                  <option selected>{{ Session::get('exterior_color') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option>Black</option>
                  <option>Pearl White</option>
                  <option>Grey</option>
                  <option>Silver</option>
                  <option>Red</option>
                  <option>Blue</option>
                  <option>Brown</option>
                  <option>Green</option>
                  <option>Beige</option>
                  <option>Orange</option>
                  <option>Gold</option>
                  <option>Yellow</option>
                  <option>Pink</option>
                  <option>Purple</option>
                </select>
              </div>
              <div class="col-md-4">
                <label for="vehicl_reg" class="form-label">Vehicle Registration</label>
  				<input type="text" class="form-control" id="vehicle_reg" value="{{ Session::get('vehicle_reg') ?? ""}}" required name="vehicle_reg" placeholder="KAA 000A">
              </div>
              <div class="col-md-4">
                <label for="price" class="price form-label">Price(Kshs)</label>
  				<input type="number" class="form-control" id="price" value="{{ Session::get('price') ?? ""}}" name="price" placeholder="800,000 (Car for Auction)">
              </div>
              <div class="col-md-4">
                <label for="vehicle-name" class="vehicle_name form-label">Vehicle Name</label>
  				<input type="text" class="form-control" id="vehicle_name" value="{{ Session::get('vehicle_name') ?? ""}}" name="vehicle_name" placeholder="Vehicle Name (PSV)">
              </div>
              <div class="col-md-4">
                <label for="sacco-name" class="sacco_name form-label">Sacco Name</label>
  				<input type="text" class="form-control" id="sacco_name" value="{{ Session::get('sacco_name') ?? ""}}" name="sacco_name" placeholder="Sacco Name (PSV)">
              </div>
              <div class="col-md-4">
                <label for="route" class="route form-label">Route</label>
  				<input type="text" class="form-control" id="route"  value="{{ Session::get('route') ?? ""}}" name="route"  placeholder="Route (PSV)">
              </div>
              <div class="col-12">
                <label for="description" class="form-label">Description(What is unique about this car?)</label>
  				<textarea class="form-control" id="description" required name="description" rows="3">{{ Session::get('description') ?? ""}}
          </textarea>
              </div>
              <div class="col-md-4">
                <label for="photos" class="form-label">Upload car photos(Max 10)</label>
  				<input class="form-control" type="file"  name="photos[]" id="photos" multiple required>
        </div>
              
              <div class="col-12">
                <button id="createcar"  type="submit" class="btn btn-primary">Save Details</a>
              </div>
            </form>
        

        </div> <!--==end of <div id="car-form">==-->
    </div> <!--==end of <div id="page-contents">==-->

</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="wrapper-inner">==-->


<div id="newsletter-wrap">
<div id="container">
	<img src="images/news-line.jpg" class="news-line">
	<h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
    <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
    <form id="newsletter">
        <input type="email" id="newsInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address">
		<button type="submit" class="btn btn-primary">SIGN UP</button>
    </form>
</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="newsletter-wrap">==-->

<div id="sponsors">
<div id="container">
	<h1>SPONSORS/PARTNERS</h1>
	<img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="sponsors">==-->

  @include('layouts.partials.footer')
      
@endsection
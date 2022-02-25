@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Public Auction'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    <p>Mombasa Autoshow will pioneer the auto auction industry; establishing the first live public auto auction facility in the Kenya. The auction will be in person event <br>
      To participate:-</p>
      <ul>
  <li>Register /Sign up</li>
  <li>Share the details of the cars (used & repairable vehicles.) you intends to auction.</li>
  </ul>
      <div class="row g-3">
        <div class="col-sm-8">
          <input type="text" id="searchauctioncar" class="form-control" placeholder="Search for car by make,model or any keyword" aria-label="Search car">
        </div>
        <div class="col-sm-4">
          <a href="/create-car" class="btn2" style="margin-top:0;">Submit a Car</a>
        </div>
      </div>
   <!-- =======end of Search====-->
   <div class="row g-3" style="margin-top:5px;">
      <div class="col-sm-3">
        <label class="visually-hidden" for="autoSizingSelect">Category</label>
        <select class="form-select searchauctioncarcategory" id="autoSizingSelect">
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
        <select class="form-select searchauctioncarmake" id="autoSizingSelect">
          <option selected>Make...</option>
          @foreach ($carmakewithmodels as $carmakewithmodel => $carmodels)
          <option>{{$carmakewithmodel}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-3">
        <label class="visually-hidden" for="autoSizingSelect">Model</label>
        <select class="form-select searchauctionmodel" id="autoSizingSelect">
          <option selected>Model...</option>
        </select>
      </div>
      <div class="col-sm-3">
        <label class="visually-hidden" for="autoSizingSelect">Year of Award</label>
        <select class="form-select" id="autoSizingSelect">
          <option selected>Year of Award...</option>
          <option value="1">2022</option>
        </select>
      </div>
    </div>
	<!--===end of filter ==-->
  
 @if(Auth::check())

 @foreach ($AuctionCars as $AuctionCar)
 
    @if(in_array($AuctionCar->id,$reservedCarsIDs))

       <div id="car-wrap" class="auction-car">
        <a href="/auction-cardetails/{{ $AuctionCar->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$AuctionCar->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
          <table class="table">
            <tbody>
              <tr>
                <td colspan="2"><a href="/auction-cardetails/{{ $AuctionCar->id }}" class="title3"><strong>{{ $AuctionCar->vehicle_name }}</strong></a></td>
              </tr>
              <tr>
                <td>{{ $AuctionCar->manufacture_year }}</td>
                <td>{{ $AuctionCar->location }}</td>
              </tr>
              <tr>
                <td>Price(Kshs) </td>
                <td><strong>{{ $AuctionCar->price }}</strong></td>
              </tr>
              <tr>
                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              
            </tbody>
          </table>
      </div> <!--==end of <div id="car-wrap">==-->

        @else
          
        <div id="car-wrap" class="auction-car">
          <a href="/auction-cardetails/{{ $AuctionCar->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$AuctionCar->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
            <table class="table">
              <tbody>
                <tr>
                  <td colspan="2"><a href="/auction-cardetails/{{ $AuctionCar->id }}" class="title3"><strong>{{ $AuctionCar->vehicle_name }}</strong></a></td>
                </tr>
                <tr>
                  <td>{{ $AuctionCar->manufacture_year }}</td>
                  <td>{{ $AuctionCar->location }}</td>
                </tr>
                <tr>
                  <td>Price(Kshs) </td>
                  <td><strong>{{ $AuctionCar->price }}</strong></td>
                </tr>
                <tr>
                  <td><a href="/reserve-car/{{ $AuctionCar->id }}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                  <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                </tr>
                
              </tbody>
            </table>
        </div> <!--==end of <div id="car-wrap">==-->
         
       @endif
    
 @endforeach 
        
 @else

 @foreach ($AuctionCars as $AuctionCar)

 <div id="car-wrap" class="auction-car">
  <a href="/auction-cardetails/{{ $AuctionCar->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$AuctionCar->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
    <table class="table">
      <tbody>
        <tr>
          <td colspan="2"><a href="/login" class="title3"><strong>{{ $AuctionCar->vehicle_name }}</strong></a></td>
        </tr>
        <tr>
          <td>{{ $AuctionCar->manufacture_year }}</td>
          <td>{{ $AuctionCar->location }}</td>
        </tr>
        <tr>
          <td>Price(Kshs) </td>
          <td><strong>{{ $AuctionCar->price }}</strong></td>
        </tr>
        <tr>
          <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        
      </tbody>
    </table>
</div> <!--==end of <div id="car-wrap">==-->
   
 @endforeach
   
 @endif 

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
@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'My Auction Cars'])

<div id="wrapper-inner">
<div id="container">

  {{-- display success message on a successful action --}}
  @if(Session::has('success'))
  <div style="width:95%; margin:auto" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
  </div>
  @endif

	<div id="page-contents">

    <div style="width:100%; float:left;"><a href="/create-car" class="btn2">Submit a Car</a></div>
    <h3 class="title2">MY CARS FOR AUCTION</h3>

    @foreach ($AuctionCars as $AuctionCar)

      @if(in_array($AuctionCar->id,$reservedCarsIDs))

         <div id="car-wrap">
          <a href="auction-cardetails/{{ $AuctionCar->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$AuctionCar->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
            <table class="table">
              <tbody>
                <tr>
                  <td colspan="2"><a href="/auction-cardetails/{{ $AuctionCar->id }}" class="title3"><strong>{{ $AuctionCar->vehicle_name }}</strong></a></td>
                </tr>
                <tr>
                  <td>{{ $AuctionCar->manufacture_year}}</td>
                  <td>{{ $AuctionCar->location }}</td>
                </tr>
                <tr>
                  <td>Price(Kshs) </td>
                  <td><strong>{{ $AuctionCar->price }}</strong></td>
                </tr>
                  @if ($AuctionCar->published == 'YES')
                    <tr>
                      <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                      <td><a  href="/unpublish-auction-car/{{ $AuctionCar->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                      <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                    </tr>
                    <tr>
                      <td ><a style="width:84%;" href="/edit-vehicle/{{ $AuctionCar->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                      <td><a style="width:84%;" href="/delete-auction-car/{{ $AuctionCar->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
                    </tr>
                  @else
                    <tr>
                      <td><a href="/publish-car/{{$AuctionCar->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
                      <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                    </tr>
                    <tr>
                      <td ><a style="width:84%;" href="/edit-vehicle/{{ $AuctionCar->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                      <td><a style="width:84%;" href="/delete-auction-car/{{ $AuctionCar->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
                    </tr>
                  @endif
              </tbody>
            </table>
        </div> <!--==end of <div id="car-wrap">==-->

        @else

        <div id="car-wrap">
          <a href="auction-cardetails/{{ $AuctionCar->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$AuctionCar->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
            <table class="table">
              <tbody>
                <tr>
                  <td colspan="2"><a href="/auction-cardetails/{{ $AuctionCar->id }}" class="title3"><strong>{{ $AuctionCar->vehicle_name }}</strong></a></td>
                </tr>
                <tr>
                  <td>{{ $AuctionCar->manufacture_year}}</td>
                  <td>{{ $AuctionCar->location }}</td>
                </tr>
                <tr>
                  <td>Price(Kshs) </td>
                  <td><strong>{{ $AuctionCar->price }}</strong></td>
                </tr>
                @if ($AuctionCar->published == 'YES')
                    <tr>
                      <td><a href="/reserve-mycar/{{ $AuctionCar->id }}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                      <td><a  href="/unpublish-auction-car/{{ $AuctionCar->id }}" type="button" class="btn btn-info btn-sm" disabled>unpublish</a></td>
                      <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                    </tr>
                    <tr>
                      <td ><a style="width:84%;" href="/edit-vehicle/{{ $AuctionCar->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                      <td><a style="width:84%;" href="/delete-auction-car/{{ $AuctionCar->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
                    </tr>
                  @else
                    <tr>
                      <td><a href="/publish-car/{{$AuctionCar->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
                      <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                    </tr>
                    <tr>
                      <td ><a style="width:84%;" href="/edit-vehicle/{{ $AuctionCar->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                      <td><a style="width:84%;" href="/delete-auction-car/{{ $AuctionCar->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
                    </tr>
                  @endif                
              </tbody>
            </table>
        </div> <!--==end of <div id="car-wrap">==-->
           
         @endif
          
   @endforeach  
    
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
@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Car of the Year'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    <p>The Mombasa Autoshow car awards aim to celebrate and honor those Technology and Automotive products and innovations that have paved the way for the future of these sectors and set benchmarks in their respective fields while helping Kenyans make better decisions when buying cars. The general public is invited to submit their cars for voting. Winners of the competition will receive cash prize,trophies and many more giveaways.</p>    <div class="row g-3">
      <div class="col-sm-8">
        <input type="text" name="searchcar" id="searchcar" class="form-control" placeholder="Search for car by make,model or any keyword" aria-label="Search car">
      </div>
      <div class="col-sm-4">
        <a href="/create-car" class="btn2" style="margin-top:0;">Submit a Car</a>
      </div>
    </div>
   <!-- =======end of Search====-->
   <div class="row g-3" style="margin-top:5px;">
      <div class="col-sm-3">
        <label class="visually-hidden" for="autoSizingSelect">Category</label>
        <select class="form-select searchcarcategory" id="autoSizingSelect">
            <option selected id="defaultcategory">Category...</option>
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
        <select class="form-select searchcarmake" id="autoSizingSelect">
          <option selected id="defaultmake">Make...</option>
           @foreach ($carmakewithmodels as $carmakewithmodel => $carmodels)
                      <option>{{$carmakewithmodel}}</option>
           @endforeach
        </select>
      </div>
      <div class="col-sm-3">
        <label class="visually-hidden " for="autoSizingSelect">Model</label>
        <select class="form-select searchcarmodel" id="autoSizingSelect">
          <option selected  id="defaultmodel">Model...</option>
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

     {{-- user logged in --}}
     @foreach ($Cars as $Car )
   
     @if($voted)
   
     @if (!in_array($Car->category,$userVotedCategories))
   
     <div id="car-wrap" class="car">
       <a href="/car-details/{{ $Car->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$Car->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
         <table class="table">
           <tbody>
             <tr>
               <td colspan="2"><a href="/car-details/{{ $Car->id }}" class="title3"><strong>{{ $Car->vehicle_name }}</strong></a></td>
             </tr>
             <tr>
               <td>{{ $Car->manufacture_year}}</td>
               <td>{{ $Car->location }}</td>
             </tr>
             <tr>
               <td>Total votes: </td>
               <td><strong>{{ $Car->votes }}</strong></td>
             </tr>
             <tr>
               <td><a href="/vote-for-car/{{ $Car->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
               <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
             </tr>
             
           </tbody>
         </table>
     </div> <!--==end of <div id="car-wrap">==-->
   
     @else
   
     <div id="car-wrap" class="car">
       <a href="/car-details/{{ $Car->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$Car->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
         <table class="table">
           <tbody>
             <tr>
               <td colspan="2"><a href="/car-details/{{ $Car->id }}" class="title3"><strong>{{ $Car->vehicle_name }}</strong></a></td>
             </tr>
             <tr>
               <td>{{ $Car->manufacture_year}}</td>
               <td>{{ $Car->location }}</td>
             </tr>
             <tr>
               <td>Total votes: </td>
               <td><strong>{{ $Car->votes }}</strong></td>
             </tr>
             <tr>
               <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
               <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
             </tr>
           </tbody>
         </table>
     </div> <!--==end of <div id="car-wrap">==-->
       
     @endif
   
     @else
   
     <div id="car-wrap" class="car">
       <a href="/car-details/{{ $Car->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$Car->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
         <table class="table">
           <tbody>
             <tr>
               <td colspan="2"><a href="/car-details/{{ $Car->id }}" class="title3"><strong>{{ $Car->vehicle_name }}</strong></a></td>
             </tr>
             <tr>
               <td>{{ $Car->manufacture_year}}</td>
               <td>{{ $Car->location }}</td>
             </tr>
             <tr>
               <td>Total votes: </td>
               <td><strong>{{ $Car->votes }}</strong></td>
             </tr>
             <tr>
               <td><a href="/vote-for-car/{{ $Car->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
               <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
             </tr>
             
           </tbody>
         </table>
     </div> <!--==end of <div id="car-wrap">==-->
   
     @endif
   
     @endforeach 
    
    @else


     {{-- user Not logged in --}}
     @foreach ($Cars as $Car )
       
     <div id="car-wrap" class="car">
      <a href="/car-details/{{ $Car->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$Car->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="/car-details/{{ $Car->id }}" class="title3"><strong>{{ $Car->vehicle_name }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $Car->manufacture_year}}</td>
              <td>{{ $Car->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $Car->votes }}</strong></td>
            </tr>
            <tr>
              <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
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
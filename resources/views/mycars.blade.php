@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'My Cars'])

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
    <h3 class="title2">MY CARS FOR AWARDS</h3>

 @foreach ($Cars as $Car )

  @if($voted)

  @if (!in_array($Car->category,$userVotedCategories))

  <div id="car-wrap">
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
          @if( $Car->published == 'YES')
              <tr>
                <td><a href="/vote-for-mycar/{{ $Car->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                <td><a  href="/unpublish-car/{{ $Car->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-vehicle/{{  $Car->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-car/{{  $Car->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
          @else
          <tr>
            <td><a href="/publish-car/{{$Car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
          </tr>
          <tr>
            <td ><a style="width:84%;" href="/edit-vehicle/{{  $Car->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
            <td><a style="width:84%;" href="/delete-car/{{  $Car->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
          </tr>
          @endif
        </tbody>
      </table>
  </div> <!--==end of <div id="car-wrap">==-->

  @else

  <div id="car-wrap">
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
          @if ($Car->published == 'YES')
            <tr>
              <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
              <td><a  href="/unpublish-car/{{ $Car->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
            <tr>
              <td ><a style="width:84%;" href="/edit-vehicle/{{ $Car->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
              <td><a style="width:84%;" href="/delete-car/{{  $Car->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
            </tr>
          @else
            <tr>
              <td><a href="/publish-car/{{$Car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
            <tr>
              <td ><a style="width:84%;" href="/edit-vehicle/{{  $Car->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
              <td><a style="width:84%;" href="/delete-car/{{  $Car->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
            </tr>
          @endif
        </tbody>
      </table>
  </div> <!--==end of <div id="car-wrap">==-->
    
  @endif

  @else

  <div id="car-wrap">
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
          @if($Car->published == 'YES')
            <tr>
              <td><a href="/vote-for-mycar/{{ $Car->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
              <td><a  href="/unpublish-car/{{ $Car->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
            <tr>
              <td ><a style="width:84%;" href="/edit-vehicle/{{  $Car->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
              <td><a style="width:84%;" href="/delete-car/{{  $Car->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
            </tr>
            @else
            <tr>
              <td><a href="/publish-car/{{$Car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
            <tr>
              <td ><a style="width:84%;" href="/edit-vehicle/{{ $Car->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
              <td><a style="width:84%;" href="/delete-car/{{  $Car->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
            </tr>
          @endif
        </tbody>
      </table>
  </div> <!--==end of <div id="car-wrap">==-->

  @endif

  @endforeach 

  <h3 class="title2">MY CAR VOTES</h3>

  @foreach ( $carVotes as $Car )

  @if ($Car[0]->carfor == 'Car of the year award')
  <div id="car-wrap">
    <a href="/car-details/{{ $Car[0]->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$Car[0]->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
      <table class="table">
        <tbody>
          <tr>
            <td colspan="2" style="font-weight:bold; color:purple;"><strong>{{ $Car[0]->vehicle_name }}</strong></td>
          </tr>
          <tr>
            <td>Title</td>
            <td>{{ $Car[0]->carfor }}</td>
          </tr>
          <tr>
            <td>{{ $Car[0]->manufacture_year}}</td>
            <td>{{ $Car[0]->location }}</td>
          </tr>
          <tr>
            <td>Category</td>
            <td>{{ $Car[0]->category }}</td>
          </tr>
          <tr>
            <td>Total votes: </td>
            <td><strong>{{ $Car[0]->votes }}</strong></td>
          </tr>
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
@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'My PSVs'])

<div id="wrapper-inner">
<div id="container">

    {{-- display success message on a successful action --}}
    @if(Session::has('success'))
    <div style="width:95%; margin:auto" class="alert alert-success" role="alert">
      {{ Session::get('success') }}
    </div>
    @endif

	<div id="page-contents">
    <div style="width:100%; float:left;"><a href="/create-car" class="btn2">Submit a PSV</a></div>
    <h3 class="title2">MY PSVs FOR AWARDS</h3>

    @foreach ($PSVs as $PSV)

    @if($voted)

    @if (!in_array($PSV->category,$userVotedCategories))

    <div id="car-wrap">
    	<a href="/psv-details/{{ $PSV->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$PSV->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="/psv-details/{{ $PSV->id }}" class="title3"><strong>{{ $PSV->vehicle_name }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $PSV->manufacture_year}}</td>
              <td>{{ $PSV->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $PSV->votes }}</strong></td>
            </tr>
            @if( $PSV->published == 'YES')
              <tr>
                <td><a href="/vote-for-mypsv/{{ $PSV->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                <td><a  href="/unpublish-psv/{{ $PSV->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-vehicle/{{  $PSV->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-psv/{{  $PSV->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
            @else
              <tr>
                <td><a href="/publish-car/{{$PSV->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-vehicle/{{  $PSV->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-psv/{{  $PSV->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
            @endif            
          </tbody>
        </table>
    </div> <!--==end of <div id="car-wrap">==-->

    @else

    <div id="car-wrap">
    	<a href="/psv-details/{{ $PSV->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$PSV->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="/psv-details/{{ $PSV->id }}" class="title3"><strong>{{ $PSV->vehicle_name }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $PSV->manufacture_year}}</td>
              <td>{{ $PSV->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $PSV->votes }}</strong></td>
            </tr>
            @if( $PSV->published == 'YES')
              <tr>
                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                <td><a  href="/unpublish-psv/{{ $PSV->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-vehicle/{{  $PSV->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-psv/{{  $PSV->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
            @else
              <tr>
                <td><a href="/publish-car/{{$PSV->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-vehicle/{{  $PSV->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-psv/{{  $PSV->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
            @endif  
          </tbody>
        </table>
    </div> <!--==end of <div id="car-wrap">==-->

    @endif
    
    @else
     
    <div id="car-wrap">
    	<a href="/psv-details/{{ $PSV->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$PSV->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><a href="/psv-details/{{ $PSV->id }}" class="title3"><strong>{{ $PSV->vehicle_name }}</strong></a></td>
            </tr>
            <tr>
              <td>{{ $PSV->manufacture_year}}</td>
              <td>{{ $PSV->location }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $PSV->votes }}</strong></td>
            </tr>
            @if( $PSV->published == 'YES')
              <tr>
                <td><a href="/vote-for-mypsv/{{ $PSV->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                <td><a  href="/unpublish-psv/{{ $PSV->id }}" type="button" class="btn btn-info btn-sm" >unpublish</a></td>
                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
              </tr>
              <tr>
                <td ><a style="width:84%;" href="/edit-vehicle/{{  $PSV->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
                <td><a style="width:84%;" href="/delete-psv/{{  $PSV->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
              </tr>
          @else
            <tr>
              <td><a href="/publish-car/{{$PSV->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
              <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
            </tr>
            <tr>
              <td ><a style="width:84%;" href="/edit-vehicle/{{  $PSV->id }}" type="button" class="btn btn-primary btn-sm" disabled>Edit</a></td>
              <td><a style="width:84%;" href="/delete-psv/{{  $PSV->id }}" type="button" class="btn btn-danger btn-sm" disabled>delete</a></td>
            </tr>
          @endif             
          </tbody>
        </table>
    </div> <!--==end of <div id="car-wrap">==-->

    @endif
    
    @endforeach

    <h3 class="title2">MY PSV VOTES</h3>
    @foreach ( $PSVVotes as $PSV )

    @if( $PSV[0]->carfor == 'PSV of the year award')

    <div id="car-wrap">
    	<a href="/psv-details/{{ $PSV[0]->id }}"><img src="vehicle_images/{{ App\Models\Image::where('car_id','=',$PSV[0]->id)->pluck('image_url')[0] }}" class="car-thumb" /></a>
        <table class="table">
          <tbody>
            <tr>
              <td colspan="2"><strong style="color:purple; font-weight:800;">{{ $PSV[0]->vehicle_name }}</strong></td>
            </tr>
            <tr>
              <td>Title</td>
              <td>{{ $PSV[0]->carfor }}</td>
            </tr>
            <tr>
              <td>{{ $PSV[0]->manufacture_year }}</td>
              <td>{{ $PSV[0]->location }}</td>
            </tr>
            <tr>
              <td>Category</td>
              <td>{{ $PSV[0]->category }}</td>
            </tr>
            <tr>
              <td>Total votes: </td>
              <td><strong>{{ $PSV[0]->votes }}</strong></td>
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
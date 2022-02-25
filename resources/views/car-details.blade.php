@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Car Details'])

<div id="wrapper-inner">
<div id="container">

  @if(Auth::check())

  @if($voted)

  @if(!in_array($car->category,$userVotedCategories))

  <div id="page-contents">
    <div id="left-col">
        <h3 class="title2">{{ $car->vehicle_name }}</h3>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img src="vehicle_images/{{ $carImages[0]->image_url }}" class="d-block w-100" alt="...">
            </div>

            @foreach ($carImages as $carImage)

            <div class="carousel-item ">
              <img src="vehicle_images/{{ $carImage->image_url }}" class="d-block w-100" alt="...">
            </div>
              
            @endforeach
          
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!--==============end of carousel =======-->
        <h3 class="title2">What is unique about this car?</h3>
        <p>{{ $car->description }}</p>
    </div> <!--==end of <div id="left-col">==-->
    <div id="right-col">
      <h3 class="title2" style="margin-left:7px;">  Vehicle Desciption</h3>
        <table class="table">
      <tbody>
        <tr>
          <td colspan="2"><a href="car-details/{{ $car->id }}" class="title3"><strong>{{ $car->vehicle_name }}</strong></a></td>
        </tr>
        <tr>
          <td>{{ $car->manufacture_year}}</td>
          <td>{{ $car->location }}</td>
        </tr>
        <tr>
          <td>Total votes: </td>
          <td><strong>{{ $car->votes }}</strong></td>
        </tr>
        <tr>
          <td>Car Category</td>
          <td><strong>{{ $car->category }}</strong></td>
        </tr>
        <tr>
          <td>Engine CC </td>
          <td>{{ $car->engine_cc }}</td>
        </tr>
        <tr>
          <td>Transmission </td>
          <td>{{ $car->transmission }}</td>
        </tr>
        <tr>
          <td>Fuel Type </td>
          <td>{{ $car->fuel_type }}</td>
        </tr>
        <tr>
          <td>Interior color </td>
          <td>{{ $car->interior_color }}</td>
        </tr>
        <tr>
          <td>Exterior color</td>
          <td>{{ $car->exterior_color }}</td>
        </tr>
        <tr>
          <td>Vehicle Registration</td>
          <td>{{ $car->vehicle_reg }}</td>
        </tr>
        @if( $car->published == 'YES')
        <tr>
          <td><a href="/vote-for-car-on-display/{{ $car->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @else
        <tr>
          <td><a href="/publish-car/{{$car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @endif        
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->

  @else

  <div id="page-contents">
    <div id="left-col">
        <h3 class="title2">{{ $car->vehicle_name }}</h3>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img src="vehicle_images/{{ $carImages[0]->image_url }}" class="d-block w-100" alt="...">
            </div>

            @foreach ($carImages as $carImage)

            <div class="carousel-item ">
              <img src="vehicle_images/{{ $carImage->image_url }}" class="d-block w-100" alt="...">
            </div>
              
            @endforeach
          
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!--==============end of carousel =======-->
        <h3 class="title2">What is unique about this car?</h3>
        <p>{{ $car->description }}</p>
    </div> <!--==end of <div id="left-col">==-->
    <div id="right-col">
      <h3 class="title2" style="margin-left:7px;">  Vehicle Desciption</h3>
        <table class="table">
      <tbody>
        <tr>
          <td colspan="2"><a href="car-details/{{ $car->id }}" class="title3"><strong>{{ $car->vehicle_name }}</strong></a></td>
        </tr>
        <tr>
          <td>{{ $car->manufacture_year}}</td>
          <td>{{ $car->location }}</td>
        </tr>
        <tr>
          <td>Total votes: </td>
          <td><strong>{{ $car->votes }}</strong></td>
        </tr>
        <tr>
          <td>Car Category</td>
          <td><strong>{{ $car->category }}</strong></td>
        </tr>
        <tr>
          <td>Engine CC </td>
          <td>{{ $car->engine_cc }}</td>
        </tr>
        <tr>
          <td>Transmission </td>
          <td>{{ $car->transmission }}</td>
        </tr>
        <tr>
          <td>Fuel Type </td>
          <td>{{ $car->fuel_type }}</td>
        </tr>
        <tr>
          <td>Interior color </td>
          <td>{{ $car->interior_color }}</td>
        </tr>
        <tr>
          <td>Exterior color</td>
          <td>{{ $car->exterior_color }}</td>
        </tr>
        <tr>
          <td>Vehicle Registration</td>
          <td>{{ $car->vehicle_reg }}</td>
        </tr>
        @if( $car->published == 'YES')
        <tr>
          <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @else
        <tr>
          <td><a href="/publish-car/{{$car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @endif 
       
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->
  
  @endif

  @else

  <div id="page-contents">
    <div id="left-col">
        <h3 class="title2">{{ $car->vehicle_name }}</h3>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img src="vehicle_images/{{ $carImages[0]->image_url }}" class="d-block w-100" alt="...">
            </div>

            @foreach ($carImages as $carImage)

            <div class="carousel-item ">
              <img src="vehicle_images/{{ $carImage->image_url }}" class="d-block w-100" alt="...">
            </div>
              
            @endforeach
          
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!--==============end of carousel =======-->
        <h3 class="title2">What is unique about this car?</h3>
        <p>{{ $car->description }}</p>
    </div> <!--==end of <div id="left-col">==-->
    <div id="right-col">
      <h3 class="title2" style="margin-left:7px;">  Vehicle Desciption</h3>
        <table class="table">
      <tbody>
        <tr>
          <td colspan="2"><a href="car-details/{{ $car->id }}" class="title3"><strong>{{ $car->vehicle_name }}</strong></a></td>
        </tr>
        <tr>
          <td>{{ $car->manufacture_year}}</td>
          <td>{{ $car->location }}</td>
        </tr>
        <tr>
          <td>Total votes: </td>
          <td><strong>{{ $car->votes }}</strong></td>
        </tr>
        <tr>
          <td>Car Category</td>
          <td><strong>{{ $car->category }}</strong></td>
        </tr>
        <tr>
          <td>Engine CC </td>
          <td>{{ $car->engine_cc }}</td>
        </tr>
        <tr>
          <td>Transmission </td>
          <td>{{ $car->transmission }}</td>
        </tr>
        <tr>
          <td>Fuel Type </td>
          <td>{{ $car->fuel_type }}</td>
        </tr>
        <tr>
          <td>Interior color </td>
          <td>{{ $car->interior_color }}</td>
        </tr>
        <tr>
          <td>Exterior color</td>
          <td>{{ $car->exterior_color }}</td>
        </tr>
        <tr>
          <td>Vehicle Registration</td>
          <td>{{ $car->vehicle_reg }}</td>
        </tr>
        @if( $car->published == 'YES')
        <tr>
          <td><a href="/vote-for-car-on-display/{{ $car->id }}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @else
        <tr>
          <td><a href="/publish-car/{{$car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @endif 
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->
    
  @endif

  @else
 
  {{-- user not logged in --}}
  <div id="page-contents">
    <div id="left-col">
        <h3 class="title2">{{ $car->vehicle_name }}</h3>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">

            <div class="carousel-item active">
              <img src="vehicle_images/{{ $carImages[0]->image_url }}" class="d-block w-100" alt="...">
            </div>

            @foreach ($carImages as $carImage)

            <div class="carousel-item ">
              <img src="vehicle_images/{{ $carImage->image_url }}" class="d-block w-100" alt="...">
            </div>
              
            @endforeach
          
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
        <!--==============end of carousel =======-->
        <h3 class="title2">What is unique about this car?</h3>
        <p>{{ $car->description }}</p>
    </div> <!--==end of <div id="left-col">==-->
    <div id="right-col">
      <h3 class="title2" style="margin-left:7px;">  Vehicle Desciption</h3>
        <table class="table">
      <tbody>
        <tr>
          <td colspan="2"><a href="car-details/{{ $car->id }}" class="title3"><strong>{{ $car->vehicle_name }}</strong></a></td>
        </tr>
        <tr>
          <td>{{ $car->manufacture_year}}</td>
          <td>{{ $car->location }}</td>
        </tr>
        <tr>
          <td>Total votes: </td>
          <td><strong>{{ $car->votes }}</strong></td>
        </tr>
        <tr>
          <td>Car Category</td>
          <td><strong>{{ $car->category }}</strong></td>
        </tr>
        <tr>
          <td>Engine CC </td>
          <td>{{ $car->engine_cc }}</td>
        </tr>
        <tr>
          <td>Transmission </td>
          <td>{{ $car->transmission }}</td>
        </tr>
        <tr>
          <td>Fuel Type </td>
          <td>{{ $car->fuel_type }}</td>
        </tr>
        <tr>
          <td>Interior color </td>
          <td>{{ $car->interior_color }}</td>
        </tr>
        <tr>
          <td>Exterior color</td>
          <td>{{ $car->exterior_color }}</td>
        </tr>
        <tr>
          <td>Vehicle Registration</td>
          <td>{{ $car->vehicle_reg }}</td>
        </tr>
        @if( $car->published == 'YES')
        <tr>
          <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @else
        <tr>
          <td><a href="/publish-car/{{$car->id}}" type="button" class="btn btn-info btn-sm">Publish</a></td>
          <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
        </tr>
        @endif 
       
      </tbody>
    </table>
    </div> <!--==end of <div id="right-col">==-->
</div> <!--==end of <div id="page-contents">==-->
    
  @endif
 
	

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

  @include('layouts.partials.footer')
    
@endsection
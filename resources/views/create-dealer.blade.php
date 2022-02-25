@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Create a dealer'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    
    {{-- display success message on a successful action --}}
    @if(session()->has('success'))
    <div class="alert alert-success mt-4 mb-3 ml-4 mr-4">
      {{ session()->get('success') }}
    </div>
    @endif


    {{-- display error on top of the form --}}
    @if($errors->any())
    <div  class="alert alert-info pl-2 pr-2 pt-2 pb-2 mt-3 ml-3 mr-3 mb-3">
        <ul class="list-group">
            @foreach ($errors->all() as $error )
            <li class="list-group-item text-red">
              {{ $error }}  
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    	<div id="register">        
        	<form class="row g-3" method="POST" action="/upload-dealer" enctype="multipart/form-data">
            @csrf
              <div class="col-md-6">
                <label for="dealername"  class="form-label">Dealer Name</label>
                <input type="dealername" value="{{ Session::get('dealername') ?? ""}}" name="dealername" class="form-control" id="dealername" required>
              </div>
              <div class="col-md-6">
                <label for="location" class="form-label">Location</label>
                <select id="location" name="location" class="select form-select" required>
                  @if (Session::get('exterior_color') != "")
                  <option selected>{{ Session::get('location') }}</option>
                  @else
                  <option selected>Choose...</option>
                  @endif
                  <option value="Nairobi">Nairobi</option>
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
              <div class="col-md-6">
                <label for="email"  class="form-label">Email</label>
                <input type="email" name="email" value="{{ Session::get('email') ?? ""}}" class="form-control" id="email" required>
              </div>
              <div class="col-md-6">
                <label for="phonenumber" class="form-label">Phone No.</label>
                <input type="phonenumber" name="phonenumber" value="{{ Session::get('phonenumber') ?? ""}}" class="form-control" id="phonenumber" required>
              </div>
              <div class="col-12">
                <label for="description"  class="form-label">Description(What is unique about this dealer?)</label>
  				     <textarea class="form-control" id="description" name="description" rows="3" required>{{ Session::get('description') ?? ""}}
               </textarea>
              </div>
              <div class="col-md-4">
                <label for="logo" class="form-label">Upload Logo</label>
  				<input name="logo" class="form-control" type="file" required>
              </div>              
              <div class="col-12">
                <button type="submit" class="btn btn-primary">Save Details</button>
              </div>
            </form>
        

        </div> <!--==end of <div id="register">==-->
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
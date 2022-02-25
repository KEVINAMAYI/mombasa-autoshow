@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'My Profile'])

<div id="wrapper-inner">
  <div id="container">
      <div id="page-contents">
          <div id="register">
            
            {{-- display success message on a successful action --}}
            @if (session()->has('success'))
            <div class="alert alert-success mt-4 mb-3 ml-4 mr-4">
              {{ session()->get('success') }}
            </div>
            @endif
            
            @yield('content')
            <!-- /.content -->


            {{-- display error on top of the form --}}
            @if ($errors->any())
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

            <form class="row g-3" method="POST" action="/updateuser/{{ auth()->id(); }}">
              @csrf
              <div class="row-md 12">

                
              </div>
                  <div class="col-md-6">
                      <label for="firstname" class="form-label">First Name</label>
                      <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{  Auth::user()->firstname; }}" required autocomplete="firstname" autofocus>
                      @error('firstname')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror 
                  </div>
                <div class="col-md-6">
                  <label for="lastname" class="form-label">Last Name</label>
                  <input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{  Auth::user()->lastname; }}" required autocomplete="lastname" autofocus>
                  @error('lastname')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror 
              </div>
              <div class="col-md-6">
                  <label for="email" class="form-label">Email</label>
                  <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{  Auth::user()->email; }}" required autocomplete="email" autofocus>
                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror 
              </div>
              <div class="col-md-6">
                  <label for="phonenumber" class="form-label">Phone Number</label>
                  <input id="phonenumber" type="number" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{  Auth::user()->phonenumber; }}" required autocomplete="phonenumber" autofocus>
                  @error('phonenumber')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror 
              </div>
                
                <div class="col-md-6">
                  <label for="country" class="form-label">Country</label>
                  <select id="country" class="form-select @error('country') is-invalid @enderror" name="country" value="{{  Auth::user()->country; }}" required>
                    <option selected>Choose...</option>
                    <option>Kenya</option>
                  </select>
                  
                  @error('country')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror 
                </div>
                <div class="col-md-6">
                  <label for="town" class="form-label">Town</label>
                  <select id="town" class="form-select @error('town') is-invalid @enderror" name="town" value="{{  Auth::user()->town; }}" required>
                    <option selected>Choose...</option>
                    <option>Nairobi</option>
                    <option>Mombasa</option>
                    <option>Kisumu</option>
                    <option>Nakuru</option>
                  </select>
                  @error('town')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                 @enderror 
                </div>
                <div class="col-md-6">
                  <label for="password" class="form-label">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{  Auth::user()->password; }}" required autocomplete="password" autofocus>
                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror 
              </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" name="password_confirmation" value="{{  Auth::user()->password; }}" required autocomplete="new-password" id="password-confirm">
                </div>
                
                <div class="col-12">
                  <button type="submit" class="btn btn-primary">Update Profile Account</button>
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
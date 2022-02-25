@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Confirmation Email'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    	<div id="login">
        <p style="color:#b39af2;">Please Enter Email to Receive Confirmatiom Link</p>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
         @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus id="email" aria-describedby="emailHelp"> 
            
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        </div>
          <button  type="submit" class="btn btn-primary">Send Password Reset Link</button>
        </form>
        </div> <!--==end of <div id="login">==-->
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

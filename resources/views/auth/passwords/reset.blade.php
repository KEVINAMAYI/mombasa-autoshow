@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Password Reset'])

<div id="wrapper-inner">
    <div id="container">
        <div id="page-contents">
            <div id="login">
            <p style="color:#b39af2;">Please enter your new password</p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus> 
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
              <div class="mb-3">
                <label for="password" class="form-label">New password</label>
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"> 
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
               @enderror  
            </div>
              <div class="mb-3">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" id="password-confirm">
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
              </div>
              <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
            <p style=" text-align:right; margin-top:10px;"><a href="/login">Login</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/register">Register</a></p>
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

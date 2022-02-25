@extends('layouts.header')

@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Login'])

<div id="wrapper-inner">
    <div id="container">
        <div id="page-contents">
            
            {{-- display success message on a successful action --}}
            @if(Session::has('success'))
            <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
            </div>
            @endif

            <div id="login">
            <p style="color:#b39af2;">Welcome to Mombasa Annual Motor Show</p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus aria-describedby="emailHelp"> 
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
            @enderror
            </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="exampleCheck1">Remember me</label>
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
            @if (Route::has('password.request'))
                <p style=" text-align:right; margin-top:10px;"><a href="{{ route('password.request') }}">Forgot Password</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="/register">Register</a></p>
           @endif
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

<!doctype html>
<html lang="en">
<head>
    <base href="{{ URL::to('/') }}">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mombasa Auto Show</title>
    <!-- Bootstrap CSS -->
    <link href="front-end/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="front-end/css/style.css" rel="stylesheet" type="text/css"/>


    <style>
        .dt-length label {
            text-transform: capitalize;
            padding: 10px; /* Adjust padding as needed */
        }
    </style>

@stack('css')

<!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
    <script src="front-end/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
</head>
<body>
<div id="top-bar">
    <div id="container">
        <div id="top-left">OCTOBER 30,2025/MAMA NGINA WATERFRONT MOMBASA.</div>
        <div id="top-right">
            <a href="#" class="youtube"></a>
            <a href="#" class="instagram"></a>
            <a href="#" class="facebook"></a>
            <a href="#" class="twitter"></a>
            <a href="{{ route('register') }}">REGISTER</a>
            <a href="{{ route('login') }}">LOGIN &nbsp;|&nbsp;</a>
        </div> <!--==end of <div id="top-right"> ==-->
    </div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="top-bar">==-->

@if(in_array(Route::currentRouteName(),['front-end.create-car','front-end.edit-car']))
    @yield('content')
@else
    {{ $slot }}
@endif

<div id="footer-wrap">
    <div id="container">
        <div id="footer-col">
            <h3>QUICK LINKS</h3>
            <ul>
                <li><a href="{{ route('front-end.index') }}">Home</a></li>
                <li><a href="{{ route('front-end.about') }}">About Event</a></li>
                <li><a href="{{ route('front-end.privacy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('front-end.contactus') }}">Contact Us</a></li>
            </ul>
        </div> <!--==end of <div id="footer-col">==-->
        <div id="footer-col">
            <h3>INFORMATION</h3>
            <ul>
                <li><a href="{{ route('login') }}">Login</a></li>
                <li><a href="{{ route('register') }}">Register</a></li>
                <li><a href="{{ route('front-end.terms') }}">Terms and Conditions</a></li>
                <li><a href="{{ route('front-end.faqs') }}">FAQs</a></li>
            </ul>
        </div> <!--==end of <div id="footer-col">==-->
        <div id="footer-col">
            <h3>AWARDS</h3>
            <ul>
                <li><a href="{{ route('front-end.car-awards') }}">Car of the year</a></li>
                <li><a href="{{ route('front-end.voting') }}">Voting Process</a></li>
            </ul>
        </div> <!--==end of <div id="footer-col">==-->
    </div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="footer-wrap">==-->

<div id="top-bar">
    <div id="container">
        <div id="top-left">Mombasa Auto Show,2025</div>
        <div id="top-right">
            <a href="#" class="youtube"></a>
            <a href="#" class="instagram"></a>
            <a href="#" class="facebook"></a>
            <a href="#" class="twitter"></a>
        </div> <!--==end of <div id="top-right"> ==-->
    </div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="top-bar">==-->

<!-- sweet alert js -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<x-livewire-alert::scripts/>

@stack('js')

</body>
</html>

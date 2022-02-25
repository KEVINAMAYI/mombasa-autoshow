@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Sponsors/Partners'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    
    <h3 class="title2">SPONSORS</h3>
    <p>
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    </p>
    
    <h3 class="title2">PARTNERS</h3>
     <p>
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    <img src="images/sponsor1.png" class="sponsors-img">
    </p>
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

    @include('layouts.partials.footer')

@endsection
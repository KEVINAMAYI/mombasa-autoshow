@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

@include('layouts.partials.navbar',['pagetitle' => 'Contact Us'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
    	<div class="date-wrap">
        	<img src="images/general.png">
            <h3>GENERAL <br> INQUIRIES</h3>
            <h4>Joseph Karani</h4>
            <p>+254 757629630 <br> info@mombasaautoshow.com</p>
        </div> <!--==end of <div class="date-wrap">==-->
        <div class="date-wrap">
        	<img src="images/exhibit.png">
            <h3>EXHIBIT <br> INQUIRIES</h3>
            <h4>Joseph Karani</h4>
            <p>+254 757629630 <br> info@mombasaautoshow.com</p>
        </div> <!--==end of <div class="date-wrap">==-->
        <div class="date-wrap">
        	<img src="images/sponsorship.png">
            <h3>SPONSORSHIP <br> INQUIRIES</h3>
            <h4>Joseph Karani</h4>
            <p>+254 757629630 <br> info@mombasaautoshow.com</p>
        </div> <!--==end of <div class="date-wrap">==-->
    
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
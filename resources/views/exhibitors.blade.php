@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')


@include('layouts.partials.navbar',['pagetitle' => 'Exhibitors'])

<div id="wrapper-inner">
<div id="container">
	<div id="page-contents">
        <p>Promoting your product, service, or brand to your customers with the hybrid format, including both a live audience and digital audience provides an exponential opportunity for brand exposure on a global stage.</p>  
        <p>Investment in a booth combined with a robust exhibitor profile product showcasing & sourcing platform will allow hundreds of exhibiting companies and thousands of trade professionals to engage and do business in a cost-effective manner.</p>
        <p>Exhibitors can build their online profile, upload collateral, and connect with industry experts directly through the profiles upon booking to maximize exposure and optimize deal-making year-round.</p>
        <h6><strong>Why Exhibit?</strong></h6>
        <ul>
        <li>Create and reinforce leadership in the automotive market</li>
        <li>Establish partnership and collaboration</li>
        <li>Get your brand and organization in front of leading Automotive  Industry professionals</li>
        <li>Launch new products, generate leads and make sales</li>
        <li>Meet industry leaders, understand their needs and develop business relationships</li>
        </ul>
        <h6><strong>Who Can Exhibit?</strong></h6>
        <div class="row">
            <div class="col">
            <ul>
        <li>Car Importers</li>
        <li>Car Assemblers</li>
        <li>Automobile Body Builders</li>
        <li>Battery Manufacturers</li>
        <li>Commercial Vehicle</li>
        <li>Construction Vehicles</li>
        <li>Car Decors</li>
        <li>Driving School</li>
            </ul>
            </div>
            <div class="col">
            <ul>
        <li>Car Washing & Care</li>
        <li>Finance Companies</li>
        <li>Insurance Companies</li>
        <li>Garage and Equipment & Tools</li>
        <li>General Accessories</li>
        <li>Heavy Duty Vehicles</li>
        <li>Mobile Services</li>
        <li>Oil Lubricants</li>
            </ul>
            </div>
            <div class="col">
            <ul>
        <li>Paintwork & Corrosion Protection</li>
        <li>Passenger Vehicles</li>
        <li>Two Wheelers</li>
        <li>Three Wheelers</li>
        <li>Tyre Manufacturer</li>
        <li>Towing Service</li>
        <li>Tuning Equipments</li>
            <ul>
            </div>
          </div>
        <p>For more info contact: Joseph Karani   at <br>
        <strong>Email: joseph@mombasaautoshow.com <br>
        Phone: +254 757 629630</strong></p>
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
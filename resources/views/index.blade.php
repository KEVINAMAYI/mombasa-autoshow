@extends('layouts.header')
@section('content')

@include('layouts.partials.top-bar')

    <div id="banner">
        <img src="images/banner1.jpg" id="banner-img">
        <div id="home-container">
			<div id="logo"><a href="/index"><img src="images/logo.png"></a></div> <!--==end of <div id="logo">==-->
            <div id="main-menu">
				<nav class="navbar navbar-expand-lg navbar-light ">
                      <div class="container-fluid">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                          <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                          <ul class="navbar-nav">
                            <li class="nav-item">
                              <a class="nav-link active" aria-current="page" href="/index">HOME</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="/about">ABOUT</a>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                AWARDS
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="/car-awards">Car of the year</a></li>
                                <li><a class="dropdown-item" href="/psv-awards">PSV of the year</a></li>
                                <li><a class="dropdown-item" href="/dealer-awards">Dealer of the year</a></li>
                              </ul>
                            </li>
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                INFORMATION
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="/sponsors">Sponsors</a></li>
                                <li><a class="dropdown-item" href="/exhibitors">Exhibitors</a></li>
                                <li><a class="dropdown-item" href="/vendors">Vendors</a></li>
                                <li><a class="dropdown-item" href="/know-before-go">Know before you go</a></li>
                                <li><a class="dropdown-item" href="/know-before-go">Event activities</a></li>
                              </ul>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="/auction">PUBLIC AUCTION</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" href="/contactus">CONTACT US</a>
                            </li>
                            @if(Auth::check())
                            <li class="nav-item dropdown">
                              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                MY ACCOUNT
                              </a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="/myprofile">My Profile</a></li>
                                <li><a class="dropdown-item" href="/mycars">Car of the year</a></li>
                                <li><a class="dropdown-item" href="/mypsvs">PSV of the year</a></li>
                                <li><a class="dropdown-item" href="/mydealers">Dealer of the year</a></li>
                                <li><a class="dropdown-item" href="/auction-cars">Cars for Auction</a></li>
                                  <li><a class="dropdown-item" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Log Out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                    </form>
                                  </li>
                              </ul>
                            </li>
                           @endif
                          </ul>
                        </div>
                      </div>
                    </nav>
			</div> <!--==end of <div id="main-menu">==-->
            
            <div id="title-wrap">
            	<h1>MOMBASA</h1>
                <h2>ANNUAL</h2>
                <h3>Auto Show</h3>
                <a href="/register" class="btn1">REGISTER</a>
            </div> <!--==end of <div id="title-wrap">==-->
        </div><!----end of  <div id="home-container">---->
</div> <!--==end of <div id="banner"> ==-->

<div id="about-wrap">
	<div id="container">
    <h1>About the Event</h1>
    <p>The first edition of  Mombasa Annual Auto Show 2022 is scheduled to happen from 15 to 17 April 2022, at Mama Ngina Waterfront  Mombasa.  We have organized a series of activities with the climax being the Automotive awards. The awards categories will include;- Car of the year award, PSV of the year award,  Dealer of the year award.
    </p>
    <p>Kenyan Automobile Industry has been on rise since a few years, absorbing the shocks of global economic ups and downs. This growth is particularly visible in personal vehicle segments like 2-Wheelers and 4-Wheelers. With almost all major automobile manufacturers having their base in Nairobi and Mombasa, the population of vehicles is on rise.Mombasa Auto Expo will provide a special focus on Car dealers/Sellers, Auto Spares dealers, financial institutions, Insurance institutions, and car importers.
    </p> 
    
    <a href="/register" class="btn2">REGISTER</a>
    </div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="about-wrap">==-->

<img src="{{ asset('images/about-event.jpg') }}" id="about-img">
<!--==end of about event image==-->

<div id="schedule-wrap">
	<div id="container">
    	<h1 id="schedule-header">APRIL 15 - 17, 2022</h1>
        <div class="date-wrap">
        	<img src="images/15.png">
          <h3>FRIDAY</h3>
          <h4>0800 - 1800 HOURS</h4>
          <p>&minus;Registration Open<br>
           &minus;Exhibition- public in person event</p>
  </div> <!--==end of <div class="date-wrap">==-->
        <div class="date-wrap">
        	<img src="images/16.png">
          <h3>SATURDAY</h3>
          <h4>0800 - 1800 HOURS</h4>
          <p>&minus;Entertainment<br>&minus;Exhibition- public in person event</p>
       </div> <!--==end of <div class="date-wrap">==-->
        <div class="date-wrap">
        	<img src="images/17.png">
          <h3>SUNDAY</h3>
          <h4>0800 - 1800 HOURS</h4>
          <p>&minus;Exhibition- public in person event<br>
    &minus;Awards and closing ceremony</p>
  </div> <!--==end of <div class="date-wrap">==-->
	</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="schedule-wrap">==-->

<img src="images/schedule-image.jpg" id="schedule-img">
<!--==end of schedule image==-->

<div id="awards-wrap">
	<div id="container">
    	<h1>Awards</h1>
        <div class="award">
        	<h2>CAR OF THE YEAR AWARD</h2>
            <a href="/car-awards" class="btn3">VIEW SUBMISSIONS</a>
            <h3>Kshs. 200,000</h3>
            <br clear="all">
            <a href="/car-awards" class="btn4">VOTE</a>
            <h4>TOTAL VOTES: <strong>{{ $carsSum }}</strong></h4>
        </div> <!--==end of <div class="award">==-->
        
        <div class="award">
        	<h2>PSV OF THE YEAR AWARD</h2>
            <a href="/psv-awards" class="btn3">VIEW SUBMISSIONS</a>
            <h3>Kshs. 200,000</h3>
            <br clear="all">
            <a href="/psv-awards" class="btn4">VOTE</a>
            <h4>TOTAL VOTES: <strong>{{ $psvsSum }}</strong></h4>
        </div> <!--==end of <div class="award">==-->
        
        <div class="award">
        	<h2>DEALER OF THE YEAR AWARD</h2>
            <a href="/dealer-awards" class="btn3">VIEW SUBMISSIONS</a>
            <h3>Kshs. 200,000</h3>
            <br clear="all">
            <a href="/dealer-awards" class="btn4">VOTE</a>
            <h4>TOTAL VOTES: <strong>{{ $dealersSum }}</strong></h4>
        </div> <!--==end of <div class="award">==-->
        
    </div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="about-wrap">==-->

<div id="pillar-wrap">
<div id="container">
	<h1>MOMBASA AUTOSHOW 2022</h1>
    <h2>GOALS</h2>
    <div class="pillar"><img src="images/network.png"> <br> NETWORKING</div>
    <div class="pillar"><img src="images/leads.png"> <br>LEADS</div>
    <div class="pillar"><img src="images/awareness.png"> <br>AWARENESS</div>
    <div class="pillar"><img src="images/reward.png"> <br>APRECIATION</div>
    <p>Based on guidance MOH, the current health and safety protocols are in effect for the PUBLIC DAYS (April. 15-17) of the 2022 Mombasa Auto Show. Masks are REQUIRED for all attendees age 2 and above, except when eating and drinking. Masks must cover the nose and mouth. Proof of COVID-19 vaccine WILL NOT be required for admission. However, designated areas will be set up for the consumption of food and beverage and proof of COVID-19 vaccine MAY BE required for entry into those areas.</div> <!--==end of <div id="container">==-->
</div> <!--==end of <div id="pillar-wrap">==-->

  <div id="attend-wrap">
    <div id="container">
      <h1>Who is attending?</h1>
        <div class="attend">
          <h5>40+</h5>
            <h6>PRESS EVENTS</h6>
        </div> <!--==end of <div class="attend">==-->
        <div class="attend">
          <h5>200+</h5>
            <h6>EXHIBITORS</h6>
        </div> <!--==end of <div class="attend">==-->
        <div class="attend">
          <h5>100+</h5>
            <h6>VEHICLE DEALERS</h6>
        </div> <!--==end of <div class="attend">==-->
        <div class="attend">
          <h5>20+</h5>
            <h6>MEDIA</h6>
        </div> <!--==end of <div class="attend">==-->
    </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="attend-wrap">==-->

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
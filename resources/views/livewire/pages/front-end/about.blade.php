<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component
{} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">About Event</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <p>The  Car of the Year Awards 2025 Event is scheduled to happen from 30th October 2025, at Mama Ngina Waterfront  Mombasa.  We have organized a series of activities with the climax being the Automotive awards. </p>
                <p>Kenyan Automobile Industry has been on rise since a few years, absorbing the shocks of global economic ups and downs. This growth is particularly visible in personal vehicle segments like 2-Wheelers and 4-Wheelers. With almost all major automobile manufacturers having their base in Nairobi and Mombasa, the population of vehicles is on rise .</p>
                <p>At the same time, the growth of aftermarket i.e. use of Latest Garage Equipments, Up-gradation of Service Stations has confined mainly to larger cities and with authorized dealers network. The roadside mechanic still uses the same age old technique when it comes to repair and maintenance and cars and one can have a large number of cars waiting outside of each of these garages to be attended for days together.</p>
                <p>The aftermarket for the Automobile Sector has miles to go and is expected to grow looking at all these factors, Mombasa Auto Expo will provide a special focus on Car dealers/Sellers, Auto Spares dealers, financial institutions, Insurance institutions, and car importers.</p>
                <h6><strong>Event Objectives</strong></h6>
                <ul>
                    <li>To provide a platform for different automotive businesses to directly interact with existing and potential customers during the event.</li>
                    <li>To create more awareness about the different automotive products, government regulations and how they operate.</li>
                    <li>To generate leads and more sales</li>
                    <li>To build brand image and awareness</li>
                    <li>To encourage members to network in order to develop business relationships</li>

                    <li>To recognize and appreciate the best in Kenya’s automotive industry.</li>
                </ul>
            </div> <!--==end of <div id="page-contents">==-->

        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="wrapper-inner">==-->

    <div id="newsletter-wrap">
        <div id="container">
            <img src="front-end/images/news-line.jpg" class="news-line">
            <h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
            <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
            <form id="newsletter">
                <input type="email" id="newsInputEmail1" aria-describedby="emailHelp" placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </form>
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="newsletter-wrap">==-->
</div>


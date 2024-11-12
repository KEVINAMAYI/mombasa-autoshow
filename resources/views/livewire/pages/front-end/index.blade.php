<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component
{} ?>

<div class="page-content">
    <div id="banner">
        <img src="front-end/images/banner1.jpg" id="banner-img">
        <div id="home-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-wrap">
                <h1>CAR OF THE YEAR</h1>
                <h2>AWARDS</h2>
                <h3>2025</h3>
                <a href="car-awards.html" class="btn1">VOTE NOW</a>
            </div> <!--==end of <div id="title-wrap">==-->
        </div><!----end of  <div id="home-container">---->
    </div> <!--==end of <div id="banner"> ==-->

    <div id="about-wrap">
        <div id="container">
            <h1>About the Event</h1>
            <p>The Car of the Year Awards 2025 is scheduled to happen on 30th October 2025, at Mama Ngina Waterfront  Mombasa.  We have organized a series of activities with the climax being the Automotive awards.
            </p>
            <p>Kenyan Automobile Industry has been on rise since a few years, absorbing the shocks of global economic ups and downs. This growth is particularly visible in personal vehicle segments like 2-Wheelers and 4-Wheelers. With almost all major automobile manufacturers having their base in Nairobi and Mombasa, the population of vehicles is on rise. This event will provide a special focus on Car dealers/Sellers, Auto Spares dealers, financial institutions, Insurance institutions, and car importers.
            </p>
            <a href="car-awards.html" class="btn2">VOTE NOW</a>
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="about-wrap">==-->

    <img src="front-end/images/about-event.jpg" id="about-img">
    <!--==end of about event image==-->

    <div id="awards-wrap">
        <div id="container">
            <h1>Featured Cars</h1>
            <div id="car-wrap">
                <a href="car-details.html"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb" /></a>
                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="2"><a href="car-details.html" class="title3"><strong>Mercedes-Benz ML 350</strong></a></td>
                    </tr>
                    <tr>
                        <td>2014</td>
                        <td>Mombasa</td>
                    </tr>
                    <tr>
                        <td>Total votes: </td>
                        <td><strong>100</strong></td>
                    </tr>
                    <tr>
                        <td><a href="checkout.html" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                        <td><a href="#" style="float:right;"><img src="front-end/images/share.png" /></a></td>
                    </tr>

                    </tbody>
                </table>
            </div> <!--==end of <div id="car-wrap">==-->

            <div id="car-wrap">
                <a href="car-details.html"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb" /></a>
                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="2"><a href="car-details.html" class="title3"><strong>Mercedes-Benz ML 350</strong></a></td>
                    </tr>
                    <tr>
                        <td>2014</td>
                        <td>Mombasa</td>
                    </tr>
                    <tr>
                        <td>Total votes: </td>
                        <td><strong>100</strong></td>
                    </tr>
                    <tr>
                        <td><a href="checkout.html" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                        <td><a href="#" style="float:right;"><img src="front-end/images/share.png" /></a></td>
                    </tr>

                    </tbody>
                </table>
            </div> <!--==end of <div id="car-wrap">==-->
            <div id="car-wrap">
                <a href="car-details.html"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb" /></a>
                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="2"><a href="car-details.html" class="title3"><strong>Mercedes-Benz ML 350</strong></a></td>
                    </tr>
                    <tr>
                        <td>2014</td>
                        <td>Mombasa</td>
                    </tr>
                    <tr>
                        <td>Total votes: </td>
                        <td><strong>100</strong></td>
                    </tr>
                    <tr>
                        <td><a href="checkout.html" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                        <td><a href="#" style="float:right;"><img src="front-end/images/share.png" /></a></td>
                    </tr>

                    </tbody>
                </table>
            </div> <!--==end of <div id="car-wrap">==-->
            <div id="car-wrap">
                <a href="car-details.html"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb" /></a>
                <table class="table">
                    <tbody>
                    <tr>
                        <td colspan="2"><a href="car-details.html" class="title3"><strong>Mercedes-Benz ML 350</strong></a></td>
                    </tr>
                    <tr>
                        <td>2014</td>
                        <td>Mombasa</td>
                    </tr>
                    <tr>
                        <td>Total votes: </td>
                        <td><strong>100</strong></td>
                    </tr>
                    <tr>
                        <td><a href="checkout.html" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                        <td><a href="#" style="float:right;"><img src="front-end/images/share.png" /></a></td>
                    </tr>

                    </tbody>
                </table>
            </div> <!--==end of <div id="car-wrap">==-->

        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="about-wrap">==-->

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

<?php

use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.front-end')] class extends Component {
} ?>

<div class="page-content">
    <div id="banner-in">
        <img src="front-end/images/banner-inner.jpg" id="bannerin-img">
        <div id="inner-container">

            <livewire:layout.front-end.logo-branding/>

            <livewire:layout.front-end.nav/>

            <div id="title-inner">Contact Us</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div class="date-wrap">
                    <img src="front-end/images/general.png">
                    <h3>GENERAL <br> INQUIRIES</h3>
                    <p>info@mombasaautoshow.com</p>
                </div> <!--==end of <div class="date-wrap">==-->
                <div class="date-wrap">
                    <img src="front-end/images/exhibit.png">
                    <h3>EXHIBIT <br> INQUIRIES</h3>
                    <p> info@mombasaautoshow.com</p>
                </div> <!--==end of <div class="date-wrap">==-->
                <div class="date-wrap">
                    <img src="front-end/images/sponsorship.png">
                    <h3>SPONSORSHIP <br> INQUIRIES</h3>
                    <p>info@mombasaautoshow.com</p>
                </div> <!--==end of <div class="date-wrap">==-->

            </div> <!--==end of <div id="page-contents">==-->

        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="wrapper-inner">==-->


    <div id="newsletter-wrap">
        <div id="container">
            <img src="front-end/images/news-line.jpg" class="news-line">
            <h1>SIGN UP FOR AUTO SHOW ALERTS</h1>
            <h2>Sign up to recieve exclusive tickets offers,show info,awards etc.</h2>
            <form id="newsletter">
                <input type="email" id="newsInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </form>
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="newsletter-wrap">==-->
</div>

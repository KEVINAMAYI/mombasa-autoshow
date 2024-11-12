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

            <div id="title-inner">Voting Process</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <ul>
                    <li>Each vote costs <strong>Ksh. 50</strong>, which will be deducted from your selected payment method (e.g., M-Pesa, credit card, or any other approved payment option).</li>
                    <li>You can vote as many times as you wish. There are no restrictions on the number of votes you can cast.</li>
                    <li>For every <strong>Ksh. 50</strong> spent, you will earn <strong>one vote</strong>. For instance, if you spend Ksh. 100, you will receive <strong>2 votes</strong>.</li>
                    <li>By participating in the voting process, you acknowledge that you have read, understood, and agree to our Terms and Conditions.</li>
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

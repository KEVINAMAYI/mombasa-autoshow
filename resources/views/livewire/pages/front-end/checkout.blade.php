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

            <div id="title-inner">Checkout</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="register">
                    <form class="row g-3">
                        <div class="col-md-4">
                            <img src="front-end/images/mpesa.png">
                        </div>
                        <div class="col-md-8">
                            <p>For every Ksh. 50, you receive one vote. For example, a payment of Ksh. 100 will earn you 2 votes.Each vote enters you into a weekly draw for a chance to win cash prizes.
                                The more you vote, the higher your chances of winning.<br />
                                <em>Terms and Conditions apply</em></p>
                        </div>

                        <p>
                        <ul style="margin-left:20px;">
                            <li>Go to Pay Bill on the M-Pesa</li>
                            <li>Business number - 4002487</li>
                            <li>Account Number - <strong>RTYEWR</strong></li>
                            <li>Enter Amount </li>
                            <li>Enter your M-Pesa PIN</li>
                            <li>Wait for confirmation.</li>
                        </ul>
                        </p>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Confirm Payment</button>
                        </div>
                    </form>


                </div> <!--==end of <div id="register">==-->
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

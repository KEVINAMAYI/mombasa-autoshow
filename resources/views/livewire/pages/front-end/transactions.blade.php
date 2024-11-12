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

            <div id="title-inner">All Transactions</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row g-3">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search...">
                    </div>
                    <div class="col-sm-4">
                        <p align="right"><strong>Total Amount: Ksh. 400</strong></p>
                    </div>
                </div>
                <!-- =======end of Search====-->


                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>User Names</strong></td>
                        <td><strong>Transaction Ref.</strong></td>
                        <td><strong>Account No.</strong></td>
                        <td><strong>Vehicle Name</strong></td>
                        <td><strong>Date/Time</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Votes</strong></td>
                        <td><strong>Phone</strong></td>
                        <td><strong>Status</strong></td>
                    </tr>
                    <tr>
                        <td><a href="myprofile.html">John Doe</a></td>
                        <td>ETHJBNJJB</td>
                        <td>STHHH</td>
                        <td><a href="car-details.html">Mercedes-Benz ML 350</a></td>
                        <td>11-NOV-2024: 13:00</td>
                        <td>100</td>
                        <td>2</td>
                        <td>+254 123456789</td>
                        <td>Complete</td>
                    </tr>
                    <tr>
                        <td><a href="myprofile.html">Mary Doe</a></td>
                        <td>ETHJBNJJB</td>
                        <td>STHHH</td>
                        <td><a href="car-details.html">Mercedes-Benz ML 350</a></td>
                        <td>11-NOV-2024: 13:00</td>
                        <td>100</td>
                        <td>2</td>
                        <td>+254 123456789</td>
                        <td>Pending</td>
                    </tr>
                    <tr>
                        <td><a href="myprofile.html">Tom Doe</a></td>
                        <td>ETHJBNJJB</td>
                        <td>STHHH</td>
                        <td><a href="car-details.html">Mercedes-Benz ML 350</a></td>
                        <td>11-NOV-2024: 13:00</td>
                        <td>100</td>
                        <td>2</td>
                        <td>+254 123456789</td>
                        <td>Failed</td>
                    </tr>
                    <tr>
                        <td><a href="myprofile.html">Jane Doe</a></td>
                        <td>ETHJBNJJB</td>
                        <td>STHHH</td>
                        <td><a href="car-details.html">Mercedes-Benz ML 350</a></td>
                        <td>11-NOV-2024: 13:00</td>
                        <td>100</td>
                        <td>2</td>
                        <td>+254 123456789</td>
                        <td>Complete</td>
                    </tr>
                    </tbody>
                </table>




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

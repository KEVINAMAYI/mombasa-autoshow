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

            <div id="title-inner">Votes For: Mercedes-Benz ML 350</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">


                <div class="row g-3">
                    <div class="col-sm-8">
                        <input type="text" class="form-control" placeholder="Search..." aria-label="Search...">
                    </div>

                </div>
                <!-- =======end of Search====-->


                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>Names</strong></td>
                        <td><strong>Phone Number</strong></td>
                        <td><strong>Email</strong></td>
                        <td><strong>Date/Time</strong></td>
                        <td><strong>Amount</strong></td>
                        <td><strong>Votes</strong></td>
                    </tr>
                    <tr>
                        <td><a href="#">John Doe</a></td>
                        <td>+254 123456789</td>
                        <td>john.doe@gmail.com</td>
                        <td>11-NOV-2024/13:00</td>
                        <td>120</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td><a href="#">John Doe</a></td>
                        <td>+254 123456789</td>
                        <td>john.doe@gmail.com</td>
                        <td>11-NOV-2024/13:00</td>
                        <td>100</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td><a href="#">John Doe</a></td>
                        <td>+254 123456789</td>
                        <td>john.doe@gmail.com</td>
                        <td>11-NOV-2024/13:00</td>
                        <td>120</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td><a href="#">John Doe</a></td>
                        <td>+254 123456789</td>
                        <td>john.doe@gmail.com</td>
                        <td>11-NOV-2024/13:00</td>
                        <td>100</td>
                        <td>2</td>
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

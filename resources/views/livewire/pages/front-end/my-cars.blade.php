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

            <div id="title-inner">My Cars</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div style="width:100%; float:left;"><a href="create-car.html" class="btn2">Submit a Car</a></div>
                <h3 class="title2">MY CARS SUBMITTED FOR AWARDS</h3>
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
                            <td><!--<a href="login.html" type="button" class="btn btn-primary btn-sm">Vote for me</a>--></td>
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
                            <td><!--<a href="login.html" type="button" class="btn btn-primary btn-sm">Vote for me</a>--></td>
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
                            <td><!--<a href="login.html" type="button" class="btn btn-primary btn-sm">Vote for me</a>--></td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png" /></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->



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

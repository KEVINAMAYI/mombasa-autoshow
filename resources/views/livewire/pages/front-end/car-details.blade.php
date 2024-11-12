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

            <div id="title-inner">Car Details</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="left-col">
                    <h3 class="title2">Mercedes-Benz ML 350</h3>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="front-end/images/slider/car.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="front-end/images/slider/car.jpg" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="front-end/images/slider/car.jpg" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                    <!--==============end of carousel =======-->
                    <h3 class="title2">What is unique about this car?</h3>
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                </div> <!--==end of <div id="left-col">==-->
                <div id="right-col">
                    <h3 class="title2">Vehicle Desciption</h3>
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
                            <td>Engine CC </td>
                            <td>2500</td>
                        </tr>
                        <tr>
                            <td>Transmission </td>
                            <td>Automatic</td>
                        </tr>
                        <tr>
                            <td>Fuel Type </td>
                            <td>Petrol</td>
                        </tr>
                        <tr>
                            <td>Interior color </td>
                            <td>Dark</td>
                        </tr>
                        <tr>
                            <td>Exterior color</td>
                            <td>White</td>
                        </tr>
                        <tr>
                            <td>Vehicle Registration</td>
                            <td>KCA 123</td>
                        </tr>
                        <tr>
                            <td><a href="checkout.html" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png" /></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="right-col">==-->
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

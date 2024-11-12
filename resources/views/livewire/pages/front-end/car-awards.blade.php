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

            <div id="title-inner">Car of the Year</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <p>The Mombasa Autoshow car awards aim to celebrate and honor those Technology and Automotive products
                    and innovations that have paved the way for the future of these sectors and set benchmarks in their
                    respective fields while helping Kenyans make better decisions when buying cars. The general public
                    is invited to submit their cars for voting. Winners of the competition will receive cash
                    prize,trophies and many more giveaways.</p>

                <div class="row g-3">
                    <div class="col-sm-8">
                        <input type="text" class="form-control"
                               placeholder="Search for car by make,model or any keyword" aria-label="Search car">
                    </div>
                    <div class="col-sm-4">
                        <a href="{{ route('front-end.create-car') }}" class="btn2" style="margin-top:0;">Submit a Car</a>
                    </div>
                </div>
                <!-- =======end of Search====-->
                <div class="row g-3" style="margin-top:5px;">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Category</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Category...</option>
                            <option value="sedan">Sedan</option>
                            <option value="coupe">Coupe</option>
                            <option value="hatchback">Hatchback</option>
                            <option value="station-wagon">Station Wagon</option>
                            <option value="suv">SUV</option>
                            <option value="pick-up">Pick up</option>
                            <option value="van">Van</option>
                            <option value="mini-van">Mini Van</option>
                            <option value="wagon">Wagon</option>
                            <option value="convertible">Convertible</option>
                            <option value="bus">Bus</option>
                            <option value="truck">Truck</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Make</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Make...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Model</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Model...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Year of Award</label>
                        <select class="form-select" id="autoSizingSelect">
                            <option selected>Year of Award...</option>
                            <option value="1">2025</option>
                        </select>
                    </div>
                </div>
                <!--===end of filter ==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}"" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->


                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
                        </tr>

                        </tbody>
                    </table>
                </div> <!--==end of <div id="car-wrap">==-->

                <div id="car-wrap">
                    <a href="{{ route('front-end.car-details') }}"><img src="front-end/images/car-thumbnail.jpg" class="car-thumb"/></a>
                    <table class="table">
                        <tbody>
                        <tr>
                            <td colspan="2"><a href="{{ route('front-end.car-details') }}" class="title3"><strong>Mercedes-Benz ML
                                        350</strong></a></td>
                        </tr>
                        <tr>
                            <td>2014</td>
                            <td>Mombasa</td>
                        </tr>
                        <tr>
                            <td>Total votes:</td>
                            <td><strong>100</strong></td>
                        </tr>
                        <tr>
                            <td><a href="{{ route('front-end.checkout') }}" type="button" class="btn btn-primary btn-sm">Vote for me</a>
                            </td>
                            <td><a href="#" style="float:right;"><img src="front-end/images/share.png"/></a></td>
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
                <input type="email" id="newsInputEmail1" aria-describedby="emailHelp"
                       placeholder="Enter your email address">
                <button type="submit" class="btn btn-primary">SIGN UP</button>
            </form>
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="newsletter-wrap">==-->

</div>

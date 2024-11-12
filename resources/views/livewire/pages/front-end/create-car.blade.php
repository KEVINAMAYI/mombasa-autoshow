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

            <div id="title-inner">Create a car</div>
        </div><!----end of  <div id="inner-container">---->
    </div> <!--==end of <div id="banner-in"> ==-->

    <div id="wrapper-inner">
        <div id="container">
            <div id="page-contents">
                <div id="car-form">
                    <form class="row g-3">
                        <div class="col-md-4">
                            <label for="inputState" class="form-label"><strong>Submit car for?</strong></label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>Car of the year award</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Make</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Model</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Year of Manufacture</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>...</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Location</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>Nairobi</option>
                                <option>Mombasa</option>
                                <option>Nakuru</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Engine cc</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="1500">
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Transmission</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>Automatic</option>
                                <option>Manual</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Fuel Type</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>Petrol</option>
                                <option>Diesel</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Interior color</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>Dark</option>
                                <option>White</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="inputState" class="form-label">Exterior color</label>
                            <select id="inputState" class="form-select">
                                <option selected>Choose...</option>
                                <option>Black</option>
                                <option>Pearl White</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Vehicle Registration</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="KAA 000A">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Price(Kshs)</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="800,000">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Vehicle Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Vehicle Name">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Sacco Name</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Sacco Name">
                        </div>
                        <div class="col-md-4">
                            <label for="formGroupExampleInput" class="form-label">Route</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Route">
                        </div>
                        <div class="col-12">
                            <label for="exampleFormControlTextarea1" class="form-label">Description(What is unique about this car?)</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="col-md-4">
                            <label for="formFileMultiple" class="form-label">Upload car photos(Max 10)</label>
                            <input class="form-control" type="file" id="formFileMultiple" multiple>
                        </div>

                        <div class="col-12">
                            <a href="checkout.html" type="submit" class="btn btn-primary">Save Details</a>
                        </div>
                    </form>


                </div> <!--==end of <div id="car-form">==-->
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

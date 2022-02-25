$(document).ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    //reload the page if the user click back arrow to persist database changes
    (function () {
        window.onpageshow = function (event) {
            if (event.persisted) {
                window.location.reload();
            }
        };
    })();

    //Search Dealer
    $('#searchdealer').on('keyup', function (e) {

        e.preventDefault();
        var dealersearch = $.trim($('#searchdealer').val());

        console.log(dealersearch)

        //if the search is not null
        if ((dealersearch != null) && (dealersearch != '') && (dealersearch.length != 0)) {

            $.ajax({

                url: "/search-dealer",
                type: "post",
                data: {
                    'searchquery': dealersearch
                },
                success: function (response) {

                    dealers = response.dealers;

                    // if user is logged in
                    if (response.loggedin) {
                        if (response.voted) {
                            $('.dealer').remove();

                            dealers.forEach(dealer => {

                                $('#page-contents').append(`
                                    <div id="car-wrap" class="dealer">
                                        <a href="dealer-details/${dealer.id}"><img src="images/${dealer.logo_url}" class="car-thumb" /></a>
                                        <table class="table">
                                        <tbody>
                                            <tr>
                                            <td colspan="2"><a href="dealer-details/${dealer.id}" class="title3"><strong>${dealer.dealername}</strong></a></td>
                                            </tr>
                                            <tr>
                                            <td>${dealer.phonenumber}</td>
                                            <td>${dealer.email}</td>
                                            </tr>
                                            <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${dealer.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td colspan="2"><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                    `);

                            });

                        }
                        else {
                            console.log(response);

                            $('.dealer').remove();

                            dealers.forEach(dealer => {

                                $('#page-contents').append(`
                                <div id="car-wrap" class="dealer">
                                    <a href="dealer-details/${dealer.id}"><img src="images/${dealer.logo_url}" class="car-thumb" /></a>
                                    <table class="table">
                                    <tbody>
                                        <tr>
                                        <td colspan="2"><a href="dealer-details/${dealer.id}" class="title3"><strong>${dealer.dealername}</strong></a></td>
                                        </tr>
                                        <tr>
                                        <td>${dealer.phonenumber}</td>
                                        <td>${dealer.email}</td>
                                        </tr>
                                        <tr>
                                        <td>Total votes: </td>
                                        <td><strong>${dealer.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td colspan="2"><a href="/vote-for-dealer/${dealer.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                    </tbody>
                                    </table>
                                </div>
                                `);
                            });

                        }


                    }
                    else {

                        $('.dealer').remove();

                        //user not logged in

                        dealers.forEach(dealer => {

                            $('#page-contents').append(`
                            <div id="car-wrap" class="dealer">
                                <a href="dealer-details/${dealer.id}"><img src="images/${dealer.logo_url}" class="car-thumb" /></a>
                                <table class="table">
                                <tbody>
                                    <tr>
                                    <td colspan="2"><a href="dealer-details/${dealer.id}" class="title3"><strong>${dealer.dealername}</strong></a></td>
                                    </tr>
                                    <tr>
                                    <td>${dealer.phonenumber}</td>
                                    <td>${dealer.email}</td>
                                    </tr>
                                    <tr>
                                    <td>Total votes: </td>
                                    <td><strong>${dealer.votes}</strong></td>
                                    </tr>
                                    <tr>
                                    <td colspan="2"><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            `);

                        });


                    }

                },
                error: function (response) {

                    console.log(response);

                }

            });

        }
        else {
            location.reload();
        }

    });


    //Search Car
    $('#searchcar').on('keyup', function (e) {

        e.preventDefault();
        var carsearch = $.trim($('#searchcar').val());

        //if the search is not bul
        if ((carsearch != null) && (carsearch != '') && (carsearch.length != 0)) {

            $.ajax({

                url: "/search-car",
                type: "post",
                data: {
                    'searchquery': carsearch
                },
                success: function (response) {


                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="car">
                                        <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${car.manufacture_year}</td>
                                                <td>${car.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${car.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="car">
                                        <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${car.manufacture_year}</td>
                                                <td>${car.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${car.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                        <div id="car-wrap" class="car">
                                        <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${car.manufacture_year}</td>
                                                <td>${car.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${car.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {

                    console.log(response)
                }


            });

        }
        else {

            location.reload();
        }



    });



    //Search PSV
    $('#searchpsv').on('keyup', function (e) {

        e.preventDefault();
        var carsearch = $.trim($('#searchpsv').val());

        //if the search is not bul
        if ((carsearch != null) && (carsearch != '') && (carsearch.length != 0)) {

            $.ajax({

                url: "/search-psv",
                type: "post",
                data: {
                    'searchquery': carsearch
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {

                    console.log(response)
                }


            });

        }
        else {

            location.reload();
        }



    });


    //Search Car For Auction
    $('#searchauctioncar').on('keyup', function (e) {

        e.preventDefault();
        var carsearch = $.trim($('#searchauctioncar').val());

        //if the search is not null
        if ((carsearch != null) && (carsearch != '') && (carsearch.length != 0)) {

            $.ajax({

                url: "/search-auction-car",
                type: "post",
                data: {
                    'searchquery': carsearch
                },
                success: function (response) {


                    cars = response.cars
                    reservedcars = response.reservedcars

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        //reserved cars id
                        reservedcarsids = reservedcars.map(reservedcar => {
                            return reservedcar.car_id;
                        });

                        $('.auction-car').remove();

                        cars.forEach(car => {

                            if (reservedcarsids.includes(car.id)) {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                                    <div id="car-wrap" class="auction-car">
                                                    <a href="/auction-cardetails/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="2"><a href="/login" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>${car.manufacture_year}</td>
                                                            <td>${car.location}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price(Kshs) </td>
                                                            <td><strong>${car.price}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!--==end of <div id="car-wrap">==-->
                                        
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                                    <div id="car-wrap" class="auction-car">
                                                    <a href="/auction-cardetails/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                                    <table class="table">
                                                        <tbody>
                                                        <tr>
                                                            <td colspan="2"><a href="/login" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                        </tr>
                                                        <tr>
                                                            <td>${car.manufacture_year}</td>
                                                            <td>${car.location}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price(Kshs) </td>
                                                            <td><strong>${car.price}</strong></td>
                                                        </tr>
                                                        <tr>
                                                            <td><a href="/reserve-car/${car.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div> <!--==end of <div id="car-wrap">==-->
                                        
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.auction-car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                                <div id="car-wrap" class="auction-car">
                                                <a href="/auction-cardetails/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                                <table class="table">
                                                    <tbody>
                                                    <tr>
                                                        <td colspan="2"><a href="/login" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>${car.manufacture_year}</td>
                                                        <td>${car.location}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Price(Kshs) </td>
                                                        <td><strong>${car.price}</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                    </tr>
                                                    
                                                    </tbody>
                                                </table>
                                                </div> 
                                        
                                        `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });

                    }

                },
                error: function (response) {

                    console.log(response)
                }


            });

        }
        else {

            location.reload();
        }

    });





    //get model for the car make
    $("#make").on('change', function () {

        let make = $('#make').val();

        if (make == 'Choose...') {
            location.reload()
            return;

        }
        else {

            $.ajax({

                url: "/get-models",
                type: "post",
                data: {
                    'make': make
                },
                success: function (response) {

                    $('.make-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('#model').append(
                            `<option class='make-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });

        }

    });


  


    //get psv model for the car make
    $(".searchpsvmake").on('change', function () {

        let make = $('.searchpsvmake').val();

        if (make == 'Make...') {
            location.reload()
            return;
        }
        else {

            $.ajax({

                url: "/get-psv-models",
                type: "post",
                data: {
                    'make': make
                },
                success: function (response) {

                    $('.psv-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchpsvmodel').append(
                            `<option class='psv-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });

        }
    });


    //trigger car filter by category
    $(".searchcarcategory").on('change', function () {

        let category = $('.searchcarcategory').val();
        let make = $('.searchcarmake').val();
        let model = $('.searchcarmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }
        //only the category option is occupied
        else if ((category != "Category...") && (make == "Make...")) {

            $.ajax({

                url: "/filter-cars",
                type: "post",
                data: {
                    'category': category,
                    'label': 'category'
                },
                success: function (response) {


                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="car">
                                        <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${car.manufacture_year}</td>
                                                <td>${car.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${car.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="car">
                                        <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${car.manufacture_year}</td>
                                                <td>${car.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${car.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                        <div id="car-wrap" class="car">
                                        <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${car.manufacture_year}</td>
                                                <td>${car.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${car.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {

                    console.log(response.error);

                }
            });


        }
        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {
            //category, make and model options are not blank
            if ((model != "Model...")) {

                $.ajax({

                    url: "/filter-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'model': model,
                        'label': 'all'
                    },
                    success: function (response) {


                        cars = response.cars
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.car').remove();


                            cars.forEach(car => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(car.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {

                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.car').remove();

                            cars.forEach(car => {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }
            //category and make option are occupied
            else {

                $.ajax({

                    url: "/filter-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'label': 'category_make'
                    },
                    success: function (response) {


                        cars = response.cars
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.car').remove();


                            cars.forEach(car => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(car.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {

                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.car').remove();

                            cars.forEach(car => {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });



            }
        }


    });



    //trigger car filter by make
    $(".searchcarmake").on('change', function () {

        let category = $('.searchcarcategory').val();
        let make = $('.searchcarmake').val();
        let model = $('.searchcarmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }
        //only the category option is occupied
        else if ((category != "Category...") && (make == "Make...")) {

            $.ajax({

                url: "/filter-cars",
                type: "post",
                data: {

                    'category': category,
                    'label': 'category'
                },
                success: function (response) {

                    console.log(response);
                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {


                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }
        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make
                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchcarmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-cars",
                type: "post",
                data: {

                    'category': category,
                    'make': make,
                    'label': 'category_make'
                },
                success: function (response) {

                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });


        }

        else if ((category == "Category...") && (model == "Model...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make,
                    'label': 'make'

                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchcarmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-cars",
                type: "post",
                data: {

                    'make': make,
                    'label': 'make'
                },
                success: function (response) {


                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="car">
                                    <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${car.manufacture_year}</td>
                                            <td>${car.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${car.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }

        else if ((category == "Category...") && (model != "Model...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make,
                    'model': model,
                    'label': 'make_model'

                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchcarmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-cars",
                type: "post",
                data: {

                    'make': make,
                    'label': 'make'
                },
                success: function (response) {


                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                       <div id="car-wrap" class="car">
                                       <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                       <table class="table">
                                           <tbody>
                                           <tr>
                                               <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                           </tr>
                                           <tr>
                                               <td>${car.manufacture_year}</td>
                                               <td>${car.location}</td>
                                           </tr>
                                           <tr>
                                               <td>Total votes: </td>
                                               <td><strong>${car.votes}</strong></td>
                                           </tr>
                                           <tr>
                                           <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                           <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                          </tr>
                                           
                                           </tbody>
                                       </table>
                                   </div> <!--==end of <div id="car-wrap">==-->
                                       `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                       <div id="car-wrap" class="car">
                                       <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                       <table class="table">
                                           <tbody>
                                           <tr>
                                               <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                           </tr>
                                           <tr>
                                               <td>${car.manufacture_year}</td>
                                               <td>${car.location}</td>
                                           </tr>
                                           <tr>
                                               <td>Total votes: </td>
                                               <td><strong>${car.votes}</strong></td>
                                           </tr>
                                           <tr>
                                           <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                           <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                           
                                           </tbody>
                                       </table>
                                   </div> <!--==end of <div id="car-wrap">==-->
                                       `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                       <div id="car-wrap" class="car">
                                       <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                       <table class="table">
                                           <tbody>
                                           <tr>
                                               <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                           </tr>
                                           <tr>
                                               <td>${car.manufacture_year}</td>
                                               <td>${car.location}</td>
                                           </tr>
                                           <tr>
                                               <td>Total votes: </td>
                                               <td><strong>${car.votes}</strong></td>
                                           </tr>
                                           <tr>
                                               <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                               <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                           
                                           </tbody>
                                       </table>
                                   </div> <!--==end of <div id="car-wrap">==-->
                                       `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });



        }

    });




    //trigger car filter by model
    $(".searchcarmodel").on('change', function () {

        let category = $('.searchcarcategory').val();
        let make = $('.searchcarmake').val();
        let model = $('.searchcarmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }

        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {
            //category, make and model options are not blank
            if ((model != "Model...")) {

                $.ajax({

                    url: "/filter-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'model': model,
                        'label': 'all'
                    },
                    success: function (response) {

                        cars = response.cars
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.car').remove();


                            cars.forEach(car => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(car.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {

                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.car').remove();

                            cars.forEach(car => {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }

            //category and make option are occupied
            else {

                $.ajax({

                    url: "/filter-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'label': 'category_make'
                    },
                    success: function (response) {


                        cars = response.cars
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.car').remove();


                            cars.forEach(car => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(car.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {

                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.car').remove();

                            cars.forEach(car => {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });

            }
        }
        else if ((category == "Category...") && (make != "Make...")) {

            $.ajax({

                url: "/filter-cars",
                type: "post",
                data: {
                    'model': model,
                    'make': make,
                    'label': 'make_model'
                },
                success: function (response) {


                    cars = response.cars
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.car').remove();


                        cars.forEach(car => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(car.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.car').remove();

                        cars.forEach(car => {

                            $.ajax({

                                url: "/get-car-image/" + car.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }

        else if ((category == "Category...") && (model == "Model...")) {

            if ((make != "Make...")) {

                // populate models for a particular make
                $.ajax({

                    url: "/get-car-models",
                    type: "post",
                    data: {
                        'make': make,
                        'label': make
                    },
                    success: function (response) {

                        $('.car-model').remove();
                        models = response.models;
                        models.forEach(model => {
                            $('.searchcarmodel').append(
                                `<option class='car-model'>${model}</option>`
                            );
                        })
                    },
                    error: function (response) {

                        console.log(response);
                    }
                });

                $.ajax({

                    url: "/filter-cars",
                    type: "post",
                    data: {
                        'make': make,
                        'label': make
                    },
                    success: function (response) {


                        cars = response.cars
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.car').remove();


                            cars.forEach(car => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(car.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${car.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {

                                    $.ajax({

                                        url: "/get-car-image/" + car.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.car').remove();

                            cars.forEach(car => {

                                $.ajax({

                                    url: "/get-car-image/" + car.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="car">
                                            <a href="/car-details/${car.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${car.id}" class="title3"><strong>${car.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${car.manufacture_year}</td>
                                                    <td>${car.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${car.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }



        }

    });


    //trigger psv filter by category
    $(".searchpsvcategory").on('change', function () {

        let category = $('.searchpsvcategory').val();
        let make = $('.searchpsvmake').val();
        let model = $('.searchpsvmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }
        //only the category option is occupied
        else if ((category != "Category...") && (make == "Make...")) {

            $.ajax({

                url: "/filter-psvs",
                type: "post",
                data: {
                    'category': category,
                    'label': 'category'
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        psvs.forEach(psv => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {

                    console.log(response.error);

                }
            });


        }
        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {
            //category, make and model options are not blank
            if ((model != "Model...")) {

                $.ajax({

                    url: "/filter-psvs",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'model': model,
                        'label': 'all'
                    },
                    success: function (response) {


                        psvs = response.psvs
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.psv').remove();


                            psvs.forEach(psv => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(psv.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="psv">
                                            <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${psv.manufacture_year}</td>
                                                    <td>${psv.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${psv.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.psv').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="psv">
                                            <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${psv.manufacture_year}</td>
                                                    <td>${psv.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${psv.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.psv').remove();

                            psvs.forEach(psv => {

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="psv">
                                            <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${psv.manufacture_year}</td>
                                                    <td>${psv.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${psv.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }
            //category and make option are occupied
            else {

                $.ajax({

                    url: "/filter-psvs",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'label': 'category_make'
                    },
                    success: function (response) {


                        psvs = response.psvs
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.psv').remove();


                            psvs.forEach(psv => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(psv.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="psv">
                                            <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${psv.manufacture_year}</td>
                                                    <td>${psv.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${psv.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                               </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.psv').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="psv">
                                            <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${psv.manufacture_year}</td>
                                                    <td>${psv.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${psv.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.psv').remove();

                            psvs.forEach(psv => {

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                            <div id="car-wrap" class="psv">
                                            <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${psv.manufacture_year}</td>
                                                    <td>${psv.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Total votes: </td>
                                                    <td><strong>${psv.votes}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> <!--==end of <div id="car-wrap">==-->
                                            `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });



            }
        }


    });


    //trigger psv filter by make
    $(".searchpsvmake").on('change', function () {

        let category = $('.searchpsvcategory').val();
        let make = $('.searchpsvmake').val();
        let model = $('.searchpsvmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }
        //only the category option is occupied
        else if ((category != "Category...") && (make == "Make...")) {

            $.ajax({

                url: "/filter-psvs",
                type: "post",
                data: {

                    'category': category,
                    'label': 'category'
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        psvs.forEach(psv => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }
        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make
                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchcarmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-psvs",
                type: "post",
                data: {

                    'category': category,
                    'make': make,
                    'label': 'category_make'
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        psvs.forEach(psv => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });


        }

        else if ((category == "Category...") && (model == "Model...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make,
                    'label': 'make'

                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchcarmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-psvs",
                type: "post",
                data: {

                    'make': make,
                    'label': 'make'
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        psvs.forEach(psv => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }

        else if ((category == "Category...") && (model != "Model...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make,
                    'model': model,
                    'label': 'make_model'

                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchcarmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-psvs",
                type: "post",
                data: {

                    'make': make,
                    'label': 'make'
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                       </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        psvs.forEach(psv => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="psv">
                                    <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${psv.manufacture_year}</td>
                                            <td>${psv.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Total votes: </td>
                                            <td><strong>${psv.votes}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> <!--==end of <div id="car-wrap">==-->
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });



        }

    });



    //trigger psv filter by model
    $(".searchpsvmodel").on('change', function () {

        let category = $('.searchpsvcategory').val();
        let make = $('.searchpsvmake').val();
        let model = $('.searchpsvmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }

        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {
            //category, make and model options are not blank
            if ((model != "Model...")) {

                $.ajax({

                    url: "/filter-psvs",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'model': model,
                        'label': 'all'
                    },
                    success: function (response) {


                        psvs = response.psvs
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.psv').remove();


                            psvs.forEach(psv => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(psv.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.psv').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.psv').remove();

                            psvs.forEach(psv => {

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }

            //category and make option are occupied
            else {

                $.ajax({

                    url: "/filter-psvs",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'label': 'category_make'
                    },
                    success: function (response) {


                        psvs = response.psvs
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.psv').remove();


                            psvs.forEach(psv => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(psv.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.psv').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.psv').remove();

                            psvs.forEach(psv => {

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });

            }
        }
        else if ((category == "Category...") && (make != "Make...")) {

            $.ajax({

                url: "/filter-psvs",
                type: "post",
                data: {
                    'model': model,
                    'make': make,
                    'label': 'make_model'
                },
                success: function (response) {


                    psvs = response.psvs
                    uservotedcategories = response.userVotedCategories

                    //user is logged in
                    if (response.loggedin) {

                        console.log(response);

                        $('.psv').remove();


                        psvs.forEach(psv => {

                            //blocked user voted categories
                            if (!uservotedcategories.includes(psv.category)) {
                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.psv').remove();

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        console.log(response);

                        $('.psv').remove();

                        psvs.forEach(psv => {

                            $.ajax({

                                url: "/get-car-image/" + psv.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })

                        });



                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }

        else if ((category == "Category...") && (model == "Model...")) {

            if ((make != "Make...")) {

                // populate models for a particular make
                $.ajax({

                    url: "/get-car-models",
                    type: "post",
                    data: {
                        'make': make,
                        'label': make
                    },
                    success: function (response) {

                        $('.car-model').remove();
                        models = response.models;
                        models.forEach(model => {
                            $('.searchcarmodel').append(
                                `<option class='car-model'>${model}</option>`
                            );
                        })
                    },
                    error: function (response) {

                        console.log(response);
                    }
                });

                $.ajax({

                    url: "/filter-psvs",
                    type: "post",
                    data: {
                        'make': make,
                        'label': make
                    },
                    success: function (response) {


                        psvs = response.psvs
                        uservotedcategories = response.userVotedCategories

                        //user is logged in
                        if (response.loggedin) {

                            console.log(response);

                            $('.psv').remove();


                            psvs.forEach(psv => {

                                //blocked user voted categories
                                if (!uservotedcategories.includes(psv.category)) {
                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/vote-for-car/${psv.id}" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                           </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.psv').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + psv.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Vote for me</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            console.log(response);

                            $('.psv').remove();

                            psvs.forEach(psv => {

                                $.ajax({

                                    url: "/get-car-image/" + psv.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="psv">
                                        <a href="/psv-details/${psv.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/car-details/${psv.id}" class="title3"><strong>${psv.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${psv.manufacture_year}</td>
                                                <td>${psv.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Total votes: </td>
                                                <td><strong>${psv.votes}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Vote for me</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> <!--==end of <div id="car-wrap">==-->
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })

                            });



                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }



        }

    });



    //trigger acution car filter by category
    $(".searchauctioncarcategory").on('change', function () {

        let category = $('.searchauctioncarcategory').val();
        let make = $('.searchauctioncarmake').val();
        let model = $('.searchauctionmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }
        //only the category option is occupied
        else if ((category != "Category...") && (make == "Make...")) {

            $.ajax({

                url: "/filter-auction-cars",
                type: "post",
                data: {
                    'category': category,
                    'label': 'category'
                },
                success: function (response) {

                    auctioncars = response.cars
                    reservedCarsIDs = response.reservedCarsIDs

                    //user is logged in
                    if (response.loggedin) {
                        console.log(response);

                        $('.auction-car').remove();


                        auctioncars.forEach(auctioncar => {

                            //blocked user voted categories
                            if (reservedCarsIDs.includes(auctioncar.id)) {
                                $.ajax({

                                    url: "/get-car-image/" + auctioncar.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.auction-car').remove();

                                $.ajax({

                                    url: "/get-car-image/" + auctioncars.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        $('.auction-car').remove();

                        $.ajax({

                            url: "/get-car-image/" + auctioncars.id,
                            type: "get",
                            data: "",
                            success: function (response) {

                                console.log(response);

                                $('#page-contents').append(`
                                <div id="car-wrap" class="auction-car">
                                <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td>${auctioncar.manufacture_year}</td>
                                        <td>${auctioncar.location}</td>
                                    </tr>
                                    <tr>
                                        <td>Price(Kshs) </td>
                                        <td><strong>${auctioncar.price}</strong></td>
                                    </tr>
                                    <tr>
                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div> 
                                `)
                            },
                            error: function (response) {

                                console.log(response)
                            }
                        })


                    }

                },
                error: function (response) {

                    console.log(response.error);

                }
            });


        }
        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {
            //category, make and model options are not blank
            if ((model != "Model...")) {

                $.ajax({

                    url: "/filter-auction-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'model': model,
                        'label': 'all'
                    },
                    success: function (response) {

                        auctioncars = response.cars
                        reservedCarsIDs = response.reservedCarsIDs

                        //user is logged in
                        if (response.loggedin) {
                            console.log(response);

                            $('.auction-car').remove();


                            auctioncars.forEach(auctioncar => {

                                //blocked user voted categories
                                if (reservedCarsIDs.includes(auctioncar.id)) {
                                    $.ajax({

                                        url: "/get-car-image/" + auctioncar.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="auction-car">
                                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${auctioncar.manufacture_year}</td>
                                                    <td>${auctioncar.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Price(Kshs) </td>
                                                    <td><strong>${auctioncar.price}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> 
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.auction-car').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + auctioncars.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="auction-car">
                                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${auctioncar.manufacture_year}</td>
                                                    <td>${auctioncar.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Price(Kshs) </td>
                                                    <td><strong>${auctioncar.price}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> 
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            $('.auction-car').remove();

                            $.ajax({

                                url: "/get-car-image/" + auctioncars.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })


                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }
            //category and make option are occupied
            else {

                $.ajax({

                    url: "/filter-auction-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'label': 'category_make'
                    },
                    success: function (response) {

                        auctioncars = response.cars
                        reservedCarsIDs = response.reservedCarsIDs

                        //user is logged in
                        if (response.loggedin) {
                            console.log(response);

                            $('.auction-car').remove();


                            auctioncars.forEach(auctioncar => {

                                //blocked user voted categories
                                if (reservedCarsIDs.includes(auctioncar.id)) {
                                    $.ajax({

                                        url: "/get-car-image/" + auctioncar.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="auction-car">
                                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${auctioncar.manufacture_year}</td>
                                                    <td>${auctioncar.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Price(Kshs) </td>
                                                    <td><strong>${auctioncar.price}</strong></td>
                                                </tr>
                                                <tr>
                                                    <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> 
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.auction-car').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + auctioncars.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                            <div id="car-wrap" class="auction-car">
                                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                            <table class="table">
                                                <tbody>
                                                <tr>
                                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                                </tr>
                                                <tr>
                                                    <td>${auctioncar.manufacture_year}</td>
                                                    <td>${auctioncar.location}</td>
                                                </tr>
                                                <tr>
                                                    <td>Price(Kshs) </td>
                                                    <td><strong>${auctioncar.price}</strong></td>
                                                </tr>
                                                <tr>
                                                <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div> 
                                            `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            $('.auction-car').remove();

                            $.ajax({

                                url: "/get-car-image/" + auctioncars.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })


                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });



            }
        }


    });




    //trigger psv filter by make
    $(".searchauctioncarmake").on('change', function () {

        let category = $('.searchauctioncarcategory').val();
        let make = $('.searchauctioncarmake').val();
        let model = $('.searchauctionmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }
        //only the category option is occupied
        else if ((category != "Category...") && (make == "Make...")) {

            $.ajax({

                url: "/filter-auction-cars",
                type: "post",
                data: {

                    'category': category,
                    'label': 'category'
                },
                success: function (response) {

                    auctioncars = response.cars
                    reservedCarsIDs = response.reservedCarsIDs

                    //user is logged in
                    if (response.loggedin) {
                        console.log(response);

                        $('.auction-car').remove();


                        auctioncars.forEach(auctioncar => {

                            //blocked user voted categories
                            if (reservedCarsIDs.includes(auctioncar.id)) {
                                $.ajax({

                                    url: "/get-car-image/" + auctioncar.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.auction-car').remove();

                                $.ajax({

                                    url: "/get-car-image/" + auctioncars.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        $('.auction-car').remove();

                        $.ajax({

                            url: "/get-car-image/" + auctioncars.id,
                            type: "get",
                            data: "",
                            success: function (response) {

                                console.log(response);

                                $('#page-contents').append(`
                            <div id="car-wrap" class="auction-car">
                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                </tr>
                                <tr>
                                    <td>${auctioncar.manufacture_year}</td>
                                    <td>${auctioncar.location}</td>
                                </tr>
                                <tr>
                                    <td>Price(Kshs) </td>
                                    <td><strong>${auctioncar.price}</strong></td>
                                </tr>
                                <tr>
                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div> 
                            `)
                            },
                            error: function (response) {

                                console.log(response)
                            }
                        })


                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }
        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make
                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchauctionmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-auction-cars",
                type: "post",
                data: {

                    'category': category,
                    'make': make,
                    'label': 'category_make'
                },
                success: function (response) {

                    auctioncars = response.cars
                    reservedCarsIDs = response.reservedCarsIDs

                    //user is logged in
                    if (response.loggedin) {
                        console.log(response);

                        $('.auction-car').remove();


                        auctioncars.forEach(auctioncar => {

                            //blocked user voted categories
                            if (reservedCarsIDs.includes(auctioncar.id)) {
                                $.ajax({

                                    url: "/get-car-image/" + auctioncar.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.auction-car').remove();

                                $.ajax({

                                    url: "/get-car-image/" + auctioncars.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        $('.auction-car').remove();

                        $.ajax({

                            url: "/get-car-image/" + auctioncars.id,
                            type: "get",
                            data: "",
                            success: function (response) {

                                console.log(response);

                                $('#page-contents').append(`
                            <div id="car-wrap" class="auction-car">
                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                </tr>
                                <tr>
                                    <td>${auctioncar.manufacture_year}</td>
                                    <td>${auctioncar.location}</td>
                                </tr>
                                <tr>
                                    <td>Price(Kshs) </td>
                                    <td><strong>${auctioncar.price}</strong></td>
                                </tr>
                                <tr>
                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div> 
                            `)
                            },
                            error: function (response) {

                                console.log(response)
                            }
                        })


                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });


        }

        else if ((category == "Category...") && (model == "Model...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make,
                    'label': 'make'

                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchauctionmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-auction-cars",
                type: "post",
                data: {

                    'make': make,
                    'label': 'make'
                },
                success: function (response) {

                    auctioncars = response.cars
                    reservedCarsIDs = response.reservedCarsIDs

                    //user is logged in
                    if (response.loggedin) {
                        console.log(response);

                        $('.auction-car').remove();


                        auctioncars.forEach(auctioncar => {

                            //blocked user voted categories
                            if (reservedCarsIDs.includes(auctioncar.id)) {
                                $.ajax({

                                    url: "/get-car-image/" + auctioncar.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.auction-car').remove();

                                $.ajax({

                                    url: "/get-car-image/" + auctioncars.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        $('.auction-car').remove();

                        $.ajax({

                            url: "/get-car-image/" + auctioncars.id,
                            type: "get",
                            data: "",
                            success: function (response) {

                                console.log(response);

                                $('#page-contents').append(`
                            <div id="car-wrap" class="auction-car">
                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                </tr>
                                <tr>
                                    <td>${auctioncar.manufacture_year}</td>
                                    <td>${auctioncar.location}</td>
                                </tr>
                                <tr>
                                    <td>Price(Kshs) </td>
                                    <td><strong>${auctioncar.price}</strong></td>
                                </tr>
                                <tr>
                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div> 
                            `)
                            },
                            error: function (response) {

                                console.log(response)
                            }
                        })


                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }

        else if ((category == "Category...") && (model != "Model...")) {

            // populate models for a particular make
            $.ajax({

                url: "/get-car-models",
                type: "post",
                data: {
                    'make': make,
                    'model': model,
                    'label': 'make_model'

                },
                success: function (response) {

                    $('.car-model').remove();
                    models = response.models;
                    models.forEach(model => {
                        $('.searchauctionmodel').append(
                            `<option class='car-model'>${model}</option>`
                        );
                    })
                },
                error: function (response) {

                    console.log(response);
                },

            });


            //use make and category for filtering
            $.ajax({

                url: "/filter-auction-cars",
                type: "post",
                data: {

                    'make': make,
                    'label': 'make'
                },
                success: function (response) {

                    auctioncars = response.cars
                    reservedCarsIDs = response.reservedCarsIDs

                    //user is logged in
                    if (response.loggedin) {
                        console.log(response);

                        $('.auction-car').remove();


                        auctioncars.forEach(auctioncar => {

                            //blocked user voted categories
                            if (reservedCarsIDs.includes(auctioncar.id)) {
                                $.ajax({

                                    url: "/get-car-image/" + auctioncar.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                            <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.auction-car').remove();

                                $.ajax({

                                    url: "/get-car-image/" + auctioncars.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                    <div id="car-wrap" class="auction-car">
                                    <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                        </tr>
                                        <tr>
                                            <td>${auctioncar.manufacture_year}</td>
                                            <td>${auctioncar.location}</td>
                                        </tr>
                                        <tr>
                                            <td>Price(Kshs) </td>
                                            <td><strong>${auctioncar.price}</strong></td>
                                        </tr>
                                        <tr>
                                        <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                        <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                        </tr>
                                        
                                        </tbody>
                                    </table>
                                </div> 
                                    `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        $('.auction-car').remove();

                        $.ajax({

                            url: "/get-car-image/" + auctioncars.id,
                            type: "get",
                            data: "",
                            success: function (response) {

                                console.log(response);

                                $('#page-contents').append(`
                            <div id="car-wrap" class="auction-car">
                            <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                </tr>
                                <tr>
                                    <td>${auctioncar.manufacture_year}</td>
                                    <td>${auctioncar.location}</td>
                                </tr>
                                <tr>
                                    <td>Price(Kshs) </td>
                                    <td><strong>${auctioncar.price}</strong></td>
                                </tr>
                                <tr>
                                <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                </tr>
                                
                                </tbody>
                            </table>
                        </div> 
                            `)
                            },
                            error: function (response) {

                                console.log(response)
                            }
                        })


                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });



        }

    });



    //trigger psv filter by model
    $(".searchauctionmodel").on('change', function () {

        let category = $('.searchauctioncarcategory').val();
        let make = $('.searchauctioncarmake').val();
        let model = $('.searchauctionmodel').val();

        if ((category == "Category...") && (make == "Make...")) {

            //the use trys to search creepy stuff do nothing
            location.reload();
            return;

        }

        //category and make option are occupied
        else if ((category != "Category...") && (make != "Make...")) {
            //category, make and model options are not blank
            if ((model != "Model...")) {

                $.ajax({

                    url: "/filter-auction-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'model': model,
                        'label': 'all'
                    },
                    success: function (response) {

                        auctioncars = response.cars
                        reservedCarsIDs = response.reservedCarsIDs

                        //user is logged in
                        if (response.loggedin) {
                            console.log(response);

                            $('.auction-car').remove();


                            auctioncars.forEach(auctioncar => {

                                //blocked user voted categories
                                if (reservedCarsIDs.includes(auctioncar.id)) {
                                    $.ajax({

                                        url: "/get-car-image/" + auctioncar.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.auction-car').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + auctioncars.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            $('.auction-car').remove();

                            $.ajax({

                                url: "/get-car-image/" + auctioncars.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                <div id="car-wrap" class="auction-car">
                                <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td>${auctioncar.manufacture_year}</td>
                                        <td>${auctioncar.location}</td>
                                    </tr>
                                    <tr>
                                        <td>Price(Kshs) </td>
                                        <td><strong>${auctioncar.price}</strong></td>
                                    </tr>
                                    <tr>
                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div> 
                                `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })


                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }

            //category and make option are occupied
            else {

                $.ajax({

                    url: "/filter-auction-cars",
                    type: "post",
                    data: {

                        'category': category,
                        'make': make,
                        'label': 'category_make'
                    },
                    success: function (response) {

                        auctioncars = response.cars
                        reservedCarsIDs = response.reservedCarsIDs

                        //user is logged in
                        if (response.loggedin) {
                            console.log(response);

                            $('.auction-car').remove();


                            auctioncars.forEach(auctioncar => {

                                //blocked user voted categories
                                if (reservedCarsIDs.includes(auctioncar.id)) {
                                    $.ajax({

                                        url: "/get-car-image/" + auctioncar.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.auction-car').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + auctioncars.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            $('.auction-car').remove();

                            $.ajax({

                                url: "/get-car-image/" + auctioncars.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                <div id="car-wrap" class="auction-car">
                                <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td>${auctioncar.manufacture_year}</td>
                                        <td>${auctioncar.location}</td>
                                    </tr>
                                    <tr>
                                        <td>Price(Kshs) </td>
                                        <td><strong>${auctioncar.price}</strong></td>
                                    </tr>
                                    <tr>
                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div> 
                                `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })


                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });

            }
        }
        else if ((category == "Category...") && (make != "Make...")) {

            $.ajax({

                url: "/filter-auction-cars",
                type: "post",
                data: {
                    'model': model,
                    'make': make,
                    'label': 'make_model'
                },
                success: function (response) {

                    auctioncars = response.cars
                    reservedCarsIDs = response.reservedCarsIDs

                    //user is logged in
                    if (response.loggedin) {
                        console.log(response);

                        $('.auction-car').remove();


                        auctioncars.forEach(auctioncar => {

                            //blocked user voted categories
                            if (reservedCarsIDs.includes(auctioncar.id)) {
                                $.ajax({

                                    url: "/get-car-image/" + auctioncar.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })


                            }

                            else {
                                $('.auction-car').remove();

                                $.ajax({

                                    url: "/get-car-image/" + auctioncars.id,
                                    type: "get",
                                    data: "",
                                    success: function (response) {

                                        console.log(response);

                                        $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                    },
                                    error: function (response) {

                                        console.log(response)
                                    }
                                })



                            }


                        })

                    }
                    else {
                        //user not logged in
                        $('.auction-car').remove();

                        $.ajax({

                            url: "/get-car-image/" + auctioncars.id,
                            type: "get",
                            data: "",
                            success: function (response) {

                                console.log(response);

                                $('#page-contents').append(`
                                <div id="car-wrap" class="auction-car">
                                <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td>${auctioncar.manufacture_year}</td>
                                        <td>${auctioncar.location}</td>
                                    </tr>
                                    <tr>
                                        <td>Price(Kshs) </td>
                                        <td><strong>${auctioncar.price}</strong></td>
                                    </tr>
                                    <tr>
                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div> 
                                `)
                            },
                            error: function (response) {

                                console.log(response)
                            }
                        })


                    }

                },
                error: function (response) {
                    console.log(response.error);

                }
            });

        }

        else if ((category == "Category...") && (model == "Model...")) {

            if ((make != "Make...")) {

                // populate models for a particular make
                $.ajax({

                    url: "/get-car-models",
                    type: "post",
                    data: {
                        'make': make,
                        'label': make
                    },
                    success: function (response) {

                        $('.car-model').remove();
                        models = response.models;
                        models.forEach(model => {
                            $('.searchauctionmodel').append(
                                `<option class='car-model'>${model}</option>`
                            );
                        })
                    },
                    error: function (response) {

                        console.log(response);
                    }
                });

                $.ajax({

                    url: "/filter-auction-cars",
                    type: "post",
                    data: {
                        'make': make,
                        'label': make
                    },
                    success: function (response) {

                        auctioncars = response.cars
                        reservedCarsIDs = response.reservedCarsIDs

                        //user is logged in
                        if (response.loggedin) {
                            console.log(response);

                            $('.auction-car').remove();


                            auctioncars.forEach(auctioncar => {

                                //blocked user voted categories
                                if (reservedCarsIDs.includes(auctioncar.id)) {
                                    $.ajax({

                                        url: "/get-car-image/" + auctioncar.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                                <td><a  style="pointer-events: none; cursor: default;" href="#" type="button" class="btn btn-secondary btn-sm" disabled>Reserved</a></td>
                                                <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })


                                }

                                else {
                                    $('.auction-car').remove();

                                    $.ajax({

                                        url: "/get-car-image/" + auctioncars.id,
                                        type: "get",
                                        data: "",
                                        success: function (response) {

                                            console.log(response);

                                            $('#page-contents').append(`
                                        <div id="car-wrap" class="auction-car">
                                        <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                            </tr>
                                            <tr>
                                                <td>${auctioncar.manufacture_year}</td>
                                                <td>${auctioncar.location}</td>
                                            </tr>
                                            <tr>
                                                <td>Price(Kshs) </td>
                                                <td><strong>${auctioncar.price}</strong></td>
                                            </tr>
                                            <tr>
                                            <td><a href="/reserve-car/${auctioncar.id}" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                            <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div> 
                                        `)
                                        },
                                        error: function (response) {

                                            console.log(response)
                                        }
                                    })



                                }


                            })

                        }
                        else {
                            //user not logged in
                            $('.auction-car').remove();

                            $.ajax({

                                url: "/get-car-image/" + auctioncars.id,
                                type: "get",
                                data: "",
                                success: function (response) {

                                    console.log(response);

                                    $('#page-contents').append(`
                                <div id="car-wrap" class="auction-car">
                                <a href="/auction-cardetails/${auctioncar.id}"><img src="vehicle_images/${response.car_main_image}" class="car-thumb" /></a>
                                <table class="table">
                                    <tbody>
                                    <tr>
                                        <td colspan="2"><a href="/auction-cardetails/${auctioncar.id}" class="title3"><strong>${auctioncar.vehicle_name}</strong></a></td>
                                    </tr>
                                    <tr>
                                        <td>${auctioncar.manufacture_year}</td>
                                        <td>${auctioncar.location}</td>
                                    </tr>
                                    <tr>
                                        <td>Price(Kshs) </td>
                                        <td><strong>${auctioncar.price}</strong></td>
                                    </tr>
                                    <tr>
                                    <td><a href="/login" type="button" class="btn btn-primary btn-sm">Reserve</a></td>
                                    <td><a href="#" style="float:right;"><img src="images/share.png" /></a></td>
                                    </tr>
                                    
                                    </tbody>
                                </table>
                            </div> 
                                `)
                                },
                                error: function (response) {

                                    console.log(response)
                                }
                            })


                        }

                    },
                    error: function (response) {
                        console.log(response.error);

                    }
                });


            }



        }

    });


    //populate the create car page based on certain selection
    $('#carfor').on('change', function () {

        let carfor = $('#carfor').val();

        if (carfor == 'Car of the year award') {

            $('#price').prop('disabled', true);;
            $('#vehicle_name').prop('disabled', true);;
            $('#sacco_name').prop('disabled', true);;
            $('#route').prop('disabled', true);;
          

        }
        else if (carfor == 'PSV of the year award') {
            
            $('#price').prop('disabled', true);;
            $('#vehicle_name').prop('disabled', false);
            $('#sacco_name').prop('disabled', false);
            $('#route').prop('disabled', false);

        }
        else if (carfor == 'Car for Auction') {

            $('#price').prop('disabled', false);;
            $('#vehicle_name').prop('disabled', true);
            $('#sacco_name').prop('disabled', true);
            $('#route').prop('disabled', true);

        }
        else {

            //do nothing
        }


    // Don't go any further down the script if [data-notification] is not set.
    if ( ! document.body.dataset.notification)
    return false;


    });


    //This function will be called no matter the case.
    (function(){
        
        let carfor = $('#carfor').val();

            if (carfor == 'Car of the year award') {

                $('#price').prop('disabled', true);;
                $('#vehicle_name').prop('disabled', true);;
                $('#sacco_name').prop('disabled', true);;
                $('#route').prop('disabled', true);;
            

            }
            else if (carfor == 'PSV of the year award') {
                
                $('#price').prop('disabled', true);;
                $('#vehicle_name').prop('disabled', false);
                $('#sacco_name').prop('disabled', false);
                $('#route').prop('disabled', false);

            }
            else if (carfor == 'Car for Auction') {

                $('#price').prop('disabled', false);;
                $('#vehicle_name').prop('disabled', true);
                $('#sacco_name').prop('disabled', true);
                $('#route').prop('disabled', true);

            }
            else {

                //do nothing
            }

            
       
    })();
     


});
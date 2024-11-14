@extends('layouts.front-end')
@section('content')
    <div class="page-content">
        @if (session('success'))
            <div class="alert text-success alert-light" id="success-message"
                 style="position: fixed; top: 20px; right: 20px; max-width: 300px; z-index: 1000; padding: 15px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                {{ session('success') }}
            </div>
        @endif
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
                        <form action="{{ route('front-end.create-car') }}" method="post" enctype="multipart/form-data"
                              class="row g-3">
                            @csrf
                            <div class="col-md-4">
                                <label for="reason" class="form-label"><strong>Submit car for?</strong></label>
                                <select name="reason" id="reason" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="award" {{ old('reason') == 'award' ? 'selected' : '' }}>Car of the year award</option>
                                </select>
                                @error('reason')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="make_id" class="form-label">Make</label>
                                <select name="make_id" id="make_id" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="1" {{ old('make_id') == '1' ? 'selected' : '' }}>Audi</option>
                                    <option value="2" {{ old('make_id') == '2' ? 'selected' : '' }}>Audi</option>
                                </select>
                                @error('make_id')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="vehicle_model_id" class="form-label">Model</label>
                                <select name="vehicle_model_id" id="vehicle_model_id" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="1" {{ old('vehicle_model_id') == '1' ? 'selected' : '' }}>A1</option>
                                    <option value="2" {{ old('vehicle_model_id') == '2' ? 'selected' : '' }}>A2</option>
                                </select>
                                @error('vehicle_model_id')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="manufacturing_year" class="form-label">Year of Manufacture</label>
                                <select id="manufacturing_year" name="manufacturing_year" class="form-select">
                                    <option value="">Choose...</option>
                                    <option {{ old('manufacturing_year') == '2020' ? 'selected' : '' }}>2020</option>
                                    <option {{ old('manufacturing_year') == '2021' ? 'selected' : '' }}>2021</option>
                                    <option {{ old('manufacturing_year') == '2022' ? 'selected' : '' }}>2022</option>
                                </select>
                                @error('manufacturing_year')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" name="location" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="Nairobi" {{ old('location') == 'Nairobi' ? 'selected' : '' }}>Nairobi</option>
                                    <option value="Mombasa" {{ old('location') == 'Mombasa' ? 'selected' : '' }}>Mombasa</option>
                                    <option value="Nakuru" {{ old('location') == 'Nakuru' ? 'selected' : '' }}>Nakuru</option>
                                </select>
                                @error('location')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="eng_cc" class="form-label">Engine cc</label>
                                <input type="text" name="eng_cc" class="form-control" id="eng_cc" value="{{ old('eng_cc') }}" placeholder="1500">
                                @error('eng_cc')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="transmission" class="form-label">Transmission</label>
                                <select id="transmission" name="transmission" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual</option>
                                </select>
                                @error('transmission')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="fuel_type" class="form-label">Fuel Type</label>
                                <select id="fuel_type" name="fuel_type" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="petrol" {{ old('fuel_type') == 'petrol' ? 'selected' : '' }}>Petrol</option>
                                    <option value="diesel" {{ old('fuel_type') == 'diesel' ? 'selected' : '' }}>Diesel</option>
                                </select>
                                @error('fuel_type')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="interior_color" class="form-label">Interior color</label>
                                <select id="interior_color" name="interior_color" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="dark" {{ old('interior_color') == 'dark' ? 'selected' : '' }}>Dark</option>
                                    <option value="white" {{ old('interior_color') == 'white' ? 'selected' : '' }}>White</option>
                                </select>
                                @error('interior_color')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="exterior_color" class="form-label">Exterior color</label>
                                <select id="exterior_color" name="exterior_color" class="form-select">
                                    <option value="">Choose...</option>
                                    <option value="black" {{ old('exterior_color') == 'black' ? 'selected' : '' }}>Black</option>
                                    <option value="pearl_white" {{ old('exterior_color') == 'pearl_white' ? 'selected' : '' }}>Pearl White</option>
                                </select>
                                @error('exterior_color')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="vehicle_reg" class="form-label">Vehicle Registration</label>
                                <input type="text" name="vehicle_reg" class="form-control" id="vehicle_reg" placeholder="KAA 000A" value="{{ old('vehicle_reg') }}">
                                @error('vehicle_reg')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="price" class="form-label">Price(Kshs)</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="800,000" value="{{ old('price') }}">
                                @error('price')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Vehicle Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Vehicle Name" value="{{ old('name') }}">
                                @error('name')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="sacco" class="form-label">Sacco Name</label>
                                <input type="text" name="sacco" class="form-control" id="sacco" placeholder="Sacco Name" value="{{ old('sacco') }}">
                                @error('sacco')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="route" class="form-label">Route</label>
                                <input type="text" name="route" class="form-control" id="route" placeholder="Route" value="{{ old('route') }}">
                                @error('route')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <label for="description" class="form-label">Description(What is unique about this car?)</label>
                                <textarea class="form-control" name="description" id="description" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="vehicle_images" class="form-label">Upload car photos(Max 10)</label>
                                <input class="form-control" type="file" name="vehicle_images[]" id="vehicle_images"
                                       multiple>
                                @error('vehicle_images')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Save Details</button>
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
                    <input type="email" id="newsInputEmail1" aria-describedby="emailHelp"
                           placeholder="Enter your email address">
                    <button type="submit" class="btn btn-primary">SIGN UP</button>
                </form>
            </div> <!--==end of <div id="container">==-->
        </div> <!--==end of <div id="newsletter-wrap">==-->
    </div>
@endsection
@push('js')
    <script>
        setTimeout(function () {
            document.getElementById('success-message').style.display = 'none';
        }, 4000); // Hide after 3 seconds
    </script>
@endpush

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

                <div id="title-inner">Edit car</div>
            </div><!----end of  <div id="inner-container">---->
        </div> <!--==end of <div id="banner-in"> ==-->

        <div id="wrapper-inner">
            <div id="container">
                <div id="page-contents">
                    <div id="car-form">
                        <form action="{{ route('front-end.update-car',$vehicle->id) }}" method="post"
                              enctype="multipart/form-data"
                              class="row g-3">
                            @method('PUT')
                            @csrf
                            <div style="display: none;" class="col-md-4">
                                <label for="reason" class="form-label"><strong>Submit car for?</strong></label>
                                <select name="reason" id="reason" class="form-select">
                                    <option value="">Choose...</option>
                                    <option
                                        value="award" {{ old('reason', $vehicle->reason) == 'award' ? 'selected' : '' }}>
                                        Car of the year award
                                    </option>
                                </select>
                                @error('reason')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="category_id" class="form-label"><strong>Category</strong></label>
                                <select name="category_id" id="category_id" class="form-select">
                                    <option value="">Choose...</option>
                                    @foreach($categories as $category)
                                        <option
                                            value="{{ $category->id }}" {{ old('category_id',$vehicle->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger text-xs pt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-md-8">
                                <livewire:layout.front-end.edit-car-make-models :vehicle="$vehicle"/>
                            </div>

                            <div class="col-md-4">
                                <label for="manufacturing_year" class="form-label">Year of Manufacture</label>
                                <select id="manufacturing_year" name="manufacturing_year" class="form-select">
                                    <option value="">Choose...</option>
                                    @for ($year = 2010; $year <= 2024; $year++)
                                        <option
                                            value="{{ $year }}" {{ old('manufacturing_year', $vehicle->manufacturing_year) == $year ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                                @error('manufacturing_year')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            @php
                                $kenyaTowns = [
                                    'Nairobi', 'Mombasa', 'Nakuru', 'Kisumu', 'Eldoret', 'Kisii', 'Kericho',
                                    'Malindi', 'Kitale', 'Nyeri', 'Thika', 'Embu', 'Meru', 'Kakamega', 'Laikipia',
                                    'Voi', 'Lamu', 'Garissa', 'Isiolo', 'Nanyuki', 'Bomet', 'Ruiru', 'Kiambu', 'Mtwapa'
                                ];
                            @endphp
                            <div class="col-md-4">
                                <label for="location" class="form-label">Location</label>
                                <select id="location" name="location" class="form-select">
                                    <option value="">Choose...</option>
                                    @foreach ($kenyaTowns as $town)
                                        <option
                                            value="{{ $town }}" {{ old('location', $vehicle->location) == $town ? 'selected' : '' }}>
                                            {{ $town }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('location')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="eng_cc" class="form-label">Engine cc</label>
                                <input type="text" name="eng_cc" class="form-control" id="eng_cc"
                                       value="{{ old('eng_cc',$vehicle->eng_cc) }}" placeholder="1500">
                                @error('eng_cc')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="transmission" class="form-label">Transmission</label>
                                <select id="transmission" name="transmission" class="form-select">
                                    <option value="">Choose...</option>
                                    <option
                                        value="automatic" {{ old('transmission',$vehicle->transmission) == 'automatic' ? 'selected' : '' }}>
                                        Automatic
                                    </option>
                                    <option
                                        value="manual" {{ old('transmission',$vehicle->transmission) == 'manual' ? 'selected' : '' }}>
                                        Manual
                                    </option>
                                </select>
                                @error('transmission')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="fuel_type" class="form-label">Fuel Type</label>
                                <select id="fuel_type" name="fuel_type" class="form-select">
                                    <option value="">Choose...</option>
                                    <option
                                        value="petrol" {{ old('fuel_type',$vehicle->fuel_type) == 'petrol' ? 'selected' : '' }}>
                                        Petrol
                                    </option>
                                    <option
                                        value="diesel" {{ old('fuel_type',$vehicle->fuel_type) == 'diesel' ? 'selected' : '' }}>
                                        Diesel
                                    </option>
                                </select>
                                @error('fuel_type')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="interior_color" class="form-label">Interior color</label>
                                <select id="interior_color" name="interior_color" class="form-select">
                                    <option value="">Choose...</option>
                                    <option
                                        value="dark" {{ old('interior_color',$vehicle->interior_color) == 'dark' ? 'selected' : '' }}>
                                        Dark
                                    </option>
                                    <option
                                        value="white" {{ old('interior_color',$vehicle->interior_color) == 'white' ? 'selected' : '' }}>
                                        White
                                    </option>
                                </select>
                                @error('interior_color')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="exterior_color" class="form-label">Exterior color</label>
                                <select id="exterior_color" name="exterior_color" class="form-select">
                                    <option value="">Choose...</option>
                                    <option
                                        value="black" {{ old('exterior_color', $vehicle->exterior_color) == 'black' ? 'selected' : '' }}>
                                        Black
                                    </option>
                                    <option
                                        value="white" {{ old('exterior_color', $vehicle->exterior_color) == 'white' ? 'selected' : '' }}>
                                        White
                                    </option>
                                    <option
                                        value="gray_silver" {{ old('exterior_color', $vehicle->exterior_color) == 'gray_silver' ? 'selected' : '' }}>
                                        Gray/Silver
                                    </option>
                                    <option
                                        value="blue" {{ old('exterior_color', $vehicle->exterior_color) == 'blue' ? 'selected' : '' }}>
                                        Blue
                                    </option>
                                    <option
                                        value="red" {{ old('exterior_color', $vehicle->exterior_color) == 'red' ? 'selected' : '' }}>
                                        Red
                                    </option>
                                    <option
                                        value="green" {{ old('exterior_color', $vehicle->exterior_color) == 'green' ? 'selected' : '' }}>
                                        Green
                                    </option>
                                    <option
                                        value="yellow" {{ old('exterior_color', $vehicle->exterior_color) == 'yellow' ? 'selected' : '' }}>
                                        Yellow
                                    </option>
                                    <option
                                        value="orange" {{ old('exterior_color', $vehicle->exterior_color) == 'orange' ? 'selected' : '' }}>
                                        Orange
                                    </option>
                                    <option
                                        value="brown" {{ old('exterior_color', $vehicle->exterior_color) == 'brown' ? 'selected' : '' }}>
                                        Brown
                                    </option>
                                    <option
                                        value="gold" {{ old('exterior_color', $vehicle->exterior_color) == 'gold' ? 'selected' : '' }}>
                                        Gold
                                    </option>
                                    <option
                                        value="beige_tan" {{ old('exterior_color', $vehicle->exterior_color) == 'beige_tan' ? 'selected' : '' }}>
                                        Beige/Tan
                                    </option>
                                    <option
                                        value="purple" {{ old('exterior_color', $vehicle->exterior_color) == 'purple' ? 'selected' : '' }}>
                                        Purple
                                    </option>
                                </select>
                                @error('exterior_color')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="vehicle_reg" class="form-label">Vehicle Registration</label>
                                <input type="text" name="vehicle_reg" class="form-control" id="vehicle_reg"
                                       placeholder="KAA 000A" value="{{ old('vehicle_reg',$vehicle->vehicle_reg) }}">
                                @error('vehicle_reg')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="price" class="form-label">Price(Kshs)</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="800,000"
                                       value="{{ old('price',$vehicle->price) }}">
                                @error('price')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="name" class="form-label">Vehicle Name</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="Vehicle Name"
                                       value="{{ old('name',$vehicle->name) }}">
                                @error('name')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="description" class="form-label">Description(What is unique about this
                                    car?)</label>
                                <textarea class="form-control" name="description" id="description"
                                          rows="3">{{ old('description',$vehicle->description) }}</textarea>
                                @error('description')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label style="width:100%;" for="vehicle_images" class="">Upload car photos(Max 10) <span
                                        class="text-danger">These Images will replace the old one*</span></label>
                                <input class="form-control" type="file" name="vehicle_images[]" id="vehicle_images"
                                       multiple>
                                @error('vehicle_images')
                                <p class="text-danger text-xs pt-1"> {{ $message }} </p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update Vehicle</button>
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

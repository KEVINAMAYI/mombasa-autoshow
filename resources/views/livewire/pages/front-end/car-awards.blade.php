<?php

use App\Models\Category;
use App\Models\Make;
use App\Models\Transaction;
use App\Models\Vehicle;
use App\Models\VehicleModel;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Volt\Component;
use Livewire\WithPagination;

new #[Layout('layouts.front-end')] class extends Component {

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $category_id;
    public $make_id;
    public $vehicle_model_id;
    public $manufacturing_year;
    public $makes;
    public $categories;
    public $models;

    public function mount()
    {
        $this->makes = Make::all();
        $this->categories = Category::all();
        $this->models = VehicleModel::all();
    }

    public function updatedSearch()
    {
        $this->with();
    }

    public function updateModels()
    {
        $this->models = VehicleModel::where('make_id', $this->make_id)->get();
        $this->with();
    }

    public function getVehiclesQuery()
    {
        $query = Vehicle::where('published', 1)
            ->with(['make', 'vehicle_model', 'images', 'votes']) // Eager load relationships
            ->withCount('votes')
            ->orderBy('votes_count', 'desc');

        if ($this->search) {
            $query->where('vehicle_reg', 'like', '%' . $this->search . '%')
                ->orWhere('location', 'like', '%' . $this->search . '%')
                ->orWhere('name', 'like', '%' . $this->search . '%')
                ->orWhere('interior_color', 'like', '%' . $this->search . '%')
                ->orWhere('exterior_color', 'like', '%' . $this->search . '%')
                ->orWhere('transmission', 'like', '%' . $this->search . '%')
                ->orWhereHas('make', function ($makeQuery) {
                    $makeQuery->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('vehicle_model', function ($modelQuery) {
                    $modelQuery->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('category', function ($modelQuery) {
                    $modelQuery->where('name', 'like', '%' . $this->search . '%');
                });
        }

        // Filters
        if ($this->category_id) {
            $query->where('category_id', $this->category_id);
        }
        if ($this->make_id) {
            $query->where('make_id', $this->make_id);
        }
        if ($this->vehicle_model_id) {
            $query->where('vehicle_model_id', $this->vehicle_model_id);
        }
        if ($this->manufacturing_year) {
            $query->where('manufacturing_year', $this->manufacturing_year);
        }

        return $query;
    }

    #[On('filter')]
    public function with()
    {
        return [
            'vehicles' => $this->getVehiclesQuery()->paginate(10)
        ];
    }

    #[On('get-vehicles')]
    public function confirmVotes()
    {


        DB::beginTransaction();

        try {

            $lastTransaction = Transaction::latest()->first();

            if ($lastTransaction && $lastTransaction->status === 'completed') {

                $votesFromTransaction = floor($lastTransaction->amount / 50);

                $existingVotesCount = Vote::where('transaction_id', $lastTransaction->id)
                    ->count();

                $votesToInsert = $votesFromTransaction - $existingVotesCount;

                if ($votesToInsert > 0) {
                    $voteData = [];
                    for ($i = 1; $i <= $votesToInsert; $i++) {
                        $voteData[] = [
                            'transaction_id' => $lastTransaction->id,
                            'user_id' => auth()->user()->id,
                            'vehicle_id' => $lastTransaction->vehicle_id,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    }

                    Vote::insert($voteData);
                }

                if ($votesToInsert < 0) {

                    $votesToDelete = abs($votesToInsert);
                    Vote::where('transaction_id', $lastTransaction->id)
                        ->where('vehicle_id', $lastTransaction->vehicle_id)
                        ->orderBy('created_at', 'desc')
                        ->take($votesToDelete)
                        ->delete();

                }

            }

            $this->with();
            DB::commit();

        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());

        }
    }


} ?>
@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endpush
<div class="page-content">

    @if (session('success_messages'))
        <div id="alert-container">
            @foreach (session('success_messages') as $index => $message)
                <div class="alert text-success alert-light"
                     id="alert-{{ $index }}"
                     style="position: fixed; top: 20px; right: 20px; max-width: 300px; z-index: 1000; padding: 15px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); margin-bottom: 10px; display: none;">
                    {{ $message }}
                </div>
            @endforeach
        </div>
    @endif

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
                    <div class="{{ auth()->check() && auth()->user()->is_admin ? 'col-sm-9' : 'col-sm-12' }}">
                        <input type="text" name="search" wire:model.live="search" class="form-control"
                               placeholder="Search for car by make, model, or any keyword">
                    </div>
                    @if(auth()->check() && auth()->user()->is_admin)
                        <div class="col-sm-3">
                            <a href="{{ route('front-end.create-car') }}" class="btn2" style="margin-top:0;">Submit a
                                Car</a>
                        </div>
                    @endif
                </div>
                <!-- =======end of Search====-->
                <div class="row g-3" style="margin-top:5px;">
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="autoSizingSelect">Category</label>
                        <select wire:change="$dispatch('filter')" wire:model="category_id" class="form-select"
                                id="autoSizingSelect">
                            <option value="" selected>All Categories...</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="make_id">All Makes</label>
                        <select wire:change="updateModels" wire:model="make_id" class="form-select" id="make_id">
                            <option value="" selected>All Makes...</option>
                            @foreach($makes as $make)
                                <option value="{{ $make->id }}">{{ $make->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="vehicle_model_id">All Models</label>
                        <select wire:change="$dispatch('filter')" class="form-select" wire:model="vehicle_model_id"
                                id="vehicle_model_id">
                            <option value="" selected>All Models...</option>
                            @foreach($models as $model)
                                <option value="{{ $model->id }}">{{ $model->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label class="visually-hidden" for="manufacturing_year">Year of Award</label>
                        <select wire:change="$dispatch('filter')" wire:model="manufacturing_year" class="form-select"
                                id="manufacturing_year">
                            <option value="" selected>All Years...</option>
                            @for ($year = 2010; $year <= 2024; $year++)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

            @if($vehicles->isNotEmpty()) <!-- Use isNotEmpty() for collection check -->
                @foreach($vehicles as $vehicle)
                    <div id="car-wrap">
                        <a style="text-decoration:none;" href="{{ route('front-end.car-details', $vehicle->id) }}">
                            <img
                                src="{{ $vehicle->images->isNotEmpty() ? $vehicle->images->first()->image_url : 'front-end/images/slider/car.jpg' }}"
                                class="car-thumb"/>
                            <table class="table">
                                <tbody>
                                <tr>
                                    <td colspan="2">
                                        <a href="{{ route('front-end.car-details', $vehicle->id) }}" class="title3">
                                            <strong>{{ $vehicle->name }}
                                                {{ optional($vehicle->make)->name }} -
                                                {{ optional($vehicle->vehicle_model)->name }}</strong>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $vehicle->manufacturing_year }}</td>
                                    <td>{{ $vehicle->location }}</td>
                                </tr>
                                <tr>
                                    <td>Total votes:</td>
                                    <td><strong>{{ $vehicle->votes->count() }}</strong></td>
                                </tr>
                                <tr>
                                    <td><a href="{{ route('front-end.checkout', $vehicle->id) }}" type="button"
                                           class="btn btn-primary btn-sm">Vote for me</a>
                                    </td>
                                    <td>
                                        <a href="#" data-id="{{ $vehicle->id }}"
                                           style="float:right;" class="shareModalBtn"><img
                                                src="front-end/images/share.png"/></a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </a>
                    </div>
                @endforeach
                @else
                    <p style="margin-top:20px; font-weight:bold; font-size:18px;" class="text-warning text-center">No
                        Vehicle Found</p>
                @endif

            </div> <!--==end of <div id="page-contents">==-->
        </div> <!--==end of <div id="container">==-->
    </div> <!--==end of <div id="wrapper-inner">==-->

    <div class="pagination-container">
        {{ $vehicles->links() }}
    </div>

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
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>

        $('.shareModalBtn').on('click', function (e) {
            e.preventDefault();

            // Get the vehicle ID from the data-id attribute
            const vehicleId = $(this).data('id');

            // Construct the dynamic URL
            const vehicleUrl = `https://www.mombasaautoshow.com/car-details/${vehicleId}`;

            // Set the URLs in the modal dynamically (for sharing)
            $('#shareFacebook').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(vehicleUrl)}`);
            $('#shareTwitter').attr('href', `https://twitter.com/intent/tweet?url=${encodeURIComponent(vehicleUrl)}`);
            $('#shareWhatsApp').attr('href', `https://api.whatsapp.com/send?text=${encodeURIComponent(vehicleUrl)}`);


            $('#shareModal').modal('show');
        })

        $('#closeShareModalBtn').on('click', function (e) {
            $('#shareModal').modal('hide');
        })


        // A cleaner version of your original code
        async function showMessages(messages) {
            for (let i = 0; i < messages.length; i++) {
                const alert = messages[i];
                const delay = i * 4000; // Stagger the appearance of each message by 4 seconds

                // Show the message and hide it after 4 seconds
                setTimeout(() => {
                    alert.style.display = 'block';
                    setTimeout(() => {
                        alert.style.display = 'none';
                    }, 4000); // Hide each message after 4 seconds
                }, delay);
            }

            // Dispatch the 'get-vehicles' event after all messages have been processed
            setTimeout(() => {
                Livewire.dispatch('get-vehicles');
            }, messages.length * 4000 + 1000); // Dispatch after all messages are hidden
        }

        // Call the function to show messages and trigger Livewire event
        showMessages(document.querySelectorAll('#alert-container .alert'));


    </script>
@endpush

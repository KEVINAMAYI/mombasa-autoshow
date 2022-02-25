<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Car;
use App\Models\Image;
use App\Models\Dealer;
use App\Models\CarMake;
use App\Models\CarsVote;
use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Models\CarReservation;
use App\Models\MpesaAmount;
use Illuminate\Support\Facades\Session;

class CarController extends Controller
{
    /*upload car
    *
    * 1. PSV of the Year
    * 2. Car of the Year
    * 3. Car for Auction 
    *
    */ 
    public function uploadCar(Car $car, Request $request)
    {    

          //userid
          $user_id = auth()->user()->id;
          
          //strore data for 'Car of the year award'
          if( $request->carfor == 'Car of the year award')
          {
              Session::put('carfor', $request->carfor);
              Session::put('make', $request->make);
              Session::put('category', $request->category);
              Session::put('model', $request->model);
              Session::put('manufacture_year', $request->manufacture_year);
              Session::put('location', $request->location);
              Session::put('engine_cc', $request->engine_cc);
              Session::put('transmission', $request->transmission);
              Session::put('fuel_type', $request->fuel_type);
              Session::put('interior_color', $request->interior_color);
              Session::put('exterior_color', $request->exterior_color);
              Session::put('vehicle_reg', $request->vehicle_reg);
              Session::put('description', $request->description);


          }

         //strore data for 'Car for Auction'
          if( $request->carfor == 'Car for Auction')
          {
              Session::put('carfor', $request->carfor);
              Session::put('make', $request->make);
              Session::put('category', $request->category);
              Session::put('model', $request->model);
              Session::put('manufacture_year', $request->manufacture_year);
              Session::put('location', $request->location);
              Session::put('engine_cc', $request->engine_cc);
              Session::put('transmission', $request->transmission);
              Session::put('fuel_type', $request->fuel_type);
              Session::put('interior_color', $request->interior_color);
              Session::put('exterior_color', $request->exterior_color);
              Session::put('vehicle_reg', $request->vehicle_reg);
              Session::put('description', $request->description);
              Session::put('price', $request->price);



          }

          //strore data for 'PSV of the Year'
          if( $request->carfor == 'PSV of the year award')
          {

              Session::put('carfor', $request->carfor);
              Session::put('make', $request->make);
              Session::put('category', $request->category);
              Session::put('model', $request->model);
              Session::put('manufacture_year', $request->manufacture_year);
              Session::put('location', $request->location);
              Session::put('engine_cc', $request->engine_cc);
              Session::put('transmission', $request->transmission);
              Session::put('fuel_type', $request->fuel_type);
              Session::put('interior_color', $request->interior_color);
              Session::put('exterior_color', $request->exterior_color);
              Session::put('vehicle_reg', $request->vehicle_reg);
              Session::put('description', $request->description);
              Session::put('vehicle_name', $request->vehicle_name);
              Session::put('sacco_name', $request->sacco_name);
              Session::put('route', $request->route);

          }

          //validate user details
          $request->validate([
            'carfor' => ['required', 'string', 'max:255'],
            'make' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'manufacture_year' => ['required', 'integer'],
            'location' => ['required', 'string','max:255'],
            'engine_cc' => ['required', 'string','max:255'],
            'transmission' => ['required', 'string','max:255'],
            'fuel_type' => ['required', 'string','max:255'],
            'interior_color' => ['required', 'string','max:255'],
            'exterior_color' => ['required', 'string','max:255'],
            'vehicle_reg' => ['required', 'string','max:255'],
            'price' => 'nullable',
            'vehicle_name' => 'nullable',
            'sacco_name' => 'nullable',
            'route' => 'nullable',
            'description' => ['required', 'string','max:255'],
            

        ]);

        $data = $request->all();
        
         //store car details to database
         $car = Car::create([
            'user_id' => $user_id,
            'carfor' => $data['carfor'],
            'make' => $data['make'],
            'category' => $data['category'],
            'model' =>  $data['model'],
            'manufacture_year' => $data['manufacture_year'],
            'location' => $data['location'],
            'engine_cc' => $data['engine_cc'],
            'transmission' => $data['transmission'],
            'fuel_type' => $data['fuel_type'],
            'interior_color' => $data['interior_color'],
            'exterior_color' => $data['exterior_color'],
            'vehicle_reg' => $data['vehicle_reg'],
            'price' => $data['price'] ?? 0,
            'vehicle_name' => $data['vehicle_name'] ?? '',
            'sacco_name' => $data['sacco_name'] ?? '',
            'route' => $data['route'] ?? '',
            'description' => $data['description'],
            'votes' => 0,
            'published' => 'NO'

        ]);

        //upload car images
        if($request->hasfile('photos'))
         {
           
            foreach($request->file('photos') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/vehicle_images/', $name);  
                
                Image::create([
                    'car_id' => $car->id,
                    'image_url' => $name
                ]);
                
            }
         }

         
         $account_number = $this->generateAccountNumber();
         $amountpayable = MpesaAmount::all()[0]['amount'];
         return view('/checkout')->with(['payingfor' => 'car','carid' => $car['id'],'account_number' => $account_number,'amountpayable' => $amountpayable ]);

    }


    public function editCar(Car $car, Request $request)
    {    

          //userid
          $user_id = auth()->user()->id;
    
          //validate user details
          $request->validate([
            'carfor' => ['required', 'string', 'max:255'],
            'make' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'manufacture_year' => ['required', 'integer'],
            'location' => ['required', 'string','max:255'],
            'engine_cc' => ['required', 'string','max:255'],
            'transmission' => ['required', 'string','max:255'],
            'fuel_type' => ['required', 'string','max:255'],
            'interior_color' => ['required', 'string','max:255'],
            'exterior_color' => ['required', 'string','max:255'],
            'vehicle_reg' => ['required', 'string','max:255'],
            'price' => 'nullable',
            'vehicle_name' => 'nullable',
            'sacco_name' => 'nullable',
            'route' => 'nullable',
            'description' => ['required', 'string','max:255'],
            

        ]);

        $data = $request->all();
        
         //store car details to database
         Car::where('id','=',$car['id'])->update([
            'user_id' => $user_id,
            'carfor' => $data['carfor'],
            'make' => $data['make'],
            'category' => $data['category'],
            'model' =>  $data['model'],
            'manufacture_year' => $data['manufacture_year'],
            'location' => $data['location'],
            'engine_cc' => $data['engine_cc'],
            'transmission' => $data['transmission'],
            'fuel_type' => $data['fuel_type'],
            'interior_color' => $data['interior_color'],
            'exterior_color' => $data['exterior_color'],
            'vehicle_reg' => $data['vehicle_reg'],
            'price' => $data['price'] ?? 0,
            'vehicle_name' => $data['vehicle_name'] ?? '',
            'sacco_name' => $data['sacco_name'] ?? '',
            'route' => $data['route'] ?? '',
            'description' => $data['description'],
            'votes' => 0,
            'published' => 'NO'

        ]);

        //upload car images
        if(($request->hasfile('photos')) && ($request->photos != null))
         {
            
            Image::where('car_id','=',$car['id'])->delete();
           
            foreach($request->file('photos') as $image)
            {
                $name=$image->getClientOriginalName();
                $image->move(public_path().'/vehicle_images/', $name);  
                
                Image::create([
                    'car_id' => $car['id'],
                    'image_url' => $name
                ]);
                
            }
         }
         
         session()->flash('success','Car/PSV Updated successfully');
         return redirect()->back();
    }


    private function generateAccountNumber()
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $numbers = '0123456789';
        $shuffled_letters = str_shuffle($letters);
        $shuffled_numbers = str_shuffle($numbers);
        $ref_number = substr($shuffled_letters, 0, 1).substr($shuffled_numbers, 0, 4);
        return $ref_number;
    }

    
    //Return cars with label PSV of the year
    public function getPSVSOfTheYear()
    {
        $user_id = auth()->user()->id;
        $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
        $userVotedCategories = array(); 
        $userVotedCars = array();

        foreach( $userCarVotes as $userCarVote)
        {   
            $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
            array_push($userVotedCategories,$userVotedCar[0]['category']);
            array_push($userVotedCars,$userVotedCar);

            
        }

        $voted = !empty($userVotedCategories);
        $PSVs = Car::where([['carfor','=','PSV of the year award'],
                            ['user_id','=',$user_id]])->orderBy('votes', 'DESC')->get();
        
        $PSVVotes = Car::where([['carfor','=','PSV of the year award'],
                            ['user_id','=',$user_id],
                            ['votes','>',0]])->orderBy('votes', 'DESC')->get();


        return view('mypsvs')->with(['PSVs' => $PSVs,'voted' => $voted, 'userVotedCategories' => $userVotedCategories,'PSVVotes' => $userVotedCars]);
    }

    //Return cars with label Car of the year
    public function getCarsOfTheYear()
    {   
        $user_id = auth()->user()->id;
        $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
        $userVotedCategories = array(); 
        $userVotedCars = array();

        foreach( $userCarVotes as $userCarVote)
        {   
            $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
            array_push($userVotedCategories,$userVotedCar[0]['category']);
            array_push($userVotedCars,$userVotedCar);
            
        }
        
        $voted = !empty($userVotedCategories);
        $Cars = Car::where([['carfor','=','Car of the year award'],
                            ['user_id','=',$user_id]])->orderBy('votes', 'DESC')->get();

        return view('mycars')->with(['Cars' => $Cars,'voted' => $voted, 'userVotedCategories' => $userVotedCategories, 'carVotes' => $userVotedCars ]);

    }

    //Return cars with label Car for Auction
    public function getAuctionCars()
    {   
        
        $reservedCars = CarReservation::all();
        $reservedCarsIDs = array();
        
        foreach($reservedCars as $reservedCar)
        {
            array_push($reservedCarsIDs,$reservedCar['car_id']);

        }

        $user_id = auth()->user()->id;
        $AuctionCars = Car::where([['carfor','=','Car for Auction'],
                                    ['user_id','=',$user_id]])->get();
        return view('auction-cars')->with(['AuctionCars' => $AuctionCars,'reservedCarsIDs' => $reservedCarsIDs]);

    }

    //Return cars with label Car for Auction
    public function getAuctionCarsForReservation()
    {   

        //get car models
        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }

        
        if(Auth::check())
        {

            $reservedCars = CarReservation::all();
            $reservedCarsIDs = array();
            
            foreach($reservedCars as $reservedCar)
            {
                array_push($reservedCarsIDs,$reservedCar['car_id']);

            }
            $AuctionCars = Car::where([['carfor','=','Car for Auction'],
                                       ['published','=','YES']])->get();
            return view('auction')->with(['AuctionCars' => $AuctionCars,'reservedCarsIDs' => $reservedCarsIDs,'carmakewithmodels' => $carmakewithmodels]);
            
        }
        else
        {
            $AuctionCars = Car::where([['carfor','=','Car for Auction'],
                                        ['published','=','YES']])->get();
            return view('auction')->with(['AuctionCars' => $AuctionCars,'carmakewithmodels' => $carmakewithmodels]);
       
        }

    }

    public function getCarDetails(Car $car)
    {
        
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 

            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }

            $carImages = Image::where('car_id','=',$car->id)->get();
            $voted = !empty($userVotedCategories);
            return view('car-details')->with(['car' => $car,'voted' => $voted, 'userVotedCategories' => $userVotedCategories,'carImages' => $carImages]);

        }
        else
        {
            $carImages = Image::where('car_id','=',$car->id)->get();
            return view('car-details')->with(['car' => $car,'carImages' => $carImages]);


        }
        

    }

    public function getPSVDetails(Car $car)
    {  
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 
    
            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }
    
    
            $carImages = Image::where('car_id','=',$car->id)->get();
            $voted = !empty($userVotedCategories);
            return view('psv-details')->with(['PSV' => $car,'voted' => $voted, 'userVotedCategories' => $userVotedCategories,'carImages' => $carImages]);
    
        }
        else
        {
            $carImages = Image::where('car_id','=',$car->id)->get();
            return view('psv-details')->with(['PSV' => $car,'carImages' => $carImages]);
    

        }
       

    }
    public function getAuctionCarDetails(Car $car)
    {
        $reservedCars = CarReservation::all();
        $reservedCarsIDs = array();
        
        foreach($reservedCars as $reservedCar)
        {
            array_push($reservedCarsIDs,$reservedCar['car_id']);

        }

        $reservedCars = CarReservation::all();
        $carImages = Image::where('car_id','=',$car->id)->get();
        return view('auction-cardetails')->with(['AuctionCar' => $car,'carImages' => $carImages,"reservedCarsIDs" => $reservedCarsIDs]);


    }

    //Return cars with label Car of the year to vote for 
    public function getCarsOfTheYearToVoteFor()
    {   

        //get car models
        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }


        //user loggedin
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 
    
            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }
    
            $voted = !empty($userVotedCategories);
            $Cars = Car::where([['carfor','=','Car of the year award'],
                                ['published','=','YES']])->orderBy('votes', 'DESC')->get();

            return view('car-awards')->with(['Cars' => $Cars,'voted' => $voted, 'userVotedCategories' => $userVotedCategories,'carmakewithmodels' => $carmakewithmodels]);
        }
        else{

            $Cars = Car::where([['carfor','=','Car of the year award'],
                                 ['published','=','YES']])->get();
            return view('car-awards')->with(['Cars' => $Cars,'carmakewithmodels' => $carmakewithmodels]);

        }

    }

    //Return cars with label Car of the year to vote for 
    public function getPSVSOfTheYearToVoteFor()
    {   
        //get car models
        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }
        
        //user loggedin
        if(Auth::check())
        {

            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 

            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }

            $voted = !empty($userVotedCategories);
            $PSVs = Car::where([['carfor','=','PSV of the year award'],
                                ['published','=','YES']])->orderBy('votes', 'DESC')->get();
            return view('psv-awards')->with(['PSVs' => $PSVs,'voted' => $voted, 'userVotedCategories' => $userVotedCategories,'carmakewithmodels' => $carmakewithmodels]);


        }
        else
        {

            $PSVs = Car::where([['carfor','=','PSV of the year award'],
                                ['published','=','YES']])->get();
            return view('psv-awards')->with(['PSVs' => $PSVs,'carmakewithmodels' => $carmakewithmodels]);


        }
        
    }


    //search for car for awards
    public function searchCar(Request $request)
    {
       
        //search data
        $searchquery = $request->searchquery;

        // $searchquery = $request->searchquery;
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 
    
            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }
    
            $voted = !empty($userVotedCategories);
            $Cars = Car::where([['carfor','=','Car of the year award'],
                                ['published','=','YES']])
                        ->where(function($query) use ($searchquery)
                        {
                            $query->orWhere('make','LIKE',"%{$searchquery}%")
                            ->orWhere('category','LIKE',"%{$searchquery}%")
                            ->orWhere('model','LIKE',"%{$searchquery}%")
                            ->orWhere('manufacture_year','LIKE',"%{$searchquery}%")
                            ->orWhere('location','LIKE',"%{$searchquery}%")
                            ->orWhere('transmission','LIKE',"%{$searchquery}%")
                            ->orWhere('fuel_type','LIKE',"%{$searchquery}%")
                            ->orWhere('interior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('exterior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_reg','LIKE',"%{$searchquery}%")
                            ->orWhere('price','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_name','LIKE',"%{$searchquery}%")
                            ->orWhere('sacco_name','LIKE',"%{$searchquery}%")
                            ->orWhere('route','LIKE',"%{$searchquery}%")
                            ->orWhere('votes','LIKE',"%{$searchquery}%");
                        })
                        ->orderBy('votes', 'DESC')
                        ->get();

            return  response()->json([
                'cars' => $Cars,
                'voted' => $voted,
                'userVotedCategories' => $userVotedCategories,
                'loggedin' => true
            ]);
        }
        else{

            $Cars = Car::where([['carfor','=','Car of the year award'],
                                 ['published','=','YES']])
                        ->where(function($query) use ($searchquery)
                        {
                            $query->orWhere('make','LIKE',"%{$searchquery}%")
                            ->orWhere('category','LIKE',"%{$searchquery}%")
                            ->orWhere('model','LIKE',"%{$searchquery}%")
                            ->orWhere('manufacture_year','LIKE',"%{$searchquery}%")
                            ->orWhere('location','LIKE',"%{$searchquery}%")
                            ->orWhere('transmission','LIKE',"%{$searchquery}%")
                            ->orWhere('fuel_type','LIKE',"%{$searchquery}%")
                            ->orWhere('interior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('exterior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_reg','LIKE',"%{$searchquery}%")
                            ->orWhere('price','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_name','LIKE',"%{$searchquery}%")
                            ->orWhere('sacco_name','LIKE',"%{$searchquery}%")
                            ->orWhere('route','LIKE',"%{$searchquery}%")
                            ->orWhere('votes','LIKE',"%{$searchquery}%");
                        })
                        ->orderBy('votes', 'DESC')
                        ->get();

            return response()->json([
                'cars' => $Cars,
                'loggedin' => false,
            ]);

        }


    }


    public function getcarImageOnSearch(Car $car)
    {

        $carImages = Image::where('car_id','=',$car->id)->get();
        return response()->json([
            'car_main_image' => $carImages[0]['image_url']
        ]);
    }



    //search psv for awards
    public function searchPSV(Request $request)
    {
       
        //search data
        $searchquery = $request->searchquery;

        // $searchquery = $request->searchquery;
        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 
    
            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }
    
            $voted = !empty($userVotedCategories);
            $PSVs = Car::where([['carfor','=','PSV of the year award'],
                                ['published','=','YES']])
                        ->where(function($query) use ($searchquery)
                        {
                            $query->orWhere('make','LIKE',"%{$searchquery}%")
                            ->orWhere('category','LIKE',"%{$searchquery}%")
                            ->orWhere('model','LIKE',"%{$searchquery}%")
                            ->orWhere('manufacture_year','LIKE',"%{$searchquery}%")
                            ->orWhere('location','LIKE',"%{$searchquery}%")
                            ->orWhere('transmission','LIKE',"%{$searchquery}%")
                            ->orWhere('fuel_type','LIKE',"%{$searchquery}%")
                            ->orWhere('interior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('exterior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_reg','LIKE',"%{$searchquery}%")
                            ->orWhere('price','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_name','LIKE',"%{$searchquery}%")
                            ->orWhere('sacco_name','LIKE',"%{$searchquery}%")
                            ->orWhere('route','LIKE',"%{$searchquery}%")
                            ->orWhere('votes','LIKE',"%{$searchquery}%");
                        })
                        ->orderBy('votes', 'DESC')
                        ->get();

            return  response()->json([
                'psvs' => $PSVs,
                'voted' => $voted,
                'userVotedCategories' => $userVotedCategories,
                'loggedin' => true
            ]);
        }
        else{

            $PSVs = Car::where([['carfor','=','PSV of the year award'],
                                ['published','=','YES']])
                        ->where(function($query) use ($searchquery)
                        {
                            $query->orWhere('make','LIKE',"%{$searchquery}%")
                            ->orWhere('category','LIKE',"%{$searchquery}%")
                            ->orWhere('model','LIKE',"%{$searchquery}%")
                            ->orWhere('manufacture_year','LIKE',"%{$searchquery}%")
                            ->orWhere('location','LIKE',"%{$searchquery}%")
                            ->orWhere('transmission','LIKE',"%{$searchquery}%")
                            ->orWhere('fuel_type','LIKE',"%{$searchquery}%")
                            ->orWhere('interior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('exterior_color','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_reg','LIKE',"%{$searchquery}%")
                            ->orWhere('price','LIKE',"%{$searchquery}%")
                            ->orWhere('vehicle_name','LIKE',"%{$searchquery}%")
                            ->orWhere('sacco_name','LIKE',"%{$searchquery}%")
                            ->orWhere('route','LIKE',"%{$searchquery}%")
                            ->orWhere('votes','LIKE',"%{$searchquery}%");
                        })
                        ->orderBy('votes', 'DESC')
                        ->get();

            return response()->json([
                'psvs' => $PSVs,
                'loggedin' => false,
            ]);

        }


    }


    public function getCarMakesandModels()
    {

        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }

        return view('/create-car')->with('carmakewithmodels',$carmakewithmodels);
        
    }


    public function getCarMakesandModelsforEdit(Car $car)
    {

        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }

        return view('/edit-car')->with(['carmakewithmodels' => $carmakewithmodels,'car' => $car]);
        
    }

    //get models when creating a car
    public function getModels(Request $request)
    {   
        $car_make = $request->make;

        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }


        return response()->json([
            
            'models' => $carmakewithmodels[$car_make]
        ]);

    }

    //get cars models
    public function getCarModels(Request $request)
    {   
        $car_make = $request->make;

        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }


        return response()->json([
            
            'models' => $carmakewithmodels[$car_make]
        ]);

    }

    //get psv models
    public function getPSVModels(Request $request)
    {   
        $car_make = $request->make;
        $carmakes =  CarMake::all();
        $carmakewithmodels = array();

        foreach($carmakes as $carmake)
        {

            $carmakemodels = array();
            $carmodels =  CarModel::where('car_make_id','=',$carmake['id'])->get();
            foreach( $carmodels as $carmodel)
            { 
               array_push($carmakemodels,$carmodel['car_model']);
            }

            $carmakewithmodels[$carmake['car_make']] = $carmakemodels;

        }

        return response()->json([
            
            'models' => $carmakewithmodels[$car_make]
        ]);

    }


    public function filterCars(Request $request)
    {

        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 
    
            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }
    
            $voted = !empty($userVotedCategories);
            
            //filter by category
            if($request->label == 'category')
            {
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'category' => $request->category,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category and make
            else if($request->label == 'category_make')
            {
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'published' => 'YES'])
                              ->orderBy('votes', 'DESC')
                              ->get();

            }
            //filter by category, make and model
            else if($request->label == 'all')
            {
                
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make')
            {
                
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'make' => $request->make,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make_model')
            {
                
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            return  response()->json([
                'cars' => $Cars,
                'voted' => $voted,
                'userVotedCategories' => $userVotedCategories,
                'loggedin' => true
            ]);
        }
        else{

            //filter by category
            if($request->label == 'category')
            {
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'category' => $request->category,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
             //filter by category and make
            else if($request->label == 'category_make')
            {
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'published' => 'YES'])
                              ->orderBy('votes', 'DESC')
                              ->get();

            }
            //filter by category, make and model
            else if($request->label == 'all')
            {
                
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make')
            {
                
                $Cars = Car::where(['carfor' => 'Car of the year award',
                                    'make' => $request->make,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
             //filter by category, make and model
             else if($request->label == 'make_model')
             {
                 
                 $Cars = Car::where(['carfor' => 'Car of the year award',
                                     'make' => $request->make,
                                     'model' => $request->model,
                                     'published' => 'YES'
                                     ])
                              ->orderBy('votes', 'DESC')
                              ->get();
             }
            return response()->json([
                'cars' => $Cars,
                'loggedin' => false,
            ]);

        }


    }


    public function filterPSVs(Request $request)
    {

        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $userCarVotes = CarsVote::where('user_id','=',$user_id)->get();
            $userVotedCategories = array(); 
    
            foreach( $userCarVotes as $userCarVote)
            {   
                $userVotedCar = Car::where('id','=',$userCarVote['car_id'])->get();
                array_push($userVotedCategories,$userVotedCar[0]['category']);
                
            }
    
            $voted = !empty($userVotedCategories);
            
            //filter by category
            if($request->label == 'category')
            {
                $PSVs = Car::where(['carfor' => 'PSV of the year award',
                                    'category' => $request->category,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category and make
            else if($request->label == 'category_make')
            {
                $PSVs = Car::where(['carfor' => 'PSV of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'published' => 'YES'])
                              ->orderBy('votes', 'DESC')
                              ->get();

            }
            //filter by category, make and model
            else if($request->label == 'all')
            {
                
                $PSVs = Car::where(['carfor' => 'PSV of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make')
            {
                
                $PSVs  = Car::where(['carfor' => 'PSV of the year award',
                                    'make' => $request->make,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make_model')
            {
                
                $PSVs  = Car::where(['carfor' => 'PSV of the year award',
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            return  response()->json([
                'psvs' => $PSVs ,
                'voted' => $voted,
                'userVotedCategories' => $userVotedCategories,
                'loggedin' => true
            ]);
        }
        else{

            //filter by category
            if($request->label == 'category')
            {
                $PSVs  = Car::where(['carfor' => 'PSV of the year award',
                                    'category' => $request->category,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
             //filter by category and make
            else if($request->label == 'category_make')
            {
                $PSVs  = Car::where(['carfor' => 'PSV of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'published' => 'YES'])
                              ->orderBy('votes', 'DESC')
                              ->get();

            }
            //filter by category, make and model
            else if($request->label == 'all')
            {
                
                $PSVs  = Car::where(['carfor' => 'PSV of the year award',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make')
            {
                
                $PSVs  = Car::where(['carfor' => 'PSV of the year award',
                                    'make' => $request->make,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
             //filter by category, make and model
             else if($request->label == 'make_model')
             {
                 
                $PSVs = Car::where(['carfor' => 'PSV of the year award',
                                     'make' => $request->make,
                                     'model' => $request->model,
                                     'published' => 'YES'
                                     ])
                              ->orderBy('votes', 'DESC')
                              ->get();
             }

            return response()->json([
                'psvs' => $PSVs,
                'loggedin' => false,
            ]);

        }


    }

     //search car for auction for reservation
     public function searchCarForAuction(Request $request)
     {
        
         //search data
         $searchquery = $request->searchquery;
 
         // $searchquery = $request->searchquery;
         if(Auth::check())
         {
             $reservedCars = CarReservation::all();
             $Cars = Car::where([['carfor','=','Car for Auction'],
                                 ['published','=','YES']])
                         ->where(function($query) use ($searchquery)
                         {
                             $query->orWhere('make','LIKE',"%{$searchquery}%")
                             ->orWhere('category','LIKE',"%{$searchquery}%")
                             ->orWhere('model','LIKE',"%{$searchquery}%")
                             ->orWhere('manufacture_year','LIKE',"%{$searchquery}%")
                             ->orWhere('location','LIKE',"%{$searchquery}%")
                             ->orWhere('transmission','LIKE',"%{$searchquery}%")
                             ->orWhere('fuel_type','LIKE',"%{$searchquery}%")
                             ->orWhere('interior_color','LIKE',"%{$searchquery}%")
                             ->orWhere('exterior_color','LIKE',"%{$searchquery}%")
                             ->orWhere('vehicle_reg','LIKE',"%{$searchquery}%")
                             ->orWhere('price','LIKE',"%{$searchquery}%")
                             ->orWhere('vehicle_name','LIKE',"%{$searchquery}%")
                             ->orWhere('sacco_name','LIKE',"%{$searchquery}%")
                             ->orWhere('route','LIKE',"%{$searchquery}%")
                             ->orWhere('votes','LIKE',"%{$searchquery}%");
                         })
                         ->get();
 
             return  response()->json([
                 'cars' =>  $Cars,
                 'reservedcars' => $reservedCars,
                 'loggedin' => true
             ]);
         }
         else{
 
             $Cars = Car::where([['carfor','=','Car for Auction'],
                                 ['published','=','YES']])
                         ->where(function($query) use ($searchquery)
                         {
                             $query->orWhere('make','LIKE',"%{$searchquery}%")
                             ->orWhere('category','LIKE',"%{$searchquery}%")
                             ->orWhere('model','LIKE',"%{$searchquery}%")
                             ->orWhere('manufacture_year','LIKE',"%{$searchquery}%")
                             ->orWhere('location','LIKE',"%{$searchquery}%")
                             ->orWhere('transmission','LIKE',"%{$searchquery}%")
                             ->orWhere('fuel_type','LIKE',"%{$searchquery}%")
                             ->orWhere('interior_color','LIKE',"%{$searchquery}%")
                             ->orWhere('exterior_color','LIKE',"%{$searchquery}%")
                             ->orWhere('vehicle_reg','LIKE',"%{$searchquery}%")
                             ->orWhere('price','LIKE',"%{$searchquery}%")
                             ->orWhere('vehicle_name','LIKE',"%{$searchquery}%")
                             ->orWhere('sacco_name','LIKE',"%{$searchquery}%")
                             ->orWhere('route','LIKE',"%{$searchquery}%")
                             ->orWhere('votes','LIKE',"%{$searchquery}%");
                         })
                         ->get();
 
             return response()->json([
                 'cars' =>  $Cars,
                 'loggedin' => false,
             ]);
 
         }
 
 
     }


    public function getCartoPublish(Car $car)
    {
        
        $account_number = $this->generateAccountNumber();
        $amountpayable = MpesaAmount::all()[0]['amount'];
        return view('/checkout')->with(['payingfor' => 'car','carid' => $car['id'],'account_number' => $account_number, 'amountpayable' => $amountpayable]);

    }


    //ADMIN 
    public function getCars()
    {

        $cars = Car::where('carfor','=','Car of the year award')                              ->orderBy('votes', 'DESC')
                     ->orderBy('votes', 'DESC')
                     ->get();
        return view('/admin.cars')->with(['cars' => $cars]);


    }

    //ADMIN 
    public function adminAuctionCars()
    {

        $Auctioncars = Car::where('carfor','=','Car for Auction')                              ->orderBy('votes', 'DESC')
                            ->orderBy('votes', 'DESC')
                            ->get();
        return view('/admin.cars-for-auction')->with(['Auctioncars' => $Auctioncars]);

    }
  
    

    //ADMIN 
    public function getPSVs()
    {

        $psvs = Car::where('carfor','=','PSV of the year award')                              ->orderBy('votes', 'DESC')
                        ->orderBy('votes', 'DESC')
                        ->get();
        return view('/admin.psv')->with(['PSVs' => $psvs]);


    }


    public function getAdminCarDetails(Car $car)
    {

        $carImages = Image::where('car_id','=',$car->id)->get();
        return view('admin.car-details')->with(['car' => $car,'carImages' => $carImages ]);
        
    }

    public function getAdminCarAuctionDetails(Car $car)
    {

        $carImages = Image::where('car_id','=',$car->id)->get();
        return view('admin.auction-car-details')->with(['car' => $car,'carImages' => $carImages ]);

    }


    public function getAdminPSVDetails(Car $car)
    {

        $carImages = Image::where('car_id','=',$car->id)->get();
        return view('admin.psv-details')->with(['car' => $car,'carImages' => $carImages ]);
        
    }

    public function deleteCar(Car $car)
    {

        Image::where('car_id','=',$car['id'])->delete();
        CarsVote::where('car_id','=',$car['id'])->delete();
        $car->delete();
        session()->flash('success','Car deleted successfully');
        return redirect()->back();
        
    }

    public function publishCar(Car $car)
    {

        $car->update(['published' => 'YES']);
        session()->flash('success','Car published successfully');
        return redirect()->back();
        
    }

    public function publishPSV(Car $car)
    {

        $car->update(['published' => 'YES']);
        session()->flash('success','PSV published successfully');
        return redirect()->back();
        
    }
    public function publishAuctionCar(Car $car)
    {

        $car->update(['published' => 'YES']);
        session()->flash('success','Car published successfully');
        return redirect()->back();
        
    }

    public function unpublishCar(Car $car)
    {

        $car->update(['published' => 'NO']);
        session()->flash('success','Car unpublished successfully');
        return redirect()->back();
        
    }

    public function unpublishPSV(Car $car)
    {

        $car->update(['published' => 'NO']);
        session()->flash('success','PSV unpublished successfully');
        return redirect()->back();
        
    }
    public function unpublishAuctionCar(Car $car)
    {

        $car->update(['published' => 'NO']);
        session()->flash('success','Car unpublished successfully');
        return redirect()->back();
        
    }


    public function deletePSV(Car $car)
    {

        Image::where('car_id','=',$car['id'])->delete();
        CarsVote::where('car_id','=',$car['id'])->delete();
        $car->delete();
        session()->flash('success','PSV deleted successfully');
        return redirect()->back();
        
    }

    public function deleteAuctionCar(Car $car)
    {

        Image::where('car_id','=',$car['id'])->delete();
        CarsVote::where('car_id','=',$car['id'])->delete();
        $car->delete();
        session()->flash('success','Car deleted successfully');
        return redirect()->back();
        
    }



    //filter auction cars
    public function filterAuctionCars(Request $request)
    {

        if(Auth::check())
        {
            $user_id = auth()->user()->id;
            $reservedCars = CarReservation::all();
            $reservedCarsIDs = array();
            
            foreach($reservedCars as $reservedCar)
            {
                array_push($reservedCarsIDs,$reservedCar['car_id']);
    
            }
    
            
            //filter by category
            if($request->label == 'category')
            {
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'category' => $request->category,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category and make
            else if($request->label == 'category_make')
            {
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'published' => 'YES'])
                              ->orderBy('votes', 'DESC')
                              ->get();

            }
            //filter by category, make and model
            else if($request->label == 'all')
            {
                
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make')
            {
                
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'make' => $request->make,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make_model')
            {
                
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            return  response()->json([
                'cars' => $Cars,
                'reservedCarsIDs' => $reservedCarsIDs,
                'loggedin' => true
            ]);
        }
        else{

            //filter by category
            if($request->label == 'category')
            {
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'category' => $request->category,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
             //filter by category and make
            else if($request->label == 'category_make')
            {
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'published' => 'YES'])
                              ->orderBy('votes', 'DESC')
                              ->get();

            }
            //filter by category, make and model
            else if($request->label == 'all')
            {
                
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'category' => $request->category,
                                    'make' => $request->make,
                                    'model' => $request->model,
                                    'published' => 'YES'])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
            //filter by category, make and model
            else if($request->label == 'make')
            {
                
                $Cars = Car::where(['carfor' => 'Car for Auction',
                                    'make' => $request->make,
                                    'published' => 'YES'
                                    ])
                             ->orderBy('votes', 'DESC')
                             ->get();
            }
             //filter by category, make and model
             else if($request->label == 'make_model')
             {
                 
                 $Cars = Car::where(['carfor' => 'Car for Auction',
                                     'make' => $request->make,
                                     'model' => $request->model,
                                     'published' => 'YES'
                                     ])
                              ->orderBy('votes', 'DESC')
                              ->get();
             }
            return response()->json([
                'cars' => $Cars,
                'loggedin' => false,
            ]);

        }


    }



    public function getVotesSummation()
    {
      
        $carsSum = Car::where('carfor','=','Car of the year award')->sum('votes');
        $psvsSum = Car::where('carfor','=','PSV of the year award')->sum('votes');
        $dealersSum = Dealer::sum('votes');
        return view('/index')->with(['carsSum' => $carsSum, 'psvsSum' => $psvsSum, 'dealersSum' => $dealersSum]);


    }

  
    //front end user - auction car
    public function unpublishMyAuctionCar(Car $car)
    {
      
        $car->update(['published' => 'NO']);
        session()->flash('success','Car unpublished successfully');
        return redirect()->back();

    }


    public function deleteMyAuctionCar(Car $car)
    {
        
        Image::where('car_id','=',$car['id'])->delete();
        CarReservation::where('car_id','=',$car['id'])->delete();
        $car->delete();
        session()->flash('success','Car deleted successfully');
        return redirect()->back();

    }



        //front end user - PSV 
        public function unpublishMyPSV(Car $car)
        {
          
            $car->update(['published' => 'NO']);
            session()->flash('success','PSV unpublished successfully');
            return redirect()->back();
    
        }
    
    
        public function deleteMyPSV(Car $car)
        {
            
            Image::where('car_id','=',$car['id'])->delete();
            CarsVote::where('car_id','=',$car['id'])->delete();
            $car->delete();
            session()->flash('success','PSV deleted successfully');
            return redirect()->back();
    
        }


        //front end user - Car 
        public function unpublishMyCar(Car $car)
        {
          
            $car->update(['published' => 'NO']);
            session()->flash('success','Car unpublished successfully');
            return redirect()->back();
    
        }
    
    
        public function deleteMyCar(Car $car)
        {
            
            Image::where('car_id','=',$car['id'])->delete();
            CarsVote::where('car_id','=',$car['id'])->delete();
            $car->delete();
            session()->flash('success','Car deleted successfully');
            return redirect()->back();
    
        }
    
    
}

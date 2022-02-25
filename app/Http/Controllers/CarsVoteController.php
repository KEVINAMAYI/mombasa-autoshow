<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarsVote;
use Illuminate\Http\Request;



class CarsVoteController extends Controller
{
     //upload user's vote for a car
     public function voteForCarOnPublic(Car $car)
     {
        
         $car_id = $car->id;
         $user_id = auth()->user()->id;
 
         CarsVote::create([
             'user_id' => $user_id,
             'car_id' => $car_id
         ]);

         $newcarvotes = (Car::where('id', $car_id )->get()[0]['votes'])+1;
         Car::where('id', $car_id )->update(['votes' => $newcarvotes]);
 
         return redirect('/car-awards');
 
     }

     //upload user's vote for a car
     public function voteForCarOnPrivate(Car $car)
     {
        
         $car_id = $car->id;
         $user_id = auth()->user()->id;
 
         CarsVote::create([
             'user_id' => $user_id,
             'car_id' => $car_id
         ]);

         $newcarvotes = (Car::where('id', $car_id )->get()[0]['votes'])+1;
         Car::where('id', $car_id )->update(['votes' => $newcarvotes]);
 
         return redirect('/mycars');
 
     }  


     //upload user's vote for a car
     public function voteForCarOnDisplay(Car $car)
     {
        
         $car_id = $car->id;
         $user_id = auth()->user()->id;
 
         CarsVote::create([
             'user_id' => $user_id,
             'car_id' => $car_id
         ]);

         $newcarvotes = (Car::where('id', $car_id )->get()[0]['votes'])+1;
         Car::where('id', $car_id )->update(['votes' => $newcarvotes]);
 
         return redirect("/car-details/{$car_id}");
 
     }

     //upload user's vote for a car
     public function voteForPSVOnPublic(Car $car)
     {
        
         $car_id = $car->id;
         $user_id = auth()->user()->id;
 
         CarsVote::create([
             'user_id' => $user_id,
             'car_id' => $car_id
         ]);

         $newcarvotes = (Car::where('id', $car_id )->get()[0]['votes'])+1;
         Car::where('id', $car_id )->update(['votes' => $newcarvotes]);
 
         return redirect('/psv-awards');
 
     }

     //upload user's vote for a car
     public function voteForPSVOnPrivate(Car $car)
     {
        
         $car_id = $car->id;
         $user_id = auth()->user()->id;
 
         CarsVote::create([
             'user_id' => $user_id,
             'car_id' => $car_id
         ]);

         $newcarvotes = (Car::where('id', $car_id )->get()[0]['votes'])+1;
         Car::where('id', $car_id )->update(['votes' => $newcarvotes]);
 
         return redirect('/mypsvs');
 
     } 

     //upload user's vote for a car
     public function voteForPSVOnDisplay(Car $car)
     {
        
         $car_id = $car->id;
         $user_id = auth()->user()->id;
 
         CarsVote::create([
             'user_id' => $user_id,
             'car_id' => $car_id
         ]);

         $newcarvotes = (Car::where('id', $car_id )->get()[0]['votes'])+1;
         Car::where('id', $car_id )->update(['votes' => $newcarvotes]);
 
         return redirect("/psv-details/{$car_id}");
 
     }

}

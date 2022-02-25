<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\CarReservation;


class CarReservationController extends Controller
{
    public function reserveCar(Car $car)
    {

        $car_id = $car->id;
        $user_id = auth()->user()->id;

        CarReservation::create([
            'user_id' => $user_id,
            'car_id' => $car_id
        ]);

        return redirect('/auction');
        
    }

    public function privatereserveCar(Car $car)
    {

        $car_id = $car->id;
        $user_id = auth()->user()->id;

        CarReservation::create([
            'user_id' => $user_id,
            'car_id' => $car_id
        ]);

        return redirect('/auction-cars');
        
    }
}

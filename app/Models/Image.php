<?php

namespace App\Models;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;


    protected $fillable = [
        'car_id',
        'image_url'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}

<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'carfor',
        'make',
        'category',
        'model',
        'manufacture_year',
        'location',
        'engine_cc',
        'transmission',
        'fuel_type',
        'interior_color',
        'exterior_color',
        'vehicle_reg',
        'price',
        'vehicle_name',
        'sacco_name',
        'route',
        'description',
        'votes',
        'published'

    ];

 
    public function images()
    {
        return $this->hasMany(Image::class);
    }

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

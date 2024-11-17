<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vehicle_model()
    {
        return $this->belongsTo(VehicleModel::class);
    }

    public function make()
    {
        return $this->belongsTo(Make::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'vehicle_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'vehicle_id');
    }
}

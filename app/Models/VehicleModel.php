<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function make(){
        return $this->belongsTo(Make::class);
    }

}

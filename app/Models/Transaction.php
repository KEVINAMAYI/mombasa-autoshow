<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected  $guarded = ['id'];

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function mpesaTransaction()
    {
        return $this->hasOne(MpesaTransaction::class, 'account_number', 'account_number');
    }
}

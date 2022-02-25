<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'first_name',
        'middle_name',
        'last_name',
        'account_number',
        'amount_paid',
        'phone_number',
        'transaction_time',
    ];

}

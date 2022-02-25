<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dealer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'delearname',
        'location',
        'email',
        'phonenumber',
        'description',
        'logo_url',
        'votes',
        'published'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'user_id', 
        'address_line_1', 
        'address_line_2', 
        'city', 
        'state', 
        'postal_code'
    ];

    // If you have a relationship to the user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

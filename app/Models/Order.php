<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'shipping_status', 'tracking_number'];

    // Relationship with Product
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Dummy tracking number generation
    public static function generateDummyTrackingNumber() {
        $prefix = strtoupper(substr(md5(uniqid()), 0, 3)); // 3 random letters
        $number = mt_rand(1000000000, 9999999999); // 10 random digits
        return $prefix . $number; // Combine prefix and number
    }
}

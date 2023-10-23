<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    protected $table = 'shopping_cart';

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Relationship To Product Variant
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

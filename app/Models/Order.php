<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';
    protected $fillable = ['user_id', 'product_id', 'group_id', 'recipient','product_name', 'price', 'quantity', 'variant', 'iamges', 'totalPrice', 'status'];

    // Relationship To User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship To Listing
    public function listing() {
        return $this->belongsTo(Listing::class, 'product_id');
    }
}

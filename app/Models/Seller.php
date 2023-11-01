<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    protected $table = 'seller';


    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    // Relationship With Listings
    public function listings() {
        return $this->hasMany(Listing::class, 'seller_id');
    }

}

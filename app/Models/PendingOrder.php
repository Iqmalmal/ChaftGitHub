<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendingOrder extends Model
{
    use HasFactory;

    protected $table = 'pending_order';

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

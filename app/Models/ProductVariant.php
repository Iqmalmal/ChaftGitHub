<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $table = 'product_variant';

    protected $casts = [
        'images' => 'array',
    ];

    // Relationship To Listing
    public function listing() {
        return $this->belongsTo(Listing::class, 'product_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = ['product_name', 'location', 'seller', 'description', 'tags'];

    public function scopeFilter($query, array $filters) {
        if($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        if($filters['search'] ?? false) {
            $query->where('product_name', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To Seller
    public function seller() {
        return $this->belongsTo(Seller::class, 'seller_id');
    }


    // Relationship To Product Variant
    public function productVariants(){
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    // Relationship With PendingOrder
    public function pendingOrder() {
        return $this->hasMany(PendingOrder::class, 'product_id');
    }

    protected $casts = [
        'images' => 'array',
    ];

    

}

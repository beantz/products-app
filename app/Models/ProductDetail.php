<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    protected $table = 'products_details';

    protected $fillable = ['product_id', 'ingredients', 'date_manuf', 'date_val'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
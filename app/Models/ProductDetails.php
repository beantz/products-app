<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    protected $fillable = ['product_id', 'ingredients', 'date_manuf', 'date_val', ''];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'category'];

    public function details() {
        return $this->hasOne(ProductDetail::class);
    }

    public function review() {
        return $this->hasMany(Review::class);
    }
}
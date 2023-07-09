<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    function relationshipwithproduct(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    function relationshipwithcolor(){
        return $this->hasOne(Color::class, 'id', 'color_id');
    }
    function relationshipwithsize(){
        return $this->hasOne(Size::class, 'id', 'size_id');
    }
    function relationshipwithuser(){
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
}

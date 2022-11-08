<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

   public function products()
   {    // ! old relationship - now is a polimorphic
        // return $this->belongsToMany(Product::class)->withPivot('quantity'); // withPivot retrieves this column

        return $this->morphToMany(Product::class, 'productable')->withPivot('quantity'); // withPivot retrieves this column
   }

   public function getTotalAttribute()
   {
        // * this total is not in db is from the other total in product model - watch 72 v
       return $this->products->pluck('total')->sum();
   }

}

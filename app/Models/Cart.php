<?php

namespace App\Models;

use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

   public function products()
   {
        return $this->belongsToMany(Product::class)->withPivot('quantity'); // withPivot retrieves this column
   }

}

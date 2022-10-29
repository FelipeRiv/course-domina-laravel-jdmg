<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Pueden ser asignados de forma masiva con el metodo request()->all(); en los controllers
    protected $fillable = [
        'title',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function carts()
    {
        // return $this->belongsToMany(Cart::class)->withPivot('quantity'); // ! old relationship - now is a polimorphic
        return $this->morphedByMany(Cart::class, 'productable')->withPivot('quantity');
    }
 

    public function orders()
    {
        // return $this->belongsToMany(Order::class)->withPivot('quantity');// ! old relationship - now is a polimorphic
        return $this->morphedByMany(Order::class, 'productable')->withPivot('quantity');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
 
}

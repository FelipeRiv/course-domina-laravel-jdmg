<?php

namespace App\Models;

use App\Models\Cart;
use App\Models\Order;

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
        return $this->belongsToMany(Cart::class)->withPivot('quantity');
    }
 

    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('quantity');
    }
 
}

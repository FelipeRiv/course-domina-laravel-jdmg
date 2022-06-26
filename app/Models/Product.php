<?php

namespace App\Models;

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
}

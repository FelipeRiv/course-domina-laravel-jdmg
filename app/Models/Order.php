<?php

namespace App\Models;

// use App\Payment;
use App\Models\Payment;
use App\Models\User;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'customer_id',
    ];

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function user()
    {
        // * laravel sets the foreign key automatically based on the table name but if we set another name we will have to set the name here
        return $this->belongsTo(User::class, 'customer_id'); 
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
 


}

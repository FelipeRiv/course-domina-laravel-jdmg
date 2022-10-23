<?php

namespace App\Models;

// use App\Order;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'payed_at',
        'order_id',
    ];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['payed_at']; // create an instance of Carbon 

    // We want to know things like how long ago did the client pay and thins like that with payed_at field therefore we are going to use the library called Carbon we can do operations with dates and time, compare, difference, modify, wich is greater or less than...,  serilize, convert to diffent time zones and make it easy to read like 1 hour ago etc 

    // But Laravel does not create instances of Carbon in everything, by the moment just the timestamps in our models 

    // We can use the attribute Date to make instances of Carbon with a field that we know is a date

    // In the model definition of Laravel Model.php  there is a trait called HasAttributes.php there is a block of code that is an array called dates to convert those field into dates and an instance of Carbon 

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

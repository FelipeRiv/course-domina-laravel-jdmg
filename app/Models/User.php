<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        // 'admin_since' // ! this attr says if the user is an admin is a dagerous field to return and assign as a fillable attr bc someone may change it, for security issues will be disable here, we will assing it explicitly later only when we want to!
    ];

    // * admin_since is not a good idea to use it in  fillable bc of security issues  

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // * Differece betwwen casts and dates bc email_verified_at its also a date so... email verfied is casted to a datetime a native type of php is not a object from Carbon and we can not use it to make operations as we will can do it with Carbon objects  

    
    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['admin_since']; // create an instance of Carbon 
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 *@property integer $id
 *@property string  $full_name
 *@property string  $email
 *@property string  $phone
 *@property string  $password
 *@property string  $reset_password
 *@property string  $status
 */
class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'customers';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [
        'full_name',
        'email',
        'password',
        'phone',
        'address',
        'reset_password',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array

     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array

     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  

   
}

    

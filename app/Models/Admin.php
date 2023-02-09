<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *@property integer $id
 *@property string  $user_name
 *@property string  $email
 *@property date    $birthday
 *@property string  $first_name
 *@property string  $last_name
 *@property string  $password
 *@property string  $reset_password
 *@property string  $status
 *@property integer $flag_delete
 */

class Admin extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $guard = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = 'admin';



    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name', 'first_name', 'last_name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

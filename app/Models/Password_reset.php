<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Password_reset extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = 'password_resets';
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = ['id', 'token', 'email', 'created_at'];
}

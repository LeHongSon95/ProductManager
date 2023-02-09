<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *@property integer $id
 *@property string  $name
 */
class Province extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = 'province';

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = ['id', 'name'];
}

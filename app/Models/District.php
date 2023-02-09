<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 *@property integer $id
 *@property string  $name
 *@property integer  $province_id
 */
class District extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = 'district';
    
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
    protected $fillable = ['id', 'name', 'province_id'];
}

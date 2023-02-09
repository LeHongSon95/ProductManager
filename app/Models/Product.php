<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 *@property integer $id
 *@property string  $name
 *@property integer  $sku
 *@property integer  $stock
 *@property string   $avatar
 *@property integer  $category_id
 *@property string  $expired_at
 *@property string  $created_at
 */
class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = 'products';

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
    protected $fillable = ['name', 'sku', 'stock','price', 'avatar', 'expired_at', 'category_id', 'flag_delete', 'created_at'];

    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>

     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function product_catelory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}

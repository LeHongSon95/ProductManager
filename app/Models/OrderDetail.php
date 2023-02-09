<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *@property integer $id
 *@property integer  $product_id
 *@property integer  $order_id
 *@property integer  $quantity
 *@property integer  $price
 *@property string  $status
 *@property date  $created_at
 *@property date  $updated_at
 */

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_detail';
    protected $fillable = ['id', 'product_id', 'order_id', 'quantity', 'price', 'status', 'created_at', 'updated_at'];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>

     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

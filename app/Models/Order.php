<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *@property integer $id
 *@property integer  $customer_id
 *@property integer  $quantity
 *@property integer  $total
 *@property date  $created_at
 */

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = ['id', 'customer_id', 'quantity', 'total', 'created_at'];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>

     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>

     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_detail()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>

     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

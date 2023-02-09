<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *@property integer $id
 *@property string  $name
 *@property integer  $parent_id
 *@property string  $created_at
 */

class Category extends Model
{
    
    use HasFactory;

       /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $table = 'product_catelogy';
    
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
    protected $fillable = ['name', 'parent_id', 'created_at'];
    

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>

     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function parent() {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}

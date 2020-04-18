<?php

namespace Master\Orders\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model 
{
	use SoftDeletes;
	protected $table = 'orders';
	protected $fillable = [
	'customer_id',
    'product_id',
    'unique_code',
    'transfer_confirmation',
    'download_link',
    'invoice',
    'total',
    'timeout',
    'status',
	];


    public function product()
    {
        return $this->belongsTo(\Master\Products\Models\Products::class, 'product_id', 'id');
    }


    public function customer()
    {
        return $this->belongsTo(\Master\Customers\Models\Customers::class, 'customer_id', 'id');
    }
}

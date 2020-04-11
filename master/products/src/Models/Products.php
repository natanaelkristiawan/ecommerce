<?php

namespace Master\Products\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model 
{
	use SoftDeletes;
	protected $table = 'products';
	protected $fillable = [
    'name',
    'slug',
    'price_idr',
    'price_dollar',
    'detail',
    'file',
    'status'
	];

  protected $casts = array(
    'file' => 'array'
  );
}

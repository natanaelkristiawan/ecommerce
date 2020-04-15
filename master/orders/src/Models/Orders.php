<?php

namespace Master\Orders\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model 
{
	use SoftDeletes;
	protected $table = 'orders';
	protected $fillable = [
		'name',
		'slug',
		'status',
	];
}

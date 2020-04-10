<?php

namespace Master\Settings\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model 
{
	use SoftDeletes;
	protected $table = 'settings';
	protected $fillable = [
		'name',
		'slug',
		'status',
	];
}

<?php

namespace Master\Videos\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Videos extends Model 
{
	use SoftDeletes;
	protected $table = 'videos';
	protected $fillable = [
		'name',
		'youtube',
    'position',
		'status',
	];
}

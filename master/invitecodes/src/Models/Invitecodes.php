<?php

namespace Master\Invitecodes\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitecodes extends Model 
{
	use SoftDeletes;
	protected $table = 'invite_codes';
	protected $fillable = [
		'code',
		'customer_id',
		'status',
	];


  public function customer()
  {
    return $this->belongsTo(\Master\Customers\Models\Customers::class, 'customer_id', 'id');
  }
}

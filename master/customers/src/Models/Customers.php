<?php

namespace Master\Customers\Models;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Customers extends Authenticatable 
{
	use SoftDeletes, Notifiable;
	protected $table = 'customers';
	protected $fillable = [
    'name',
    'email',
    'password',
    'phone',
    'photo',
    'invite_code',
    'status',
    'public_key',
    'private_key',
    'api_token',
	];
}

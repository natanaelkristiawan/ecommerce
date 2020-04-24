<?php

namespace Master\Core\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reports extends Model 
{
  use SoftDeletes;
  protected $table = 'reports';
  protected $fillable = [
    'id',
    'customer_id',
    'report',
  ];
}

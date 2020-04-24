<?php

namespace Master\Core\Facades;

use Illuminate\Support\Facades\Facade;

class Reports extends Facade
{

  protected static function getFacadeAccessor()
  {
    return 'master.reports';
  }
}

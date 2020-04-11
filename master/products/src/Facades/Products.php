<?php

namespace Master\Products\Facades;

use Illuminate\Support\Facades\Facade;

class Products extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'master.products';
	}
}

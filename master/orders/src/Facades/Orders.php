<?php

namespace Master\Orders\Facades;

use Illuminate\Support\Facades\Facade;

class Orders extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.orders';
	}
}

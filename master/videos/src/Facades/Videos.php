<?php

namespace Master\Videos\Facades;

use Illuminate\Support\Facades\Facade;

class Videos extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.videos';
	}
}

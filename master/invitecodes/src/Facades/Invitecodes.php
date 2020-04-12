<?php

namespace Master\Invitecodes\Facades;

use Illuminate\Support\Facades\Facade;

class Invitecodes extends Facade
{

	protected static function getFacadeAccessor()
	{
		return 'master.invitecodes';
	}
}

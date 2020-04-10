<?php

namespace Master\Settings\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class SettingsCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model;
	}
}
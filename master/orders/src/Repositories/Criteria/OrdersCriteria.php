<?php

namespace Master\Orders\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class OrdersCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model;
	}
}
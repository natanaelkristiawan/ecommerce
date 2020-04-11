<?php

namespace Master\Products\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class ProductsCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
    $model = $model->where('status', 1);
		return $model;
    
	}
}
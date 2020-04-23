<?php

namespace Master\Videos\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class VideosCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
    $model = $model->where('status', 1)->orderBy('position', 'ASC');

		return $model;
	}
}
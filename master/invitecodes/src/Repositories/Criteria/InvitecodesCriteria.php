<?php

namespace Master\Invitecodes\Repositories\Criteria;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class InvitecodesCriteria implements CriteriaInterface {

	public function apply($model, RepositoryInterface $repository)
	{
		return $model;
	}
}
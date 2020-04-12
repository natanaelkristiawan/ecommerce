<?php

namespace Master\Invitecodes\Repositories\Eloquent;

use Master\Invitecodes\Interfaces\InvitecodesRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class InvitecodesRepository extends BaseRepository implements InvitecodesRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'code'      => 'like',
		'status'    => '='
	];

	public function model()
	{
		return \Master\Invitecodes\Models\Invitecodes::class;
	}

	public function newInstance(array $attributes)
	{
		$model = $this->model->newInstance($attributes);
		$this->resetModel();
		return $this->parserResult($model);
	}

	public function setPageLimit($pageLimit)
	{
		$this->pageLimit = $pageLimit;
		return  $this;
	}


	public function getDataTable()
	{        
		$data = $this->paginate($this->pageLimit);
		$data['recordsTotal'] = $data['meta']['pagination']['total'];
		$data['recordsFiltered'] = $data['meta']['pagination']['total'];
		$data['request'] = request()->all();
		return $data;
	}

}

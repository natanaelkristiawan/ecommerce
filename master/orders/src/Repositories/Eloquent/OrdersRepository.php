<?php

namespace Master\Orders\Repositories\Eloquent;

use Master\Orders\Interfaces\OrdersRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class OrdersRepository extends BaseRepository implements OrdersRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'name'      => 'like',
		'status'    => '='
	];

	public function model()
	{
		return \Master\Orders\Models\Orders::class;
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

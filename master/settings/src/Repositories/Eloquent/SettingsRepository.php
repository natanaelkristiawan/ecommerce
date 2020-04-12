<?php

namespace Master\Settings\Repositories\Eloquent;

use Master\Settings\Interfaces\SettingsRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class SettingsRepository extends BaseRepository implements SettingsRepositoryInterface
{
	private $pageLimit;

	protected $fieldSearchable = [
		'name'      => 'like',
		'status'    => '='
	];

	public function model()
	{
		return \Master\Settings\Models\Settings::class;
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


	public function insertData($name, $slug, $data, $default = '')
	{
		$dataInsert = array(
			'name'=> $name,
			'slug'=> $slug,
			'default'=> $default,
			'value'=> $data,
			'status'=> 1
		);
		$this->model->updateOrCreate(array('slug'=>$slug), $dataInsert);
		$this->resetModel();

		return true;
	}

}

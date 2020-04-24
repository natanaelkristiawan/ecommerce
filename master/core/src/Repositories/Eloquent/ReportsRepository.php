<?php

namespace Master\Core\Repositories\Eloquent;

use Master\Core\Interfaces\ReportsRepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository;

class ReportsRepository extends BaseRepository implements ReportsRepositoryInterface
{
  private $pageLimit;

  protected $fieldSearchable = [
    'title'      => 'like',
    'status'    => '='
  ];

  public function model()
  {
    return \Master\Core\Models\Reports::class;
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

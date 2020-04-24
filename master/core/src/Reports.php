<?php
namespace Master\Core;
use Master\Core\Interfaces\ReportsRepositoryInterface;

class Reports
{
  protected $repository;

  public function __construct(ReportsRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }


  public function create($params = array())
  {
    return $this->repository->create($params);
  }
}
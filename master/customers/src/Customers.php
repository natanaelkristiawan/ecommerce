<?php
namespace Master\Customers;

use Master\Customers\Interfaces\CustomersRepositoryInterface;

class Customers
{
  protected $repository;

  public function __construct(CustomersRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function create($params = array())
  {
    return $this->repository->create($params);
  }


  public function countAll()
  {
    return $this->repository->all()->count();
  }

  public function countThisMonth()
  {
    return $this->repository->findWhereBetween('created_at', array(date('Y-m-01').' 00:00:01', date('Y-m-t').' 23:59:59'))->count();
  }


  public function countbeforeMonth()
  {

    $dateStart = date('Y-m-01', strtotime(date('Y-m-01'). ' -1 month')).' 00:00:01';
    $dateEnd = date('Y-m-t', strtotime(date('Y-m-t'). ' -1 month')).' 23:59:59';

    return $this->repository->findWhereBetween('created_at', array($dateStart, $dateEnd))->count();
  }
}
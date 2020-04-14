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
}
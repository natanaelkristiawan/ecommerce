<?php
namespace Master\Products;

use Master\Products\Interfaces\ProductsRepositoryInterface;

class Products
{
  protected $repository;

  public function __construct(ProductsRepositoryInterface $product)
  {
    $this->repository = $product;
    $this->repository->pushCriteria(\Master\Products\Repositories\Criteria\ProductsCriteria::class);
  }

  public function all()
  {
    return $this->repository->all();
  }


  public function findWhere($params = array())
  {
    return $this->repository->findWhere($params);
  }

  public function findWhereNotIn($field, $exclude = array())
  {
    return $this->repository->findWhereNotIn($field, $exclude);
  }

  public function findWhereIn($field, $include = array())
  {
    return $this->repository->findWhereIn($field, $include);
  }

  public function findByOrder($field, $data = array())
  {
    $response = array();

    foreach ($data as $key => $value) {
      $query = $this->repository->findByField($field, $value)->first();

      if (is_null($query)) {
        continue;
      }
      $response[] = $query; 
    }

    return $response;
  }
}
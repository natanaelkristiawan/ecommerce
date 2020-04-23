<?php
namespace Master\Videos;
use Master\Videos\Interfaces\VideosRepositoryInterface;

class Videos
{
  protected $repository;

  public function __construct(VideosRepositoryInterface $repository)
  {
    $this->repository = $repository;
    $this->repository->pushCriteria(\Master\Videos\Repositories\Criteria\VideosCriteria::class);
  }
  
  public function all()
  {
    return $this->repository->all();
  }
}
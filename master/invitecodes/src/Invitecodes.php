<?php
namespace Master\Invitecodes;

use Master\Invitecodes\Interfaces\InvitecodesRepositoryInterface;

class Invitecodes
{


  protected $repository;

  public function __construct(InvitecodesRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }

  public function findCode($code='')
  {
    return $this->repository->findWhere(array('code'=>$code, 'status' => 0))->first();
  }

  public function setUsed($customer_id = '', $code_id = '')
  {
    return $this->repository->update(array('status'=>1, 'customer_id' => $customer_id), $code_id);
  }

}
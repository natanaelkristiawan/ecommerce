<?php
namespace Master\Settings;

use Master\Settings\Interfaces\SettingsRepositoryInterface;
class Settings
{

  protected $repository;

  public function __construct(SettingsRepositoryInterface $setting)
  {
    $this->repository = $setting;
  }

  public function find($slug = '')
  {
    $data = $this->repository->findWhere(array('slug'=>$slug))->first();
    
    if (is_null($data)) {
      return '';
    }

    $result = empty($data->value) ? $data->default : $data->value;

    return $result; 
  }

  public function all()
  {
    return $this->repository->all();
  }


  public function updateCreate($slug='', $value='')
  {
    
  }

}
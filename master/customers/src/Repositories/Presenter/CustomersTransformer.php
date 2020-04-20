<?php

namespace Master\Customers\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class CustomersTransformer extends TransformerAbstract
{
	public function transform(\Master\Customers\Models\Customers $model)
	{
		return [
			'id'   => $model->id,
      'created_at' => date('Y-m-d', strtotime($model->created_at)),
      'name' => $model->name,
      'email' => $model->email,
      'phone' => $model->phone,
      'invite_code' => $model->invite_code,
      'status' => '<span class="badge badge-'.config('color.status.'.$model->status).'">'.($model->status == 0 ? 'Draft' : 'Live').'</span>',
      'action' => '
        <div class="btn-group">
          <a href="'.route('admin.customers.profile', array('id'=>$model->id)).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-pencil-alt"></i></a>
          <a href="'.route('admin.customers.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
        </div>
      ',
		];
	}
}

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
      'status' => $model->status == 0 ? 'Draft' : 'Live',
      'action' => '
        <div class="btn-group">
          <a href="" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-pencil-alt"></i></a>
        </div>
      ',
		];
	}
}

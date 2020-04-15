<?php

namespace Master\Orders\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class OrdersTransformer extends TransformerAbstract
{
	public function transform(\Master\Orders\Models\Orders $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}

<?php

namespace Master\Invitecodes\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class InvitecodesTransformer extends TransformerAbstract
{
	public function transform(\Master\Invitecodes\Models\Invitecodes $model)
	{
		return [
			'id'   => $model->id,
			'code' => $model->code,
      'customer' => is_null($model->customer) ? null : $model->customer->name,
			'status'=> $model->status == 0 ? 'Draft' : 'Live',
			'action'=> ''
		];
	}
}

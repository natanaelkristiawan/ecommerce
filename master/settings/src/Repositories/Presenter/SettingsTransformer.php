<?php

namespace Master\Settings\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class SettingsTransformer extends TransformerAbstract
{
	public function transform(\Master\Settings\Models\Settings $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
			'status'=> '',
			'action'=> ''
		];
	}
}

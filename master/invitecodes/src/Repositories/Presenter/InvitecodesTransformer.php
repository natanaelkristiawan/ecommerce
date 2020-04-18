<?php

namespace Master\Invitecodes\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class InvitecodesTransformer extends TransformerAbstract
{
	public function transform(\Master\Invitecodes\Models\Invitecodes $model)
	{
		$action = '';

		if ($model->status == 0) {
			$action = '<div class="btn-group">
                  <a href="'.route('admin.invitecodes.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                 </div>';
		}


		return [
			'id'   => $model->id,
			'code' => $model->code,
      'customer' => is_null($model->customer) ? null : $model->customer->name,
			'status'=> '<span class="badge badge-'.config('color.status.'.$model->status).'">'.($model->status == 0 ? 'Draft' : 'Live').'</span>',
			'action'=> $action
		];
	}
}

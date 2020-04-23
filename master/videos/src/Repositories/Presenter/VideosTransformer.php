<?php

namespace Master\Videos\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class VideosTransformer extends TransformerAbstract
{
	public function transform(\Master\Videos\Models\Videos $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
      'youtube' => $model->youtube,
      'position' => $model->position,
			'status'=> '<span class="badge badge-'.config('color.status.'.$model->status).'">'.($model->status == 0 ? 'Draft' : 'Live').'</span>',
			'action'=> '
        <div class="btn-group">
          <a href="'.route('admin.videos.edit', array('id'=>$model->id)).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-pencil-alt"></i></a>
          <a href="'.route('admin.videos.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
        </div>
      '
		];
	}
}

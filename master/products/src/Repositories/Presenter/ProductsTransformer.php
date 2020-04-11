<?php

namespace Master\Products\Repositories\Presenter;

use League\Fractal\TransformerAbstract;

class ProductsTransformer extends TransformerAbstract
{
	public function transform(\Master\Products\Models\Products $model)
	{
		return [
			'id'   => $model->id,
			'name' => $model->name,
      'price_idr' => $model->price_idr,
      'price_dollar' => $model->price_dollar,
      'detail' => $model->detail,
			'status'=>  $model->status == 0 ? 'Draft' : 'Live',
			'action'=> '<div class="btn-group">
                  <a href="'.route('admin.products.edit', ['id'=>$model->id]).'" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-pencil-alt"></i></a>
                  <a href="'.route('admin.products.delete', ['id'=>$model->id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$model->id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
		];
	}
}

<?php

namespace Master\Products\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class ProductsPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new ProductsTransformer();
	}
}
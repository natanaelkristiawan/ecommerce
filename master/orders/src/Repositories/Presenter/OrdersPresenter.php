<?php

namespace Master\Orders\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class OrdersPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new OrdersTransformer();
	}
}
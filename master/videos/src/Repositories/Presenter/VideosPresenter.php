<?php

namespace Master\Videos\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class VideosPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new VideosTransformer();
	}
}
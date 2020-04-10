<?php

namespace Master\Settings\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class SettingsPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new SettingsTransformer();
	}
}
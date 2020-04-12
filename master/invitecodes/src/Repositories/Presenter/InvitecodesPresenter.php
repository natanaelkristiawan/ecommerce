<?php

namespace Master\Invitecodes\Repositories\Presenter;

use Prettus\Repository\Presenter\FractalPresenter;

class InvitecodesPresenter extends FractalPresenter {
	public function getTransformer()
	{
		return new InvitecodesTransformer();
	}
}
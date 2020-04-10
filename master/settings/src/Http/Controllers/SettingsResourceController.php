<?php

namespace Master\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Settings\Interfaces\SettingsRepositoryInterface;
use Master\Settings\Models\Settings;
use Validator;
use Meta;
class SettingsResourceController extends Controller
{
	protected $repository;

	public function __construct(SettingsRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		Meta::title('Settings');
	}

	public function index(Request $request)
	{
		return view('settings::admin.settings.index');	
	}

	public function store(Request $request)
	{
		// logo
		$logo = is_null($request->logo) ? array() : array_values($request->logo);
		// insert logo
		$this->repository->insertData('logo', 'logo', $logo, array());


		// background
		$background = is_null($request->background) ? array() : array_values($request->background);
		$this->repository->insertData('background', 'background', $background, array());



		return redirect()->back();
		
	}

	
}
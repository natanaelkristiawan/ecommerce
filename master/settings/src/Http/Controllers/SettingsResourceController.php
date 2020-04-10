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

		dd($request->all());

		$dataSection1 = array(

		);
		
	}


	private function section1($data){

	}

	private function section2($data){
		
	}

	private function section3($data){
		
	}
}
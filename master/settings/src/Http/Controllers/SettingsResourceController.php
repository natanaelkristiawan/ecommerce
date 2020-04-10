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

	public function create(Request $request)
	{

	}

	public function store(Request $request)
	{
	 
	}

	public function edit(Request $request, Settings $data)
	{
	  
	}

	public function update(Request $request, Settings $data)
	{
	  
	}

	public function delete(Request $request, Settings $data)
	{

	}

}
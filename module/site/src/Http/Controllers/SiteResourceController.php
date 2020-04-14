<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Models\Site;
use Validator;
use Settings;
use Products;
use Meta;
use Auth;
use Invitecodes;
use Customers;

class SiteResourceController extends Controller
{
	protected $repository;


	public function __construct()
	{
		$this->middleware('guest:web')->except(array('logout', 'index'));
	}

	public function index(Request $request)
	{

		$dataColor = array(
			'#ffbb2c',
			'#5578ff',
			'#e80368',
			'#47aeff',
			'#11dbcf',
			'#4233ff',
			'#b2904f',
			'#b20969',
		);


		$dataIcon = array(
			'ri-store-line',
			'ri-bar-chart-box-line',
			'ri-calendar-todo-line',
			'ri-database-2-line',
			'ri-file-list-3-line',
			'ri-price-tag-2-line',
			'ri-anchor-line',
			'ri-disc-line',
		);


		// logo
		$logo = Settings::find('logo');
		$background = Settings::find('background');

		$logo = isset($logo[0]) ? $logo[0] : array('path' => ''); 
		$background = isset($background[0]) ? $background[0] : array('path' => ''); 
		// section 1
		$section1_title = Settings::find('section1_title');
		$section1_caption_1 = Settings::find('section1_caption_1');
		$section1_caption_2 = Settings::find('section1_caption_2');


		// section 2
		$section2_title = Settings::find('section2_title');
		$section2_sub_title = Settings::find('section2_sub_title');
		$section2_data = Settings::find('section2_data');


		// section 3
		$section3_product = Settings::find('section3_product');
		$section3_quote = Settings::find('section3_quote');

		$products = array_chunk(Products::findByOrder('id', $section3_product), 4);

		// meta
		$meta_title = Settings::find('meta_title');
		$meta_tag = Settings::find('meta_tag');
		$meta_description = Settings::find('meta_description');


    Meta::set('title', $meta_title);
    Meta::set('description', $meta_description);
    Meta::set('tag', $meta_tag);


		return view("site::public.index", 
			compact(
				'logo', 
				'background', 
				'section1_title', 
				'section1_caption_1', 
				'section1_caption_2', 
				'section2_title', 
				'section2_sub_title',
				'section2_data',
				'section3_quote',
				'dataIcon',
				'dataColor',
				'products',
				'meta_title',
				'meta_tag',
				'meta_description',
			)
		);
	}


	public function login()
	{
		return view("site::public.login");
	}


	public function doLogin(Request $request)
	{
		$validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password'  => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
                    ->withErrors(array('message' => 'Login Failed, Check Your Email and Password'))
                    ->withInput();
    }

    $credentials = $request->only('email', 'password'); 
    $remember = $request->remember;

    if (Auth::guard('web')->attempt($credentials, $remember)) {
      session()->flash('success_login', 'Task was successful!');
      return redirect()->route('dashboard');
    }

    return redirect()->back()
                    ->withErrors(array('message' => 'Login Failed, Check Your Email and Password'))
                    ->withInput();

	}

	public function register()
	{
		return view("site::public.register");
	}

	public function doRegister(Request $request)
	{
		$validator = Validator::make($request->all(), [
      'email' => 'required|email|unique:customers',
      'name' => 'required',
      'invite_code' => 'required|inviteCode',
      'password'  => 'required',
    ]);


    if ($validator->fails()) {
      return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
    }


    // check apakah invite codenya udah bener apa g
		$findCode = Invitecodes::findCode($request->invite_code);

		$dataInsert = array(
			'email' => $request->email,
			'name' => $request->name,
			'password' => bcrypt($request->password),
			'invite_code' => $request->invite_code,
			'status'	=> 1
		);

		$customer = Customers::create($dataInsert);


		Invitecodes::setUsed($customer->id, $findCode->id);

	 try{
      Auth::guard('web')->loginUsingId($customer->id);
    }
    catch (Exception $e){
      return $e->getMessage();
    }

    return redirect()->route('dashboard');


	}

	public function logout()
	{
		Auth::guard('web')->logout();
    session()->flush();
    return redirect()->route('login');	
	}
}
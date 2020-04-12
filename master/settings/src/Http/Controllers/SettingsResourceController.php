<?php

namespace Master\Settings\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Settings\Interfaces\SettingsRepositoryInterface;
use Master\Settings\Models\Settings;
use Validator;
use Meta;
use Products;
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

		$setting = $this->repository->newInstance(array());

		// get all data


		$settings = $this->repository->all();


		foreach ($settings as $key => $value) {
			$setting->{$value->slug} = $value->value;
		}

		$products = Products::all();

		if (isset($setting->section3_product)) {
			if ((bool)!empty($setting->section3_product)) {
				
				$products = Products::findByOrder('id', $setting->section3_product);

				// nambah product

				$productNotSelected = Products::findWhereNotIn('id', $setting->section3_product);

				if (!is_null($productNotSelected)) {
					
					foreach ($productNotSelected as $key => $value) {
						$products[] = $value;
					}
				}
					
			}
		}

		return view('settings::admin.settings.index', compact('setting', 'products'));	
	}

	public function store(Request $request)
	{
		// statik dulu nanti dicarikan caranya biar bisa gampang

		// logo
		$logo = is_null($request->logo) ? array() : array_values($request->logo);
		// insert logo
		$this->repository->insertData('logo', 'logo', $logo, array());


		// background
		$background = is_null($request->background) ? array() : array_values($request->background);
		$this->repository->insertData('background', 'background', $background, array());

		// section 1
		$section1_title = $request->setting['section1_title'];
		$this->repository->insertData('section1_title', 'section1_title', $section1_title);

		$section1_caption_1 = $request->setting['section1_caption_1'];
		$this->repository->insertData('section1_caption_1', 'section1_caption_1', $section1_caption_1);
		
		$section1_caption_2 = $request->setting['section1_caption_2'];
		$this->repository->insertData('section1_caption_2', 'section1_caption_2', $section1_caption_2);


		// section 2
		$section2_title = $request->setting['section2_title'];
		$this->repository->insertData('section2_title', 'section2_title', $section2_title);

		$section2_sub_title = $request->setting['section2_sub_title'];
		$this->repository->insertData('section2_sub_title', 'section2_sub_title', $section2_sub_title);

		$section2_data = isset($request->setting['section2_data']) ? $request->setting['section2_data'] : array();
		$this->repository->insertData('section2_data', 'section2_data', $section2_data, array());


		// section 3
		$section3_product = isset($request->setting['section3_product']) ? $request->setting['section3_product'] : array();
		$this->repository->insertData('section3_product', 'section3_product', $section3_product, array());

		$section3_quote = isset($request->setting['section3_quote']) ? $request->setting['section3_quote'] : array();
		$this->repository->insertData('section3_quote', 'section3_quote', $section3_quote, array());


		// meta
		$meta_title = $request->setting['meta_title'];
		$this->repository->insertData('meta_title', 'meta_title', $meta_title);
		$meta_tag = $request->setting['meta_tag'];
		$this->repository->insertData('meta_tag', 'meta_tag', $meta_tag);
		$meta_description = $request->setting['meta_description'];
		$this->repository->insertData('meta_description', 'meta_description', $meta_description);


		$request->session()->flash('status', 'Data has been update!');

		return redirect()->back();
		
	}

	
}
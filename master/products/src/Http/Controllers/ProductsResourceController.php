<?php

namespace Master\Products\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Products\Interfaces\ProductsRepositoryInterface;
use Master\Products\Models\Products;
use Validator;
use Meta;

class ProductsResourceController extends Controller
{
	protected $repository;

	public function __construct(ProductsRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
		Meta::title('Products');
	}

	public function index(Request $request)
	{
		if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Products\Repositories\Presenter\ProductsPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }


		return view("products::admin.products.index");
	}

	public function create(Request $request)
	{
		$method = 'create';
		
		$data = $this->repository->newInstance([]);
		return view("products::admin.products.form", compact('method', 'data'));
	}

	public function store(Request $request)
	{
	 	$validator = Validator::make($request->all(), [
			'name' 		=> 'required',
			'slug' 		=> 'required',
			'price_idr' 	=> 'required',
			'price_dollar'=> 'required',
			'status' 		=> 'required',
		]);

		if ($validator->fails()) {
			return redirect()->back()
					->withErrors($validator)
					->withInput();
		}

		$dataInsert = array(
			'name' 		=> $request->name,
			'slug'		=> $request->slug,
			'price_idr'=> $request->price_idr,
			'price_dollar'=> $request->price_dollar,
			'file'=> is_null($request->file) ? array() : array_values($request->file),
			'detail'=> $request->detail,
			'status'	=> $request->status,
		);

		$data = $this->repository->create($dataInsert);

		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.products');
		}
		return redirect()->route('admin.products.edit', ['id' => $data->id]);

	}

	public function edit(Request $request, Products $data)
	{
		$method = 'edit';
  	return view('products::admin.products.form', compact('data', 'method'));
	  
	}

	public function update(Request $request, Products $data)
	{
	 	$validator = Validator::make($request->all(), [
			'name' 		=> 'required',
			'slug' 		=> 'required',
			'price_idr' 	=> 'required',
			'price_dollar'=> 'required',
			'status' 		=> 'required',
		]);

		if ($validator->fails()) {
			return redirect()->back()
					->withErrors($validator)
					->withInput();
		}

		$dataInsert = array(
			'name' 		=> $request->name,
			'slug'		=> $request->slug,
			'price_idr'=> $request->price_idr,
			'price_dollar'=> $request->price_dollar,
			'file'=> is_null($request->file) ? array() : array_values($request->file),
			'detail'=> $request->detail,
			'status'	=> $request->status,
		);


		$data = $this->repository->update($dataInsert, $data->id);

		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.products');
		}
		return redirect()->route('admin.products.edit', ['id' => $data->id]);

	}

	public function delete(Request $request, Products $data)
	{

	}

}
<?php

namespace Master\Videos\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Videos\Interfaces\VideosRepositoryInterface;
use Master\Videos\Models\Videos;
use Validator;
use Meta;

class VideosResourceController extends Controller
{
	protected $repository;

	public function __construct(VideosRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
		Meta::title('Videos');
	}

	public function index(Request $request)
	{	
		if($request->ajax()){
      $pageLimit = $request->length;
      $data = $this->repository
          ->setPresenter(\Master\Videos\Repositories\Presenter\VideosPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
		return view('videos::admin.videos.index');
	}

	public function create(Request $request)
	{
		$method = 'create';
		
		$data = $this->repository->newInstance([]);

		return view('videos::admin.videos.form', compact('data', 'method'));
	}

	public function store(Request $request)
	{
	 	$validator = Validator::make($request->all(), [
			'name' 		=> 'required',
			'youtube' => 'required',
			'position'=> 'required',
			'status'  => 'required',
		]);


		if ($validator->fails()) {
			return redirect()->back()
					->withErrors($validator)
					->withInput();
		}

		$dataInsert = array(
			'name' 		=> $request->name,
			'youtube'	=> $request->youtube,
			'position'=> (int)$request->position,
			'status'	=> $request->status,
		);

		$data = $this->repository->create($dataInsert);

		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.videos');
		}
		return redirect()->route('admin.videos.edit', ['id' => $data->id]);
	}

	public function edit(Request $request, Videos $data)
	{
	  $method = 'edit';
		return view('videos::admin.videos.form', compact('data', 'method'));
	}

	public function update(Request $request, Videos $data)
	{
	  $validator = Validator::make($request->all(), [
			'name' 		=> 'required',
			'youtube' => 'required',
			'position'=> 'required',
			'status'  => 'required',
		]);


		if ($validator->fails()) {
			return redirect()->back()
					->withErrors($validator)
					->withInput();
		}

		$dataInsert = array(
			'name' 		=> $request->name,
			'youtube'	=> $request->youtube,
			'position'=> (int)$request->position,
			'status'	=> $request->status,
		);

		$this->repository->update($dataInsert, $data->id);
		
		$request->session()->flash('status', 'Success Insert Data!');
		
		if ($request->submit == 'submit_exit') {
			return redirect()->route('admin.videos');
		}
		return redirect()->route('admin.videos.edit', ['id' => $data->id]);
	}

	public function delete(Request $request, Videos $data)
	{
		$data = $this->repository->delete($data->id);
		$request->session()->flash('status', 'Success Delete Data!');

		return redirect()->route('admin.videos');
	}

}
<?php

namespace Master\Invitecodes\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Invitecodes\Interfaces\InvitecodesRepositoryInterface;
use Master\Invitecodes\Models\Invitecodes;
use Validator;

class InvitecodesResourceController extends Controller
{
	protected $repository;

	public function __construct(InvitecodesRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
		$this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);
	}

	public function index(Request $request)
	{
		if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Invitecodes\Repositories\Presenter\InvitecodesPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }

		return view('invitecodes::admin.invitecodes.index');
	}

  public function generateCode(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'number'       => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(array(
        'status' => false
      ));
    }


    for ($i=0; $i < $request->number; $i++) { 
      $data = array(
        'code' => uniqid(),
        'status' => 0
      );

      $this->repository->create($data);
    } 

    return response()->json(array(
      'status' => true
    ));
  }

  public function delete(Request $request, Invitecodes $data)
  {
    $data = $this->repository->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.invitecodes');
  }
}
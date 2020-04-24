<?php

namespace Master\Core\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Meta;
use DB;
use Master\Core\Interfaces\ReportsRepositoryInterface;

class DashboardResourceController extends Controller
{

  protected $report;

	public function __construct(ReportsRepositoryInterface $report)
	{
		$this->middleware('auth:admin');
		Meta::title('Dashboard');

    $this->report = $report;
	}

	public function index()
	{
		return view('core::admin.core.dashboard');
	}

  public function profile()
  {
    $data = Auth::guard('admin')->user();
    return view('core::admin.core.profile', compact('data'));
  }

  public function updateProfilePicture(Request $request)
  {
    $data = Auth::guard('admin')->user();
    $data->photo = $request->photo;
    $data->save();

    return response()->json(array(
      'status' => true
    ));
  }


  public function getReport(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $query = DB::table('reports')->select(DB::raw('
                default_customers.email as email,
                default_reports.id as report_id,
                default_reports.report as report,
                default_reports.created_at as created_at
              '))->join('customers', function ($join) use ($filtered){
                $join->on('reports.customer_id', '=', 'customers.id');
                if (!(bool)empty($filtered['email'])) {
                  $join->where('customers.email', 'like', "%{$filtered['email']}%");
                }
                $join->whereNull('customers.deleted_at');
              })->whereNull('reports.deleted_at');



      $headerOrder = array(
        'created_at',
        'email',
        'report',
      );
      

      $sortBy = $headerOrder[$order[0]['column']];
      $sortOrder = $order[0]['dir'];

      if (isset($sortBy) && !empty($sortBy)) {
        $query->orderBy($sortBy, $sortOrder);
      }


      $dataFromModel = $query->paginate($pageLimit);
      $dataList = array();

      
      $paginationMeta = $dataFromModel->toArray();


      foreach ($dataFromModel->items() as $key => $value) {
        $btn = '<div class="btn-group">
              <a href="'.route('admin.report.delete', ['id'=>$value->report_id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$value->report_id.'"><i class="fa fa-fw fa-trash"></i></a>
            </div>';

        $dataList[] = array(
          'created_at'=> $value->created_at,
          'email'=> $value->email,
          'report'=> $value->report,
          'action' => $btn
        );

      }


      $response = array(
        'draw' => $request->draw,
        'data' => $dataList,
        'recordsTotal' => (int)$paginationMeta['to'],
        'recordsFiltered' => (int)$paginationMeta['total'], 
      );

      return response()->json($response);
    }

    abort(404);
  }


  public function deleteReport(Request $request, $id = '')
  {
    $data = $this->report->findOrFail($id);

    $data = $this->report->delete($data->id);
    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->route('admin.dashboard');
  }


  public function doUpdateProfile(Request $request)
  {
    $data = Auth::guard('admin')->user();
    $validator = Validator::make($request->all(), [
      'name'  => 'required',
    ]);

    if ($validator->fails()) {
      return redirect()->back()
              ->withErrors($validator)
              ->withInput();
    }


    if (!(bool)empty($request->password)) {
      if (strlen($request->password) < 6) {
        return redirect()->back()
                    ->withErrors(array('password' => 'Minimal Password 6 Character'))
                    ->withInput();
      }
    }

    $data->name = $request->name;

    if (!(bool)empty($request->password)) {
      $data->password = bcrypt($request->password);
    }

    $data->save();

    $request->session()->flash('status', 'Success Update Data!');

    return redirect()->back();
  }
}
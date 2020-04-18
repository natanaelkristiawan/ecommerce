<?php

namespace Master\Customers\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Customers\Interfaces\CustomersRepositoryInterface;
use Master\Customers\Models\Customers;
use Validator;
use Meta;
use Orders;

class CustomersResourceController extends Controller
{
	protected $repository;

	public function __construct(CustomersRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
    $this->repository->pushCriteria(\Master\Core\Repositories\Criteria\RequestCriteria::class);

    Meta::title('Customers');
	}

	public function index(Request $request)
	{
    if($request->ajax()){
      $pageLimit = $request->length;

      $data = $this->repository
          ->setPresenter(\Master\Customers\Repositories\Presenter\CustomersPresenter::class)
          ->setPageLimit($pageLimit)
          ->getDataTable();

      return response()->json($data);
    }
    return view('customers::admin.customers.index');
	}


  public function profile(Request $request, Customers $data)
  {
    if($request->ajax()){

      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;
      $query = Orders::datatable($request, $data->id);

      $query->where('orders.status', 1);

      $headerOrder = array(
        'created_at',
        'product',
        'total',
        'download_link',
        'transfer_confirmation',
        'status'
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
        $transfer_confirmation = '<a href="'.url('image/original/').'/'.$value->transfer_confirmation.'" data-featherlight="image"><img style="max-width:100px; display:block; margin:auto; border-radius:10px" class="img-fluid mb-2" alt="Responsive image" src="'.url('image/preview/').'/'.$value->transfer_confirmation.'"></img></a>';

        $dataList[] = array(
          'created_at'=> $value->created_at,
          'product'=> $value->product,
          'total'=> $value->total,
          'download_link'=> $value->download_link,
          'transfer_confirmation'=> $transfer_confirmation,
          'status'=> '<span class="badge badge-'.config('master.orders.color.'.$value->status).'">'.config('master.orders.status.'.$value->status).'</span>',
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
    return view('customers::admin.customers.profile', compact('data'));
  }
}
<?php

namespace Master\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Orders\Interfaces\OrdersRepositoryInterface;
use Master\Orders\Models\Orders;
use Validator;
use Meta;
use DB;
class OrderSuccessController extends Controller {

  protected $repository;

  public function __construct(OrdersRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    Meta::title('Order Success');
  }

  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $counter = (int)$request->start;

      $query = DB::table('orders')->select(DB::raw('
                customers.email as email,
                products.name as product,
                orders.id as order_id,
                orders.unique_code as unique_code,
                orders.transfer_confirmation as transfer_confirmation,
                orders.invoice as invoice,
                orders.total as total,
                orders.download_link as download_link,
                orders.status as status,
                orders.updated_at as updated_at,
              '))->join('customers', function ($join) use ($filtered) {
                $join->on('orders.customer_id', '=', 'customers.id');
                if (!(bool)empty($filtered['email'])) {
                  $join->where('customers.email', 'like', "%{$filtered['email']}%");
                }
              })->join('products', function($join) use ($filtered){
                $join->on('orders.product_id', '=', 'products.id');
              })->where('orders.status', 1);

      if (!(bool)empty($filtered['unique_code'])) {
        $query->where('unique_code', 'like', '%'.$filtered['unique_code'].'%');
      }

      $headerOrder = array(
        'updated_at',
        'invoice',
        'customer',
        'product',
        'unique_code',
        'transfer_confirmation',
        'total',
        'download_link',
        'status',
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
        $dataList[] = array(
          'updated_at'=> $value->updated_at,
          'invoice'=> $value->invoice,
          'customer'=> $value->customer,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> $value->transfer_confirmation,
          'total'=> $value->total,
          'download_link'=> $value->download_link,
          'status'=> $value->status,
          'action' => ''
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
    return view('orders::admin.success.index');
  }
}
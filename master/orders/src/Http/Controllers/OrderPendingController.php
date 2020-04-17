<?php

namespace Master\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Orders\Interfaces\OrdersRepositoryInterface;
use Master\Orders\Models\Orders;
use Validator;
use Meta;
use DB;
class OrderPendingController extends Controller {
  

  protected $repository;

  public function __construct(OrdersRepositoryInterface $repository)
  {
    $this->middleware('auth:admin');
    $this->repository = $repository;
    Meta::title('Order Waiting');
  }


  public function index(Request $request)
  {
    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;

      $query = DB::table('orders')->select(DB::raw('
                default_customers.email as email,
                default_products.name as product,
                default_orders.id as order_id,
                default_orders.unique_code as unique_code,
                default_orders.transfer_confirmation as transfer_confirmation,
                default_orders.invoice as invoice,
                default_orders.total as total,
                default_orders.timeout as timeout,
                default_orders.status as status,
                default_orders.created_at as created_at
              '))->join('customers', function ($join){
                $join->on('orders.customer_id', '=', 'customers.id');
                if (!(bool)empty($filtered['email'])) {
                  $join->where('customers.email', 'like', "%{$filtered['email']}%");
                }
              })->join('products', function($join){
                $join->on('orders.product_id', '=', 'products.id');
              })->where('orders.status', 0);

      if (!(bool)empty($filtered['unique_code'])) {
        $query->where('unique_code', 'like', '%'.$filtered['unique_code'].'%');
      }

      $headerOrder = array(
        'created_at',
        'invoice',
        'email',
        'product',
        'unique_code',
        'transfer_confirmation',
        'total',
        'timeout',
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
          'created_at'=> $value->created_at,
          'invoice'=> $value->invoice,
          'email'=> $value->email,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> $value->transfer_confirmation,
          'total'=> $value->total,
          'timeout'=> $value->timeout,
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

    return view('orders::admin.pending.index');
  }
}
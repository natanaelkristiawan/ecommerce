<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Models\Site;
use Products;
use Settings;
use Auth;
use Orders;
use Meta;
class DashboardResourceController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:web');
    Meta::title('Order Pending');
  }

  public function index(Request $request)
  {
    $products = Products::all();

    $accounts = Settings::find('account');

    return view('site::dashboard.index', compact('products', 'accounts'));
  }

  public function orderPending(Request $request)
  {
    $customer = Auth::guard('web')->user();

    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $query = Orders::datatable($request, $customer->id);

      $query->whereNotIn('orders.status', array(1, 5));

      $headerOrder = array(
        'created_at',
        'invoice',
        'customer',
        'product',
        'unique_code',
        'transfer_confirmation',
        'total',
        'time_out',
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
          'customer'=> $value->customer,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> $value->transfer_confirmation,
          'total'=> $value->total,
          'time_out'=> $value->time_out,
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
    return view('site::order.pending.index');
    
  }



  public function orderSuccess(Request $request)
  {
    $customer = Auth::guard('web')->user();
        if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $query = Orders::datatable($request, $customer->id);

      $query->where('orders.status', 1);

      $headerOrder = array(
        'created_at',
        'invoice',
        'customer',
        'product',
        'unique_code',
        'transfer_confirmation',
        'total',
        'time_out',
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
          'customer'=> $value->customer,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> $value->transfer_confirmation,
          'total'=> $value->total,
          'time_out'=> $value->time_out,
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
    return view('site::order.success.index');
  }
}
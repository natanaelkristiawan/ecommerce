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
use Validator;
use Storage;
use Videos;
use Reports;
use Illuminate\Support\Str;

class DashboardResourceController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:web');

  }

  public function index(Request $request)
  {
    $customer = Auth::guard('web')->user();
    $products = Products::all();
    $productOrder = Orders::findOrderSuccess($customer->id);


    $accounts = Settings::find('account');

    return view('site::dashboard.index', compact('products', 'accounts', 'productOrder'));
  }



  public function orderCreate(Request $request)
  {
    $customer = Auth::guard('web')->user();


    $validator = Validator::make($request->all(), [
      'product_id'  => 'required',
      'unique_code' => 'required',
      'total'       => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(array(
        'status' => false
      ));
    }
    $dataInsert = array(
      'product_id' => $request->product_id,
      'customer_id' => $customer->id,
      'unique_code' => $request->unique_code,
      'total' => $request->total,
      'timeout' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s') . ' +15 minutes')),
      'status'  => 0
    );

    $data = Orders::createOrder($dataInsert);


    return response()->json(
      array(
        'status' => true
      )
    );


  }

  public function orderPending(Request $request)
  {
    $customer = Auth::guard('web')->user();
    Meta::title('Order Pending');
    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $query = Orders::datatable($request, $customer->id);

      $query->whereNotIn('orders.status', array(1, 4));

      $headerOrder = array(
        'created_at',
        'invoice',
        'customer',
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

        $additional = '';

        $textUpload = 'Upload File';

        if ($value->transfer_confirmation !== '' && !(bool)is_null($value->transfer_confirmation)) {
          $additional = '<a href="'.url('image/original/').'/'.$value->transfer_confirmation.'" data-featherlight="image"><img style="max-width:100px; display:block; margin:auto; border-radius:10px" class="img-fluid mb-2" alt="Responsive image" src="'.url('image/preview/').'/'.$value->transfer_confirmation.'"></img></a>';
          $textUpload = 'Change File';
        }


        $dataList[] = array(
          'created_at'=> $value->created_at,
          'invoice'=> $value->invoice,
          'email'=> $value->email,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> '<div style="text-align:center">'.$additional.'<button data-id="'.$value->order_id.'" class="btn btn-primary btn-sm btn-upload">'.$textUpload.'</button></div>',
          'total'=> $value->total,
          'timeout'=> $value->timeout,
          'status'=> '<span class="badge badge-'.config('master.orders.color.'.$value->status).'">'.config('master.orders.status.'.$value->status).'</span>',
          'action' => '<div class="btn-group">
                  <a href="'.route('public.orderDelete', array('id'=>$value->order_id)).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$value->order_id.'"><i class="fa fa-fw fa-trash"></i></a>
                  </div>'
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

    $accounts = Settings::find('account');
    return view('site::order.pending.index', compact('accounts'));
    
  }

  public function orderWaitingConfirmation(Request $request)
  {
    $customer = Auth::guard('web')->user();
    $validator = Validator::make($request->all(), [
      'order_id'  => 'required',
      'transfer_confirmation' => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(array(
        'status' => false
      ));
    }


    $order = Orders::findOrder($request->order_id);
    $order->transfer_confirmation = $request->transfer_confirmation;
    $order->status = 2;
    $order->save();


    return response()->json(array(
      'status' => true
    ));


  }



  public function orderSuccess(Request $request)
  {
    $customer = Auth::guard('web')->user();
    Meta::title('Order Success');
    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $query = Orders::datatable($request, $customer->id);

      $query->where('orders.status', 1);

      $headerOrder = array(
        'updated_at',
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

        $download_link = '';
        if (!(bool)is_null($value->download_link)) {
          $download_link = '<a download class="btn btn-sm btn-primary2" href="'.env('CUSTOMER_DOWNLOAD').$value->download_link.'" >Download</a>';
        } 

        $transfer_confirmation = '<a href="'.url('image/original/').'/'.$value->transfer_confirmation.'" data-featherlight="image"><img style="max-width:100px; display:block; margin:auto; border-radius:10px" class="img-fluid mb-2" alt="Responsive image" src="'.url('image/preview/').'/'.$value->transfer_confirmation.'"></img></a>';
        $dataList[] = array(
          'updated_at'=> $value->updated_at,
          'invoice'=> '<a target="_blank" href="'.route('public.invoice', array('id'=>$value->order_id)).'">'.$value->invoice.'</a>',
          'email'=> $value->email,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> $transfer_confirmation,
          'total'=> $value->total,
          'download_link'=> $download_link,
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
    return view('site::order.success.index');
  }

  public function deleteOrder(Request $request, $id = '')
  {
    $customer = Auth::guard('web')->user();

    $params = array(
      'id' => $id,
      'customer_id' => $customer->id
    );

    $order = Orders::findWhere($params)->first();

    if (is_null($order)) {
      abort(404);
    }


    $order->status = 4;
    $order->save();

    $request->session()->flash('status', 'Success Deleted!');

    return redirect()->back();
  }



  public function invoice($id='')
  {
    $customer = Auth::guard('web')->user();
    $params = array(
      'id' => $id,
      'customer_id' => $customer->id,
      'status' => 1
    );

    $data = Orders::findWhere($params)->first();

    if (is_null($data)) {
      abort(404);
    }
    return view('orders::admin.invoice.index', compact('data'));
  }


  public function profile()
  {
    Meta::title('Profile');
    $data = Auth::guard('web')->user();
    return view('site::dashboard.profile', compact('data'));
  }


  public function doUpdateProfile(Request $request)
  {
    $customer = Auth::guard('web')->user();
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

    $customer->name = $request->name;

    if (!(bool)empty($request->password)) {
      $customer->password = bcrypt($request->password);
    }

    $customer->save();

    $request->session()->flash('status', 'Success Updated!');

    return redirect()->back();
  }

  public function updateProfilePicture(Request $request)
  {
    
    $customer = Auth::guard('web')->user();
  
    $customer->photo = $request->photo;
    $customer->save();

    return response()->json(array(
      'status' => true
    ));
  }


  public function myproduct(Request $request)
  {
    $customer = Auth::guard('web')->user();
    Meta::title('My Product');
    if($request->ajax()){
      $pageLimit = $request->length;
      $filtered = $request->search;
      $columns = $request->columns;
      $order   = $request->order;


      $query = Orders::datatable($request, $customer->id);

      $query->where('orders.status', 1);

      $headerOrder = array(
        'buy_at',
        'product',
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

        $download_link = '';
        if (!(bool)is_null($value->download_link)) {
          $download_link = '<a download class="btn btn-sm btn-primary" href="'.env('CUSTOMER_DOWNLOAD').$value->download_link.'" >Download</a>';
        } 

        $dataList[] = array(
          'buy_at'=> $value->buy_at,
          'product'=> $value->product,
          'how_to_use'=> '<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-filter">  How to use  </button>',
          'download_link'=> $download_link,
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
    return view('site::myproduct.index');
  }


  public function demo()
  {
    Meta::title('Demo Tutorial');
    $data = Videos::all();
    return view('site::dashboard.demo', compact('data'));
  }


  public function report(Request $request)
  {
    $customer = Auth::guard('web')->user();
    $validator = Validator::make($request->all(), [
      'report'  => 'required',
    ]);

    if ($validator->fails()) {
      return response()->json(array(
        'status' => false
      ));
    }

    $dataReport = array(
      'customer_id' => $customer->id,
      'report' => $request->report,
      'images' => $request->images
    );


    Reports::create($dataReport);

    return response()->json(array(
      'status' => true
    ));
  }

  public function managementSender()
  {
    $data = Auth::guard('web')->user();

    Meta::title('Generate Token');
    return view('site::dashboard.managementSender', compact('data'));
  }


  public function generateToken()
  {
    $customer = Auth::guard('web')->user();
    $public_key = Str::random(25);
    $private_key = Str::random(25);
    $api_token = base64_encode(md5($public_key.$private_key));


    $customer->public_key = $public_key;
    $customer->private_key = $private_key;
    $customer->api_token = hash('sha256', $api_token);

    $customer->save();

    return response()->json(array(
      'publicKey' => $public_key,
      'privateKey' => $private_key,
      'apiToken' => $api_token
    ));
  }

  public function saveDeviceID(Request $request)
  {
    $deviceID = $request->device_id;

    $customer = Auth::guard('web')->user();
    $customer->device_id = $deviceID;
    $customer->save();

    return response()->json(array('status' => true));
  }
}
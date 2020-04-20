<?php

namespace Master\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Orders\Interfaces\OrdersRepositoryInterface;
use Master\Orders\Models\Orders;
use Validator;
use Meta;
use DB;
use Settings;

use File;
use ZipArchive;
use Storage;
use Illuminate\Support\Str;

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
                $join->whereNull('customers.deleted_at');
              })->join('products', function($join){
                $join->on('orders.product_id', '=', 'products.id');
              })->whereNotIn('orders.status', array(1, 4));

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

        $transfer_confirmation = '';
        $btn = '<div class="btn-group">
              <a href="'.route('admin.orderPending.delete', ['id'=>$value->order_id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$value->order_id.'"><i class="fa fa-fw fa-trash"></i></a>
            </div>';

        if ($value->transfer_confirmation !== '' && !(bool)is_null($value->transfer_confirmation)) {
          $transfer_confirmation = '<a href="'.url('image/original/').'/'.$value->transfer_confirmation.'" data-featherlight="image"><img style="max-width:100px; display:block; margin:auto; border-radius:10px" class="img-fluid mb-2" alt="Responsive image" src="'.url('image/preview/').'/'.$value->transfer_confirmation.'"></img></a>';
          $btn = '<div class="btn-group">
              <a href="'.route('admin.orderPending.confirm', ['id'=>$value->order_id]).'" onclick="return confirm(\'Are you confirm this item?\')" class="btn btn-sm btn-primary btn-flat btn-save" data-id="'.$value->order_id.'"><i class="fa fa-fw fa-save"></i></a>
              <a href="'.route('admin.orderPending.delete', ['id'=>$value->order_id]).'" onclick="return confirm(\'Are you delete this item?\')" class="btn btn-sm btn-danger btn-flat btn-delete" data-id="'.$value->order_id.'"><i class="fa fa-fw fa-trash"></i></a>
            </div>';
        }
        $dataList[] = array(
          'created_at'=> $value->created_at,
          'invoice'=> $value->invoice,
          'email'=> $value->email,
          'product'=> $value->product,
          'unique_code'=> $value->unique_code,
          'transfer_confirmation'=> $transfer_confirmation,
          'total'=> $value->total,
          'timeout'=> $value->timeout,
          'status'=> '<span class="badge badge-'.config('master.orders.color.'.$value->status).'">'.config('master.orders.status.'.$value->status).'</span>',
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
    return view('orders::admin.pending.index');
  }


  public function delete(Request $request, $id = '')
  {
    $order = $this->repository->find($id);

    $order->status = 4;
    $order->save();

    $request->session()->flash('status', 'Success Delete Data!');

    return redirect()->back();
    
  } 


  public function confirm(Request $request, $id = '')
  {

    $latestInv = (int)Settings::find('invoice');

    $latestInv = $latestInv + 1;
    $invoice = self::invoice_num($latestInv, 5, 'RG43S/'.date('Y/m/'));


    $order = $this->repository->find($id);
    // nanti di sini dibuatkan download linknya
    $product = $order->product;
    $customer = $order->customer;
    $download_link = self::createZip($product, $customer); 

    $order->status = 1;
    $order->invoice = $invoice;
    $order->download_link = $download_link;
    $order->save();

    Settings::updateCreate('invoice', $latestInv);
    $request->session()->flash('status', 'Success Confirm Data!');

    return redirect()->back();
  }


  private function createZip($product, $customer)
  {

    $public_dir =  base_path('storage/uploads');
    $zipFileName = uniqid().'.zip';
    $zip = new ZipArchive;

    if ($zip->open($public_dir . '/' . $zipFileName, ZipArchive::CREATE) === TRUE) {
      $zip->setPassword($customer->invite_code);
      foreach ($product->file as $key => $value) {
        $zip->addFile($public_dir.'/'.$value['path'], $value['file']);
        $zip->setEncryptionName($value['file'], ZipArchive::EM_AES_256);
      }

      $zip->close();
    }

    $filetopath= File::get($public_dir.'/'.$zipFileName);

    $newLocation = Str::slug($customer->email, '-').'/'.$zipFileName;
    $test = Storage::disk('public')->put($newLocation, $filetopath);

    return $newLocation;
  }

  private function invoice_num ($input, $pad_len = 7, $prefix = null) {
    if ($pad_len <= strlen($input))
        trigger_error('<strong>$pad_len</strong> cannot be less than or equal to the length of <strong>$input</strong> to generate invoice number', E_USER_ERROR);

    if (is_string($prefix))
        return sprintf("%s%s", $prefix, str_pad($input, $pad_len, "0", STR_PAD_LEFT));

    return str_pad($input, $pad_len, "0", STR_PAD_LEFT);
  }
}
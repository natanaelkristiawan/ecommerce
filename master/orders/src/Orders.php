<?php
namespace Master\Orders;
use Illuminate\Http\Request;
use DB;

use Master\Orders\Interfaces\OrdersRepositoryInterface;
class Orders
{

  protected $repository;

  public function __construct(OrdersRepositoryInterface $repository)
  {
    $this->repository = $repository;
  }



  public function datatable(Request $request, $customer_id)
  {


    // filter dulu yang masih pending

    $dateNow = date('Y-m-d H:i:s');

    $this->repository->where('timeout', '<=', $dateNow)->where('status', 0)->where('customer_id', $customer_id)->update(array('status'=>4));

    $pageLimit = $request->length;
    $filtered = $request->search;
    $columns = $request->columns;
    $order   = $request->order;


    $counter = (int)$request->start;

    $query = DB::table('orders')->select(DB::raw('
              default_customers.email AS email,
              default_products.name AS product,
              default_orders.id AS order_id,
              default_orders.unique_code AS unique_code,
              default_orders.transfer_confirmation AS transfer_confirmation,
              default_orders.invoice AS invoice,
              default_orders.total AS total,
              default_orders.timeout AS timeout,
              default_orders.download_link AS download_link,
              default_orders.status AS status,
              default_orders.created_at AS created_at,
              default_orders.updated_at AS updated_at,
              default_orders.updated_at AS buy_at
            '))->join('customers', function ($join) {
              $join->on('orders.customer_id', '=', 'customers.id');
              $join->whereNull('customers.deleted_at'); 
            })->join('products', function($join) {
              $join->on('orders.product_id', '=', 'products.id');
            })->where('orders.customer_id', $customer_id)->whereNull('orders.deleted_at');

    return $query;
  }


  public function createOrder($data = array())
  {
    return $this->repository->create($data);
  }


  public function findOrder($order_id = '')
  {
    return $this->repository->find($order_id);
  }

  public function findWhere($params = array())
  {
    return $this->repository->findWhere($params);
  }


  public function countAllPending()
  {
    return $this->repository->findWhereIn('status', array(0, 2))->count();
  }

  public function countAllPendingThisMonth()
  {
    return $this->repository->whereBetween('created_at', array(date('Y-m-01').' 00:00:01', date('Y-m-t').' 23:59:59'))->whereIn('status', array(0, 2))->get()->count();
  }

  public function countAllSuccess()
  {
    return $this->repository->where('status', 1)->count();
  }

  public function countAllSuccessThisMonth()
  {
    return $this->repository->whereBetween('created_at', array(date('Y-m-01').' 00:00:01', date('Y-m-t').' 23:59:59'))->where('status', 1)->get()->count();
  }


  public function removePending()
  {
    $dateNow = date('Y-m-d H:i:s');
    $this->repository->where('timeout', '<=', $dateNow)->where('status', 0)->update(array('status'=>4));
  }
}
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
              default_orders.created_at AS created_at
            '))->join('customers', function ($join) {
              $join->on('orders.customer_id', '=', 'customers.id');
            })->join('products', function($join) {
              $join->on('orders.product_id', '=', 'products.id');
            })->where('orders.customer_id', $customer_id);

    return $query;
  }


  public function createOrder($data = array())
  {
    return $this->repository->create($data);
  }

}
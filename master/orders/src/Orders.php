<?php
namespace Master\Orders;
use Illuminate\Http\Request;
use DB;
class Orders
{

  public function datatable(Request $request, $customer_id)
  {
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
              orders.timeout as timeout,
              orders.download_link as download_link,
              orders.status as status,
              orders.created_at as created_at,
            '))->join('customers', function ($join) use ($filtered)  {
              $join->on('orders.customer_id', '=', 'customers.id');
            })->join('products', function($join) use ($filtered){
              $join->on('orders.product_id', '=', 'products.id');
            })->where('orders.customer_id', $customer_id);

    return $query;

  }

}
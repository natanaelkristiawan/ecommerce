<?php

use Illuminate\Http\Request;
use Master\Products\Facades\Products;
use Master\Orders\Facades\Orders;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('validation', function (Request $request) {
    
    $datacustomer = $request->user();

    $listDeviceID = (array)$datacustomer->device_id;

    if (is_null($request->header('DeviceID'))) {
      return response()->json(array('status'=>false));
    }

    if (!(bool)count($listDeviceID)) {
      return response()->json(array('status'=>false));
    }


    $product = Products::findWhere(array('slug' => 'rg43-sender', 'status' => 1))->first();

    if (is_null($product)) {
      return response()->json(array('status'=>false));
    }


    $dataParams = array(
      'product_id' => $product->id,
      'customer_id' => $datacustomer->id,
      'status' => 1
    );


    $order = Orders::findWhere($dataParams)->first();

    if (is_null($order)) {
      return response()->json(array('status'=>false));
    }



    if (in_array($request->header('DeviceID'), $listDeviceID)) {
      return response()->json(array(
        'status' => 'success'
      ));
    }

    
    return response()->json(array('status'=>false));


});

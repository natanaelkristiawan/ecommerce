<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Models\Site;
use Products;
use Settings;

class DashboardResourceController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth:web');
  }

  public function index(Request $request)
  {
    $products = Products::all();

    $accounts = Settings::find('account');

    return view('site::dashboard.index', compact('products', 'accounts'));
  }
}
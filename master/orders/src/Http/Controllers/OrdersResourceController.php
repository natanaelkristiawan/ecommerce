<?php

namespace Master\Orders\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Master\Orders\Interfaces\OrdersRepositoryInterface;
use Master\Orders\Models\Orders;
use Validator;

class OrdersResourceController extends Controller
{
	protected $repository;

	public function __construct(OrdersRepositoryInterface $repository)
	{
		$this->middleware('auth:admin');
		$this->repository = $repository;
	}

	public function index(Request $request)
	{

	}

	public function create(Request $request)
	{

	}

	public function store(Request $request)
	{
	 
	}

	public function edit(Request $request, Orders $data)
	{
	  
	}

	public function update(Request $request, Orders $data)
	{
	  
	}

	public function delete(Request $request, Orders $data)
	{

	}

}
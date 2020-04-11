<?php

namespace Module\Site\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Module\Site\Models\Site;
use Validator;

class SiteResourceController extends Controller
{
	protected $repository;


	public function index(Request $request)
	{
		return view("site::public.index");
	}

	public function create(Request $request)
	{

	}

	public function store(Request $request)
	{
	 
	}

	public function edit(Request $request, Site $data)
	{
	  
	}

	public function update(Request $request, Site $data)
	{
	  
	}

	public function delete(Request $request, Site $data)
	{

	}

}
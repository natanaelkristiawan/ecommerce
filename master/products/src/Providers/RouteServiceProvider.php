<?php

namespace Master\Products\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;
use Request;
use Route;

class RouteServiceProvider extends ServiceProvider
{
	protected $namespace = 'Master\Products\Http\Controllers';

	public function boot()
	{
		parent::boot();
		if (Request::is('*/products/edit/*') || Request::is('*/products/delete/*')) {
			Route::bind('id', function ($id) {
				$model = $this->app->make('Master\Products\Interfaces\ProductsRepositoryInterface');
				return $model->find($id);
			});
		}
	}

	public function map()
	{
		$this->mapWebRoutes();
	}

	protected function mapWebRoutes()
	{
		Route::group([
		'namespace'  => $this->namespace,
		], function ($route) {
			require (__DIR__ . '/../../routes/web.php');
		});
	}

}

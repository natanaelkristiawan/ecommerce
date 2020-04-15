<?php

namespace Master\Orders;

use Illuminate\Support\ServiceProvider;

class OrdersServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'orders');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'orders');

		// Call pblish redources function
		$this->publishResources();

	}

	/**
	* Register the service provider.
	*
	* @return void
	*/
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.orders');

		// Bind facade
		$this->app->bind('master.orders', function ($app) {
		return $this->app->make('Master\Orders\Orders');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Orders\Interfaces\OrdersRepositoryInterface',
		\Master\Orders\Repositories\Eloquent\OrdersRepository::class
		);

		$this->app->register(\Master\Orders\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.orders'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/orders.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/orders')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}

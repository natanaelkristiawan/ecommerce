<?php

namespace Master\Invitecodes;

use Illuminate\Support\ServiceProvider;

class InvitecodesServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'invitecodes');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'invitecodes');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.invitecodes');

		// Bind facade
		$this->app->bind('master.invitecodes', function ($app) {
		return $this->app->make('Master\Invitecodes\Invitecodes');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Invitecodes\Interfaces\InvitecodesRepositoryInterface',
		\Master\Invitecodes\Repositories\Eloquent\InvitecodesRepository::class
		);

		$this->app->register(\Master\Invitecodes\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.invitecodes'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/invitecodes.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/invitecodes')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}

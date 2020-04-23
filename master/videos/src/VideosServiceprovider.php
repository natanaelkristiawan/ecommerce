<?php

namespace Master\Videos;

use Illuminate\Support\ServiceProvider;

class VideosServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'videos');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'videos');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.videos');

		// Bind facade
		$this->app->bind('master.videos', function ($app) {
		return $this->app->make('Master\Videos\Videos');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Videos\Interfaces\VideosRepositoryInterface',
		\Master\Videos\Repositories\Eloquent\VideosRepository::class
		);

		$this->app->register(\Master\Videos\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.videos'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/videos.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/videos')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}

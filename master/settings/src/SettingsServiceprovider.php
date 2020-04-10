<?php

namespace Master\Settings;

use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'settings');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'settings');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master.settings');

		// Bind facade
		$this->app->bind('master.settings', function ($app) {
		return $this->app->make('Master\Settings\Settings');
		});   

		// Bind article to repository
		$this->app->bind(
		'Master\Settings\Interfaces\SettingsRepositoryInterface',
		\Master\Settings\Repositories\Eloquent\SettingsRepository::class
		);

		$this->app->register(\Master\Settings\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['master.settings'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/settings.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/settings')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}

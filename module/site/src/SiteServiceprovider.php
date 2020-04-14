<?php

namespace Module\Site;

use Illuminate\Support\ServiceProvider;
use Invitecodes;
class SiteServiceProvider extends ServiceProvider
{

	protected $defer = false;

	public function boot()
	{
		$validator = app()->make(\Illuminate\Validation\Factory::class);
	  $validator->extend('inviteCode', function ($attribute, $value, $parameters, $validator) {
			$findCode = Invitecodes::findCode($value);

			if (is_null($findCode)) {
				return false;
			}

			return true;

    });

    $validator->replacer('inviteCode', function ($message, $attribute, $rule, $parameters) {
        return 'Invalid Code';
    });




		// Load view
		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'site');
		// Load migrations
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'site');

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
		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'module.site');

		$this->app->register(\Module\Site\Providers\RouteServiceProvider::class);
	}


	public function provides()
	{
		return ['module.site'];
	}


	private function publishResources()
	{
		// Publish configuration file
		$this->publishes([__DIR__ . '/../config/config.php' => config_path('Mastervel/site.php')], 'config');

		// Publish admin view
		$this->publishes([__DIR__ . '/../resources/views' => base_path('resources/views/vendor/site')], 'view');

		// Publish storage files
		$this->publishes([__DIR__ . '/../storage' => base_path('storage')], 'storage');

		// Publish public files and assets.
		$this->publishes([__DIR__ . '/../public/' => public_path('/')], 'public');
	}
}

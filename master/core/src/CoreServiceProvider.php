<?php

namespace Master\Core;
use Maatwebsite\Sidebar\SidebarManager;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{

	public function register()
	{

		$this->loadViewsFrom(__DIR__ . '/../resources/views', 'core');
		$this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

		$this->commands([
			\Master\Core\Console\CoreCommand::class
		]);

		$this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'master');

		$this->app->register(\Master\Core\Providers\RouteServiceProvider::class);
	}

	public function boot(SidebarManager $manager)
	{
		$manager->register('Master\Core\Sidebar\ConfigSidebar');

		$this->app->bind('master.reports', function ($app) {
			return $this->app->make('Master\Core\Reports');
		});   

		// Bind reports to repository
		$this->app->bind(
			'Master\Core\Interfaces\ReportsRepositoryInterface',
			\Master\Core\Repositories\Eloquent\ReportsRepository::class
		);

		View::creator(
			'theme.admin.partials.sidebar',
			\Master\Core\View\Creator\SidebarCreator::class
		);

		$this->publishResources();
	}

	public function provides()
	{
		return ['master'];
	}


	private function publishResources()
	{

	$this->publishes([__DIR__ . '/../config/config.php' => config_path('master')], 'config');
	}
}
<?php namespace Carbontwelve\Tools;

use Illuminate\Support\ServiceProvider;
USE Carbontwelve\Tools\Services\Format;

class ToolsServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['carbontwelve.format'] = $this->app->share(function($app)
            {
                return new Format();
            });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}

<?php namespace Asianchris\Laravelpress;

use Illuminate\Support\ServiceProvider;

class LaravelpressServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('asianchris/laravelpress');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind('Asianchris\Laravelpress\Wordpress', 'Asianchris\Laravelpress\Post');
		$this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Wordpress', 'Asianchris\Laravelpress\Wordpress');
			$loader->alias('Post', 'Asianchris\Laravelpress\Post');
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

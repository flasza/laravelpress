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
		$this->app->bind('Asianchris\Laravelpress\Post', 'Asianchris\Laravelpress\Page', 'Asianchris\Laravelpress\Media');
		$this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
			$loader->alias('Post', 'Asianchris\Laravelpress\Post');
			$loader->alias('Page', 'Asianchris\Laravelpress\Page');
			$loader->alias('Media', 'Asianchris\Laravelpress\Media');
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

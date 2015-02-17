<?php namespace Samcrosoft\Accesstory;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Samcrosoft\Accesstory\Core\AccessStory;
use Samcrosoft\Accesstory\Core\AccessTracker;
use Samcrosoft\Accesstory\Facade\Facade;

/**
 * Class AccesstoryServiceProvider
 * @package Samcrosoft\Accesstory
 */
class AccesstoryServiceProvider extends ServiceProvider {

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
        $loader = AliasLoader::getInstance();
        $loader->alias('AccessStory', 'Samcrosoft\Accesstory\Facade\Facade');

        $this->publishes([
            __DIR__ . '/../../config/story.php' => config_path('story.php')
        ]);
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
        $this->mergeConfigFrom(
            __DIR__ . '/../../config/story.php', 'story'
        );

        $this->app->bind(Facade::FACADE_NAME, function(){
            return new AccessStory;
        });
	}


	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [];
	}

}

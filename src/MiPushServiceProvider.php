<?php namespace Hht\MiPush;

use Illuminate\Support\ServiceProvider;

class MiPushServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
            __DIR__ . '/config/mipush.php' => config_path('mipush.php'),
        ]);
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['mipush'] = $this->app->share(function () {
            return new MiPush();
        });
	}

	/**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['mipush'];
    }

}

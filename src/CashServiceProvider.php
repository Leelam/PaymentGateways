<?php namespace Leelam\PaymentGateway;

use \Illuminate\Support\Facades\Config;
use \Illuminate\Support\ServiceProvider;

class CashServiceProvider extends ServiceProvider
{

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
        $this->mergeConfigFrom(
            __DIR__ . '/config/cash-settings.php', 'cashConfig'
        );
        $gateway = Config::get('cashConfig.gateway');
        $this->app->bind('CashFacade', '\Leelam\PaymentGateway\Cash');
        $this->app->bind('\Leelam\PaymentGateway\Gateways\PaymentGatewayInterface', '\Leelam\PaymentGateway\Gateways\\' . $gateway . 'Gateway');


    }


    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/cash-settings.php' => base_path('config/cash-settings.php'),
            __DIR__ . '/views/middleware.blade.php' => base_path('app/Http/Middleware/VerifyCsrfMiddleware.php'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/views', 'cashConfig');


        // Configuring with main route file
        // Loading package view files directly from vendor directory as
        require __DIR__ . '/Http/routes.php';

        // Publishing packages views to /views
        /*$this->publishes([
            __DIR__ . '/views' => base_path('resources/views/comments'),
        ]);*/
        // Publishing config file to /config
        /*$this->publishes([
            __DIR__ . '/config' => config_path(),
        ]);*/
        // Publishing Migration File
        $this->publishes([
            __DIR__ . '/migrations' => $this->app->databasePath() . '/migrations'
        ], 'migrations');
        // Publishing seeds file
        /*$this->publishes([
            __DIR__ . '/seeds' => $this->app->databasePath() . '/seeds'
        ], 'seeds');*/


    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [

        ];
    }

}

<?php namespace Leelam\PaymentGateway;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class LeelamPaymentGatewayServiceProvider extends ServiceProvider {

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
        $gateway = Config::get('leelampaymentgateway.gateway');
        $this->app->bind('leelampaymentgateway', '\Leelam\PaymentGateway\LeelamPaymentGateway');

        $this->app->bind('\Leelam\PaymentGateway\Gateways\PaymentGatewayInterface','\Leelam\PaymentGateway\Gateways\\'.$gateway.'Gateway');
	}


    public function boot(){
        $this->publishes([
            __DIR__ . '/config/leelam/payment-gateways.php' => base_path('config/leelam/payment-gateways.php'),
            __DIR__.'/views/middleware.blade.php' => base_path('app/Http/Middleware/VerifyCsrfMiddleware.php'),
        ]);

		$this->loadViewsFrom(__DIR__.'/views', 'leelampaymentgateway');

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

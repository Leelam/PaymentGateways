<?php namespace Leelam\PaymentGateway\Facades;

use Illuminate\Support\Facades\Facade;

class LeelamPaymentGatewayFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'LeelamPaymentGatewayFacade';
    }

}
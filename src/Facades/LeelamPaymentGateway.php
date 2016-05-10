<?php namespace Leelam\PaymentGateway\Facades;

use Illuminate\Support\Facades\Facade;

class LeelamPaymentGateway extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'leelampaymentgateway';
    }

}
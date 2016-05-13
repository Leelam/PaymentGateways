<?php namespace Leelam\PaymentGateway\Facades;

use Illuminate\Support\Facades\Facade;

class CashFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'CashFacade';
    }

}
<?php
namespace Leelam\PaymentGateway\Contracts;

use Leelam\PaymentGateway\CashTransaction;

trait CashableTrait
{

    /**
     *
     * @return \Illuminate\Support\Collection
     */
    public function cashTransaction()
    {
        return $this->morphOne ( CashTransaction::class, 'cashable' );
        //return $this->morphMany(CashTransaction::class, 'cashable');
    }
}
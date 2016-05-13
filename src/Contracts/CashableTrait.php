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
        return $this->morphMany(CashTransaction::class, 'cashable');
    }
}
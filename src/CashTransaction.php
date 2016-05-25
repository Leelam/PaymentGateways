<?php
/**
 * Created by PhpStorm.
 * User: leelam
 * Date: 13/5/16
 * Time: 8:43 PM
 */

namespace Leelam\PaymentGateway;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CashTransaction extends Model
{
    use SoftDeletes;


    public $table = 'leelam_cash';

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'transaction_id',
        'cashable_id',
        'cashable_type',
        'amount',
        'response_data',
        'status',
        'service_provider',
        'ip',
        'user_id'
    ];

    /**
     *
     * @return mixed
     *
     */
    public function cashable()
    {
        return $this->morphTo();
    }

    /**
     *  The persion who has made the transaction
     *
     * @return mixed
     */
    public function user ()
    {
        return $this->hasOne ( User::class, 'id', 'user_id' );
    }

}
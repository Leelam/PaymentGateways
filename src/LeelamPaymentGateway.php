<?php namespace Leelam\PaymentGateway;

use Leelam\PaymentGateway\Gateways\PaymentGatewayInterface;

class LeelamPaymentGateway extends \Eloquent{

    protected $gateway;


    /**
     * The fields that are fillable
     *
     * @var array
     */
    protected $fillable = array(
        'response_data',
        'status',
        'transaction_id'
    );
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['id', 'updated_at', 'deleted_at'];


    /**
     * @param PaymentGatewayInterface $gateway
     */
    function __construct(PaymentGatewayInterface $gateway)
    {
        $this->gateway = $gateway;
    }

    public function purchase($parameters = array()){

        return $this->gateway->request($parameters)->send();

    }

    public function response($request)
    {
        return $this->gateway->response($request);
    }

    public function prepare($parameters = array())
    {
        return $this->gateway->request($parameters);
    }

    public function process($order)
    {
        return $order->send();
    }



}
<?php namespace Leelam\PaymentGateway\Gateways;

interface PaymentGatewayInterface {
    public function request($parameters);
    public function send();
    public function response($request);

    public function transactionId();

    public function serviceProvider();
}
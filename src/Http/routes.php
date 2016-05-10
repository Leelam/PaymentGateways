<?php

Route::post('leelampaymentgateway', ['as' => 'response', 'uses' => 'Leelam\PaymentGateway\LeelamPaymentGatewayController@status']);


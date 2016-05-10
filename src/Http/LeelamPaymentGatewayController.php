<?php

namespace Leelam\PaymentGateway\Http;

use Illuminate\Http\Request;
use Leelam\Http\Controllers\LeelamBaseController;
use Leelam\PaymentGateway\LeelamPaymentGateway;

class LeelamPaymentGatewayController extends LeelamBaseController
{

    public function status(Request $request)
    {
        $input = $request->all();
        return $input->status;
        // RUN SQL Quries HERE

        $input['transaction_id'] = $transaction_id;
        $input['status'] = 'initiated';
        $input['response_data'] = null;

        LeelamPaymentGateway::update();
    }

    public function makePayment(Request $request)
    {
        $input = $request->all();

        /* All Required Parameters by your Gateway */

        $time = time();
        $parameters = [
            'tid' => $time,
            'firstname' => $request->student_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'order_id' => $time,
            'amount' => $request->amount,
            'productinfo' => "$input[institution_id] payment by $input[student_name] for $input[payment_type]"
        ];

        $order = LeelamPaymentGateway::prepare($parameters);
        $transaction_id = $order->parameters['txnid'];
        $input['transaction_id'] = $transaction_id;
        $input['status'] = 'initiated';
        $input['response_data'] = null;

        LeelamPaymentGateway::create(
            $input
        );

        return LeelamPaymentGateway::process($order);
    }
}
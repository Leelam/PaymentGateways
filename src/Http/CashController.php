<?php

namespace Leelam\PaymentGateway\Http;

use Illuminate\Http\Request;
use Leelam\PaymentGateway\Facades\CashFacade;
use Leelam\PaymentGateway\Cash;

class CashController extends \Controller
{

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

        $order = CashFacade::prepare($parameters);
        $transaction_id = $order->parameters['txnid'];
        $input['transaction_id'] = $transaction_id;
        $input['status'] = 'initiated';
        $input['response_data'] = null;

        Cash::create(
            $input
        );

        return CashFacade::process($order);
    }


    public function cashResponse(Request $request)
    {
        $input = $request->all();
        return $input->status;
        // RUN SQL Quries HERE

        $input['transaction_id'] = $transaction_id;
        $input['status'] = 'initiated';
        $input['response_data'] = null;

        Cash::update();

        if ($input['status'] == 'failure') {

            return view('frontend.payments.unsuccessful');

        } elseif ($input['status'] == 'success') {

            return view('frontend.payments.thankyou');
        }
    }


}
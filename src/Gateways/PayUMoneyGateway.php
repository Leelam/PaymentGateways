<?php namespace Leelam\PaymentGateway\Gateways;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Leelam\PaymentGateway\Exceptions\CashParametersMissingException;

class PayUMoneyGateway implements PaymentGatewayInterface {

    protected $parameters = array(); // 
    protected $testMode = false;
    protected $merchantKey = '';
    protected $salt = '';
    protected $hash = '';
    protected $liveEndPoint = 'https://secure.payu.in/_payment';
    protected $testEndPoint = 'https://test.payu.in/_payment';
    public $response = '';

    function __construct()
    {
        $this->merchantKey = cashConfig('PayUMoney.merchantKey');
        $this->salt = cashConfig('PayUMoney.salt');
        $this->testMode = cashConfig('testMode');

        $this->parameters['key'] = $this->merchantKey;
        $this->parameters['txnid'] = $this->generateTransactionID();
        $this->parameters['surl'] = url(cashConfig('PayUMoney.successUrl'));
        $this->parameters['furl'] = url(cashConfig('PayUMoney.failureUrl'));
        $this->parameters['service_provider'] = 'payu_paisa';
    }

    public function getEndPoint()
    {
        return $this->testMode?$this->testEndPoint:$this->liveEndPoint;
    }

    public function request($parameters)
    {
        $this->parameters = array_merge($this->parameters,$parameters);

        $this->checkParameters($this->parameters);

        $this->encrypt();

        return $this;

    }

    /**
     * @return mixed
     */
    public function send()
    {

        Log::info('PayUMoney Payment Request Initiated: ');
        return View::make('cashConfig::payumoney')->with('hash', $this->hash)
            ->with('parameters', $this->parameters)
            ->with('endPoint', $this->getEndPoint());

    }


    /**
     * Check Response
     * @param $request
     * @return array
     */
    public function response($request)
    {
        $response = $request->all();

        $response_hash = $this->decrypt($response);

        if($response_hash!=$response['hash']){
            return 'Hash Mismatch Error';
        }

        return $response;
    }


    /**
     * @param $parameters
     * @throws CashParametersMissingException
     */
    public function checkParameters($parameters)
    {
        $validator = Validator::make($parameters, [
            'key' => 'required',
            'txnid' => 'required',
            'surl' => 'required|url',
            'furl' => 'required|url',
            'firstname' => 'required',
            // 'email' => 'required',
            //'phone' => 'required',
            'productinfo' => 'required',
            'service_provider' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            throw new CashParametersMissingException;
        }

    }

    /**
     * PayUMoney Encrypt Function
     *
     */
    protected function encrypt()
    {
        $this->hash = '';
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';

        foreach($hashVarsSeq as $hash_var) {
            $hash_string .= isset($this->parameters[$hash_var]) ? $this->parameters[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string .= $this->salt;
        $this->hash = strtolower(hash('sha512', $hash_string));
    }

    /**
     * PayUMoney Decrypt Function
     *
     * @param $response
     * @return string
     * @internal param $plainText
     * @internal param $key
     */
    protected function decrypt($response)
    {

        $hashSequence = "status||||||udf5|udf4|udf3|udf2|udf1|email|firstname|productinfo|amount|txnid|key";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = $this->salt."|";

        foreach($hashVarsSeq as $hash_var) {
            $hash_string .= isset($response[$hash_var]) ? $response[$hash_var] : '';
            $hash_string .= '|';
        }

        $hash_string = trim($hash_string,'|');

        return strtolower(hash('sha512', $hash_string));
    }

    public function generateTransactionID()
    {
        return substr ( hash ( 'sha256', mt_rand () . microtime () ), 0, 10 );
    }


    public function transactionId()
    {
        return $this->parameters['txnid'];
    }


    public function serviceProvider()
    {
        return $this->parameters['service_provider'];
    }
}
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Indipay Service Config
    |--------------------------------------------------------------------------
    |   gateway = CCAvenue / PayUMoney / EBS / Citrus / InstaMojo
    |   view    = File
    */

    
    'gateway' => 'PayUMoney',                // Replace with the name of appropriate gateway

    'testMode' => false,                   // True for Testing the Gateway [For production false]

    'CCAvenue' => [                         // CCAvenue Parameters
        'merchantId'  => env('INDIPAY_MERCHANT_ID', ''),
        'accessCode'  => env('INDIPAY_ACCESS_CODE', ''),
        'workingKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
        'redirectUrl' => env('INDIPAY_REDIRECT_URL', 'leelam/payments'),
        'cancelUrl' => env('INDIPAY_CANCEL_URL', 'leelam/payments'),

        'currency' => env('INDIPAY_CURRENCY', 'INR'),
        'language' => env('INDIPAY_LANGUAGE', 'EN'),
    ],

    'PayUMoney' => [                         // PayUMoney Parameters
        'merchantKey'  => env('INDIPAY_MERCHANT_KEY', ''),
        'salt'  => env('INDIPAY_SALT', ''),
        'workingKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
        'successUrl' => env('INDIPAY_SUCCESS_URL', 'leelam/payments'),
        'failureUrl' => env('INDIPAY_FAILURE_URL', 'leelam/payments'),
    ],

    'EBS' => [                         // EBS Parameters
        'account_id'  => env('INDIPAY_MERCHANT_ID', ''),
        'secretKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
        'return_url' => env('INDIPAY_SUCCESS_URL', 'leelam/payments'),
    ],

    'Citrus' => [                         // Citrus Parameters
        'vanityUrl'  => env('INDIPAY_CITRUS_VANITY_URL', ''),
        'secretKey' => env('INDIPAY_WORKING_KEY', ''),

        // Should be route address for url() function
        'returnUrl' => env('INDIPAY_SUCCESS_URL', 'leelam/payments'),
        'notifyUrl' => env('INDIPAY_SUCCESS_URL', 'leelam/payments'),
    ],

    'InstaMojo' => [
        'api_key' => env('INSTAMOJO_API_KEY',''),
        'auth_token' => env('INSTAMOJO_AUTH_TOKEN',''),
        'redirectUrl' => env('INDIPAY_REDIRECT_URL', 'leelam/payments'),
    ],
    
    /*
     * Afte sending encryped data to any payment gate, it return the data as responce, to handle that
     * 
     * You should disable this route from check for CSRF.
     * 
     * */
    'remove_csrf_check' => [
        'leelam/payments'
    ],





];

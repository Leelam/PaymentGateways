<?php

/*
 * Helper function
 * */

function leelamPaymentGatewayConfig($key)
{

    return Config::get('leelamPaymentGatewayConfig.' . $key);
}
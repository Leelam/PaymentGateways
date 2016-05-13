<?php

/*
 * Helper function
 * */

function cashConfig($key)
{

    return Config::get('cashConfig.' . $key);
}
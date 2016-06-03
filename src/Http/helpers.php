<?php


    function cashConfig ( $key )
    {

        return Config::get ( 'cashConfig.' . $key );
    }

    /**
     *  Converting string to readable
     *  89ccb3f661 to 89C-CB3-F661
     * @param $transactionId
     * @return string
     */
    function readableTransactionId ( $transactionId )
    {
        return strtoupper ( substr ( chunk_split ( $transactionId, 3, '-' ), 0, -3 ) . substr ( $transactionId, 9, 1 ) );

    }

    /**
     *  Reversing the readable tromg
     *  89C-CB3-F661 to 89ccb3f661
     * @param $transactionId
     * @return string
     */
    function cleanTransactionId ( $transactionId )
    {

        return strtolower ( str_replace ( "-", "", $transactionId ) );

    }
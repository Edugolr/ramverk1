<?php

namespace Chai17\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * Helper to create a navbar for sites by reading its configuration from file
 * and then applying some code while rendering the resultning navbar.
 *
 */
class Curl
{

    function cUrl($url, $ip, $key, $extra="")
    {
        $ch=curl_init($url.$ip.'?access_key='.$key.$extra.'');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        return $json;
    }
}

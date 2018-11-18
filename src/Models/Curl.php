<?php

namespace Chai17\Models;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

class Curl
{

    public function cUrl($url, $ipNumber, $key, $extra = "")
    {
        $result = curl_init($url. $ipNumber. '?access_key='. $key. $extra. '');
        curl_setopt($result, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($result);
        curl_close($result);
        return $json;
    }
}

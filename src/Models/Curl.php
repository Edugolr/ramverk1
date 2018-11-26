<?php

namespace Chai17\Models;

class Curl
{

    public function cUrl($url)
    {
        $result = curl_init($url);
        curl_setopt($result, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($result);
        curl_close($result);
        return $json;
    }

    public function cUrlMulti(array $url)
    {
        $chandle= [];
        $mhandle = curl_multi_init();
        for ($i=0; $i < count($url); $i++) {
            array_push($chandle, curl_init($url[$i]));
            curl_setopt($chandle[$i], CURLOPT_RETURNTRANSFER, true);
            curl_multi_add_handle($mhandle, $chandle[$i]);
        }

        $running = null;
        do {
            curl_multi_exec($mhandle, $running);
        } while ($running);

        //close the handles
        for ($i=0; $i < count($chandle); $i++) {
            curl_multi_remove_handle($mhandle, $chandle[$i]);
        }

        curl_multi_close($mhandle);

        $json = [];
        for ($i=0; $i < count($chandle); $i++) {
            array_push($json, curl_multi_getcontent($chandle[$i]));
        }
        return $json;
    }
}

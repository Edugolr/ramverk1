<?php

namespace Chai17\Models;

class ValidateIP
{
    public function validate($ipNumber)
    {
        $result = [];
        if (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            $result = [true, "IPV6", $ipNumber];
        } elseif (filter_var($ipNumber, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $result = [true, "IPV4", $ipNumber];
        } else {
            $result = [false, "IPV6", $ipNumber];
        }
        return $result;
    }
}

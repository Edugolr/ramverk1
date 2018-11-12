<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip validator.",
            "mount" => "ipvalidate",
            "handler" => "\Chai17\Ipvalidator\IpvalidatorController",
        ],
    ]
];

<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip validator Json.",
            "mount" => "ipvalidatejson",
            "handler" => "\Chai17\IpvalidatorJson\IpValidatorJsonController",
        ],
    ]
];

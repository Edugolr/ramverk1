<?php
/**
 * Load the ipvalidator as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Ip validator.",
            "mount" => "ipvalidate",
            "handler" => "\Anax\Controller\IpvalidatorController",
        ],
    ]
];

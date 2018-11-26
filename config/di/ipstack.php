<?php
/**
 * Config file for url.
 */
return [
    "services" => [
        "ipstack" => [
            "shared" => true,
            "callback" => function () {
                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("ipstack.php");

                return $config;
            }
        ]
    ]
];

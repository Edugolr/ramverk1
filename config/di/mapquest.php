<?php
/**
 * Config file for url.
 */
return [
    "services" => [
        "mapquest" => [
            "shared" => true,
            "callback" => function () {
                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("mapquest.php");

                return $config;
            }
        ]
    ]
];

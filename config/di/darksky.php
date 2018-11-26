<?php
/**
 * Config file for url.
 */
return [
    "services" => [
        "darksky" => [
            "shared" => true,
            "callback" => function () {
                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("darksky.php");

                return $config;
            }
        ]
    ]
];

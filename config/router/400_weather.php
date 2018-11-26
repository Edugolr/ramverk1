<?php
/**
 * Load the weather as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather forecast",
            "mount" => "weather",
            "handler" => "\Anax\Controller\WeatherController",
        ],
    ]
];

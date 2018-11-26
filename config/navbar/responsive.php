<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Hem",
            "url" => "",
            "title" => "Första sidan, börja här.",
        ],
        [
            "text" => "Redovisning",
            "url" => "redovisning",
            "title" => "Redovisningstexter från kursmomenten.",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Kmom01",
                        "url" => "redovisning/kmom01",
                        "title" => "Redovisning för kmom01.",
                    ],
                    [
                        "text" => "Kmom02",
                        "url" => "redovisning/kmom02",
                        "title" => "Redovisning för kmom02.",
                    ],
                ],
            ],
        ],
        [
            "text" => "Om",
            "url" => "om",
            "title" => "Om denna webbplats.",
        ],
        [
            "text" => "Styleväljare",
            "url" => "style",
            "title" => "Välj stylesheet.",
        ],
        [
            "text" => "Verktyg",
            "url" => "verktyg",
            "title" => "Verktyg och möjligheter för utveckling.",
        ],
        [
            "text" => "Väder",
            "url" => "weather",
            "title" => "Väder prognoser",
        ],
        [
            "text" => "REST API",
            "url" => "api",
            "title" => "REST API dokumentation",
        ],
        [
            "text" => "Ip-validator",
            "url" => "ipvalidate",
            "title" => "Ip validator",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Standard",
                        "url" => "ipvalidate",
                        "title" => "Ipvalidate",
                    ],
                    [
                        "text" => "Json",
                        "url" => "ipvalidatejson",
                        "title" => "Ipvalidate Json",
                    ],
                ],
            ],
        ],
    ],
];

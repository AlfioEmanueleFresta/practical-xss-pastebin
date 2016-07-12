<?php

// TODO: Possibly load the configuration from a .ini/.json file?

$conf = [

    "title"     =>  "Request Bin",
    "about_url" =>  "https://www.cs.york.ac.uk/cyber-practicals/",

    "database"  => [
        "dsn"       =>  "sqlite:/tmp/requests.sqlite",
        "username"  =>  null,
        "password"  =>  null,
        "options"   =>  [
            "persistent" => true
        ],
    ],

    "requests_show_no"      =>  20,     // How many requests to show.
    "requests_auto_cleanup" =>  true,   // If true, delete all other requests automatically.

];

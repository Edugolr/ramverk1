<?php
/**
 * Config file for Database.
 *
 * Example for MySQL.
 *  "dsn" => "mysql:host=localhost;dbname=test;",
 *  "username" => "test",
 *  "password" => "test",
 *  "driver_options"  => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"],
 *
 * Example for SQLite.
 *  "dsn" => "sqlite:memory::",
 *
 */
 if ($_SERVER["SERVER_NAME"] === "www.student.bth.se") {
     return [
         "dsn"             => "mysql:host=blu-ray.student.bth.se;dbname=chai17;",
         "username"        => "chai17",
         "password"        => "GgTpjvnJMidk",
         "driver_options"  => [
             \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'"
         ],
         "fetch_mode"      => \PDO::FETCH_OBJ,
         "table_prefix"    => null,
         "session_key"     => "Anax\Database",

         // True to be very verbose during development
         "verbose"         => false,

         // True to be verbose on connection failed
         "debug_connect"   => true,
     ];
 }
return [
    "dsn"             => "sqlite:" . ANAX_INSTALL_PATH . "/data/db.sqlite",
    "username"        => null,
    "password"        => null,
    "driver_options"  => null,
    "fetch_mode"      => \PDO::FETCH_OBJ,
    "table_prefix"    => null,
    "session_key"     => "Anax\Database",

    // True to be very verbose during development
    "verbose"         => null,

    // True to be verbose on connection failed
    "debug_connect"   => false,
];

<?php 

define("URL","http://localhost/treinamento");

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "192.168.2.50",
    "port" => "3306",
    "dbname" => "ccb",
    "username" => "ccb",
    "passwd" => "ccb@9851",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];
<?php 


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

function getUrlSistema()
{
    $url = sprintf(
        "%s://%s%s",
        isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
        $_SERVER['SERVER_NAME'],
        $_SERVER['CONTEXT_PREFIX']
    );

    return $url;
}
define("URL", getUrlSistema()."/treinamento");
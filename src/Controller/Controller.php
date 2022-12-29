<?php

namespace APP\Controller;

use League\Plates\Engine;
use WEBLibs\Secure\AuthJWTV2;

class Controller
{

    protected $templates;
    protected $router;
    protected $code = 200;
    protected $message = "";
    protected $isError =  false;

    public function __construct($router, string $auxDir = '')
    {
        $this->router = $router;
        $this->templates = new Engine(__DIR__ . '/../../view' . $auxDir);
    }
    public function getMessage()
    {
        http_response_code($this->code);
        echo json_encode(
            [
                "code" => $this->code,
                "message" => $this->message,
                "isError" => $this->isError
            ]
        );
    }
}

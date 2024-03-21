<?php
namespace APP\Model;

use CoffeeCode\DataLayer\DataLayer;


class EventoModel extends DataLayer{

    public function __construct()
    {
        parent::__construct("evento", ["dia","hora","servico","comum","atendente"],"id", false);
    }

}
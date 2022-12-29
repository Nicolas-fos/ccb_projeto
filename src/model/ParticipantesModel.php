<?php
namespace APP\Model;

use CoffeeCode\DataLayer\DataLayer;


class ParticipantesModel extends DataLayer{

    public function __construct()
    {
        parent::__construct("participantes", ["nome"],"id", false);
    }

}
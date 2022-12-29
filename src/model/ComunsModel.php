<?php
namespace APP\Model;

use CoffeeCode\DataLayer\DataLayer;


class ComunsModel extends DataLayer{

    public function __construct()
    {
        parent::__construct("comum", ["nome","cidade"],"id", false);
    }

}
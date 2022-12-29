<?php
namespace APP\Model;

use CoffeeCode\DataLayer\DataLayer;


class CidadeModel extends DataLayer{

    public function __construct()
    {
        parent::__construct("cidade", ["nome"],"id", false);
    }

}
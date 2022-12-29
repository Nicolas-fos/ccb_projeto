<?php
namespace APP\Model;

use CoffeeCode\DataLayer\DataLayer;


class ServicosModel extends DataLayer{

    public function __construct()
    {
        parent::__construct("servicos", ["nome"],"id", false);
    }

}
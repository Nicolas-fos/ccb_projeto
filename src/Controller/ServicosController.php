<?php

namespace APP\Controller;
use APP\Model\ServicosModel;
use APP\Controller\Controller;

class ServicosController extends Controller
{

    private $modelServicos;
   

    public function __construct($router)
    {
        parent::__construct($router);

        $this->modelServicos = new ServicosModel();
     
    }

    public function lista()
    {
        header('Content-Type: application/json; charset=utf-8');
        $listaServicos= [];
        foreach ($this->modelServicos->find()->fetch(true) as $key => $item) {
            array_push($listaServicos, $item->data);
        }

        echo json_encode($listaServicos);
    }

    public function listaById($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $link = $this->modelServicos->findById($data['id'])->data();
        echo json_encode($link);
       
    }
}
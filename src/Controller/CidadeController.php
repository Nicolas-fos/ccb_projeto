<?php
namespace APP\Controller;


use APP\Model\CidadeModel;
use APP\Controller\Controller;

class CidadeController extends Controller
{

    private $modelCidade;
   

    public function __construct($router)
    {
        parent::__construct($router);

        $this->modelCidade = new CidadeModel();
     
    }

    public function lista()
    {
        header('Content-Type: application/json; charset=utf-8');
        $listaCidade= [];
        foreach ($this->modelCidade->find()->fetch(true) as $key => $item) {
            array_push($listaCidade, $item->data);
        }

        echo json_encode($listaCidade);
    }

    public function listaById($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $link = $this->modelCidade->findById($data['id'])->data();
        echo json_encode($link);
       
    }
}
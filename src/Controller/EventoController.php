<?php
namespace APP\Controller;


use APP\Model\EventoModel;
use APP\Controller\Controller;

class EventoController extends Controller
{

    private $modelEvento;
   

    public function __construct($router)
    {
        parent::__construct($router);

        $this->modelEvento = new EventoModel();
     
    }


    public function salvar($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $request = $_POST;

        $this->modelEvento->id = $request['id'];
        $this->modelEvento->nome = $request['nome'];
        $this->modelEvento->save();

        $this->message = "Registro salvo com sucesso!";

        if ($this->modelEvento->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelEvento->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function excluir($data)
    {
        header('Content-Type: application/json; charset=utf-8');

        $links = $this->modelEvento->findById($data['id']);

        $links->destroy();
        $this->message = 'Registro excluido com sucesso';

        if ($this->modelEvento->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelEvento->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function lista()
    {
        header('Content-Type: application/json; charset=utf-8');
        $listaEvento= [];
        foreach ($this->modelEvento->find()->fetch(true) as $key => $item) {
            array_push($listaEvento, $item->data);
        }

        echo json_encode($listaEvento);
    }

    public function listaById($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $link = $this->modelEvento->findById($data['id'])->data();
        echo json_encode($link);
       
    }
}
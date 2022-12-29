<?php

namespace APP\Controller;
use APP\Controller\Controller;
use APP\Model\ParticipantesModel;

class ParticipantesController extends Controller
{

    private $modelParticipantes;
   

    public function __construct($router)
    {
        parent::__construct($router);

        $this->modelParticipantes = new ParticipantesModel();
     
    }


    public function salvar($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $request = $_POST;

        $this->modelParticipantes->id = $request['id'];
        $this->modelParticipantes->nome = $request['nome'];
        $this->modelParticipantes->save();

        $this->message = "Registro salvo com sucesso!";

        if ($this->modelParticipantes->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelParticipantes->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function excluir($data)
    {
        header('Content-Type: application/json; charset=utf-8');

        $links = $this->modelParticipantes->findById($data['id']);

        $links->destroy();
        $this->message = 'Registro excluido com sucesso';

        if ($this->modelParticipantes->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelParticipantes->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function lista()
    {
        header('Content-Type: application/json; charset=utf-8');
        $listaParticipantes= [];
        foreach ($this->modelParticipanes->find()->fetch(true) as $key => $item) {
            array_push($listaParticipantes, $item->data);
        }

        echo json_encode($listaParticipantes);
    }

    public function listaById($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $link = $this->modelParticipantes->findById($data['id'])->data();
        echo json_encode($link);
       
    }
}
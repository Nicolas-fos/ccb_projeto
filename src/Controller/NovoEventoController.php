<?php

namespace APP\Controller;

use APP\Model\ComunsModel;
use APP\Model\EventoModel;
use APP\Model\ServicosModel;
use APP\Controller\Controller;
use APP\Model\ParticipantesModel;

class NovoEventoController extends Controller
{

    private $modelNovoEvento;


    public function __construct($router)
    {
        parent::__construct($router);

        $this->modelNovoEvento = new EventoModel();
    }
    public function index(): void
    {
        $comunsModel = new ComunsModel();
        $listComuns = $comunsModel->find()->order("nome asc")->fetch(true);

        $participantesModel = new ParticipantesModel();
        $listParticipantes = $participantesModel->find()->order("nome asc")->fetch(true);

        $servicosModel = new ServicosModel();
        $listServicos = $servicosModel->find()->order("nome asc")->fetch(true);

        echo $this->templates->render('novo_evento', ['listComuns' => $listComuns, 'listParticipantes' => $listParticipantes, 'listServicos' => $listServicos]);
    }


    public function salvar($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $request = $_POST;

        $this->modelNovoEvento->id = $request['id'];
        $this->modelNovoEvento->dia = $request['dia'];
        $this->modelNovoEvento->hora = $request['hora'];
        $this->modelNovoEvento->servico = $request['servico'];
        $this->modelNovoEvento->comum = $request['comum'];
        $this->modelNovoEvento->atendente = $request['atendente'];
        $this->modelNovoEvento->save();

        $this->message = "Registro salvo com sucesso!";

        if ($this->modelNovoEvento->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelNovoEvento->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function excluir($data)
    {
        header('Content-Type: application/json; charset=utf-8');

        $links = $this->modelNovoEvento->findById($data['id']);

        $links->destroy();
        $this->message = 'Registro excluido com sucesso';

        if ($this->modelNovoEvento->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelNovoEvento->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function lista()
    {
        header('Content-Type: application/json; charset=utf-8');
        $listaParticipantes = [];
        foreach ($this->modelParticipanes->find()->fetch(true) as $key => $item) {
            array_push($listaParticipantes, $item->data);
        }

        echo json_encode($listaParticipantes);
    }

    public function listaById($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $link = $this->modelNovoEvento->findById($data['id'])->data();
        echo json_encode($link);
    }


    public function eventos()
    {

        $eventoModel = new EventoModel();
        $listEvento = $eventoModel->find()->order("id asc")->fetch(true);

        $eventos = [];
        foreach ($listEvento as $key => $item) {
            # code...
            
            $id = $item->id;
            $dia= $item->dia;
            $hora = $item->hora;
            $servico = $item->servico;
            $comum = $item->comum;
            $atendente = $item->atendente;
         
            $eventos[] = [
            'id' => $id,
            'start' => $dia,
            'hora' => $hora,
            'title' => $servico,
            'comum' => $comum,
            'atendente' => $atendente
        ];
    }


        echo json_encode($eventos);
    }
}

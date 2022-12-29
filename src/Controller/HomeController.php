<?php

namespace APP\Controller;

use APP\Model\CidadeModel;
use APP\Model\EventoModel;
use APP\Controller\Controller;

class HomeController extends Controller
{

    public function __construct($router)
    {
        parent::__construct($router);
    }

    public function index(): void
    {

        $eventoModel = new EventoModel();
        $listEvento = $eventoModel->find()->order("dia asc")->fetch(true);
        echo $this->templates->render('inicio', ['listEvento' => $listEvento]);
    }

   

    /**
     * Pagina erro
     *
     * @param array $data
     * @return void
     */
    public function error(array $data): void
    {
        // $this->isTokenValido($this->token);
        echo $this->templates->render('ops', ['error' => $data['error']]);
    }
}

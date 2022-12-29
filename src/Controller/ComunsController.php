<?php
namespace APP\Controller;


use APP\Model\CidadeModel;

use APP\Model\ComunsModel;
use APP\Controller\Controller;

class ComunsController extends Controller
{

    private $modelComuns;
   

    public function __construct($router)
    {
        parent::__construct($router);

        $this->modelComuns = new ComunsModel();
     
    }
    public function index(): void
    {
        $cidadeModel = new CidadeModel();
        $listCidade = $cidadeModel->find()->order("nome asc")->fetch(true);
        echo $this->templates->render('nova_comum', ['listCidade' => $listCidade]);
    }

    public function salvar($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $request = $_POST;

        $this->modelComuns->id = $request['id'];
        $this->modelComuns->nome = $request['nome'];
        $this->modelComuns->cidade = $request['cidade'];
        $this->modelComuns->endereco = $request['endereco'];
        $this->modelComuns->save();

        $this->message = "Comum salva com sucesso!";

        if ($this->modelComuns->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelComuns->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function excluir($data)
    {
        header('Content-Type: application/json; charset=utf-8');

        $links = $this->modelComuns->findById($data['id']);

        $links->destroy();
        $this->message = 'Registro excluido com sucesso';

        if ($this->modelComuns->fail()) {
            $this->isError = true;
            $this->code = 400;
            $this->message = $this->modelComuns->fail()->getMessage();
        }

        $this->getMessage();
    }

    public function lista()
    {
        header('Content-Type: application/json; charset=utf-8');
        $listaComuns= [];
        foreach ($this->modelComuns->find()->fetch(true) as $key => $item) {
            array_push($listaComuns, $item->data);
        }

        echo json_encode($listaComuns);
    }

    public function listaById($data)
    {
        header('Content-Type: application/json; charset=utf-8');
        $link = $this->modelComuns->findById($data['id'])->data();
        echo json_encode($link);
       
    }
}
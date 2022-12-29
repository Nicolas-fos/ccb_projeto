<?php include "src/config.php";

use APP\Model\EventoModel;


$eventoModel = new EventoModel();
$listEvento = $eventoModel->find()->order("id asc")->fetch(true);


$id = $listEvento['id'];
$data = $listEvento['dia'];
$hora = $listEvento['hora'];
$servico = $listEvento['servico'];
$comum = $listEvento['comum'];
$atendente = $listEvento['atendente'];

$eventos = [];

$eventos[]=[
  'id'=> $id,
  'start'=>$data,
  'time'=>$hora,
  'title'=>$servico,
  'comum'=>$comum,
  'atendente'=>$atendente
];


echo json_encode($eventos);

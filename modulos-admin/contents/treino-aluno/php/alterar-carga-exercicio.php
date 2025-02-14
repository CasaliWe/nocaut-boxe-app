<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$id = $_POST['id'];
$uid = $_POST['uid'];
$carga = $_POST['carga'];

$dados = [
    'carga' => $carga,
];

$res = GrupoTreinoRepository::updateCarga($dados, $id);

if(!$res){
    header('Location: ../../../../treino-aluno.php?uid=' . $uid . '&error=true');
    exit;
}else{
    header('Location: ../../../../treino-aluno.php?uid=' . $uid . '&success=true');
    exit;
}


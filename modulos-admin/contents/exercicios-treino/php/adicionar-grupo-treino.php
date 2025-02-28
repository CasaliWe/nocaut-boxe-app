<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$id_treino = $_POST['id'];
$grupo_id = $_POST['grupo'];
$identificador_bloco = $_POST['identificador-bloco'];

$res = GrupoTreinoRepository::create($id_treino, $grupo_id, $identificador_bloco);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?id=' . $id_treino . '&error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?id=' . $id_treino . '&create=true');
    exit;
}


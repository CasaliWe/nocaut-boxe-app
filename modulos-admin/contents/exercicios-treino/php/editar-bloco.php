<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$identificador = $_POST['id-bloco-editar'];
$retorno = $_POST['id-retorno-editar'];
$nome = $_POST['identificador-editar'];


$res = GrupoTreinoRepository::updateBloco($identificador, $nome);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?error=true&id='.$retorno);
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?delete=true&id='.$retorno);;
    exit;
}


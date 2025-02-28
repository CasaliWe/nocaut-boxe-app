<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$identificador = $_POST['identificador'];
$retorno = $_POST['retorno'];


$res = GrupoTreinoRepository::deletarBloco($identificador);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?error=true&id='.$retorno);
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?delete=true&id='.$retorno);;
    exit;
}


<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$idDeletar = $_GET['id'];
$idRetornoPagina = $_GET['id-treino'];

$res = GrupoTreinoRepository::deleteExercicioCompleto($idDeletar);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?error=true&id='.$idRetornoPagina);
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?delete=true&id='.$idRetornoPagina);;
    exit;
}


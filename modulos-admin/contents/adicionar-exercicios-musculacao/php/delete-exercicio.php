<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ExerciciosRepository;

$id = $_GET['id'];
$gif = $_GET['gif'];

$res = ExerciciosRepository::deleteExercicio($id);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?error=true');
    exit;
}else{
    $filePathDesk = __DIR__ . '/../../../../assets/imagens/arquivos/gifs-musculacao/' . $gif;
    if (file_exists($filePathDesk)) {
        unlink($filePathDesk);
    }
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?delete=true');
    exit;
}


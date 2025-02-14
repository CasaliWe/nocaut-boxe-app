<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ExerciciosRepository;

$id = $_POST['id'];

$res = ExerciciosRepository::delete($id);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?delete=true');
    exit;
}


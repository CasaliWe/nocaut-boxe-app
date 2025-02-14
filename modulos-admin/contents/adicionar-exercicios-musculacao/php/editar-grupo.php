<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ExerciciosRepository;

$id = $_POST['id'];
$nome = $_POST['nome'];

$res = ExerciciosRepository::update($nome, $id);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?success=true');
    exit;
}


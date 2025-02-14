<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ExerciciosRepository;

$nome = $_POST['nome'];

$res = ExerciciosRepository::create($nome);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/adicionar-exercicios-musculacao.php?create=true');
    exit;
}


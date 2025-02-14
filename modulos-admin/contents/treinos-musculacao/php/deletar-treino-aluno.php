<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AlunoTreinoMusculacaoRepository;

$id = $_GET['id'];


$res = AlunoTreinoMusculacaoRepository::deleteTreino($id);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/treinos-musculacao.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/treinos-musculacao.php?delete=true');
    exit;
}


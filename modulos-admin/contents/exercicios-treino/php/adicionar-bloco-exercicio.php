<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$aluno_treino_id = $_POST['aluno_treino_id'];
$nome_bloco = $_POST['nome-bloco'];
$identificador = bin2hex(random_bytes(8));

$data = [
    'identificador' => $identificador,
    'aluno_treino_id' => $aluno_treino_id,
    'nome_bloco' => $nome_bloco
];

$res = GrupoTreinoRepository::createBloco($data);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?id=' . $aluno_treino_id . '&error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?id=' . $aluno_treino_id . '&create=true');
    exit;
}


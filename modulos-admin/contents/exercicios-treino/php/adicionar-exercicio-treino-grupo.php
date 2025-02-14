<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\GrupoTreinoRepository;

$id = $_POST['id'];
$aluno_treino_id = $_POST['aluno_treino_id'];
$exercicio = $_POST['exercicio'];
$carga = $_POST['carga'];
$serie_rep = $_POST['serie_rep'];

$data = [
    'exercicio' => $exercicio,
    'carga' => $carga,
    'serie_rep' => $serie_rep,
    'id_grupo_treino' => $id,
];

$res = GrupoTreinoRepository::createExercicioGrupo($data);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?id=' . $aluno_treino_id . '&error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/exercicios-treino.php?id=' . $aluno_treino_id . '&create=true');
    exit;
}


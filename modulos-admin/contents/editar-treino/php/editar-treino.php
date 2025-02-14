<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AlunoTreinoMusculacaoRepository;

$id = $_POST['id'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo-treino'];
$duracao = $_POST['duracao'];
$regenerativo = $_POST['regenerativo'];
$modo_treino = $_POST['modo_treino'];
$intervalo = $_POST['intervalo'];

$dados = [
    'nome_aluno' => $nome,
    'tipo_treino' => $tipo,
    'duracao_treino' => $duracao,
    'regenerativo' => $regenerativo,
    'modo_treino' => $modo_treino,
    'intervalo' => $intervalo
];

$res = AlunoTreinoMusculacaoRepository::updateTreinoAluno($dados, $id);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/editar-treino.php?id=' . $id . '&error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/editar-treino.php?id=' . $id . '&success=true');
    exit;
}


<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AlunoTreinoMusculacaoRepository;

$nome = $_POST['nome-aluno'];
$tipo = $_POST['tipo-treino'];
$duracao = $_POST['duracao-treino'];
$regenerativo = $_POST['regenerativo'];
$modo_treino = $_POST['modo_treino'];
$intervalo = $_POST['intervalo'];
$uid = bin2hex(random_bytes(4));

$dados = [
    'uid' => $uid,
    'nome_aluno' => $nome,
    'tipo_treino' => $tipo,
    'duracao_treino' => $duracao,
    'regenerativo' => $regenerativo,
    'modo_treino' => $modo_treino,
    'intervalo' => $intervalo
];

$res = AlunoTreinoMusculacaoRepository::create($dados);

if(!$res){
    header('Location: ../../../../pages/treinos-musculacao/treinos-musculacao.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/treinos-musculacao/treinos-musculacao.php?create=true');
    exit;
}


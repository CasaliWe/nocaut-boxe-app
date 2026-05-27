<?php

require __DIR__ . '/../../../../config/config.php';
require __DIR__ . '/aluno-form-data.php';

use Repositories\AlunoRepository;
use Repositories\AlunoSolicitacaoRepository;

$idSolicitacao = $_POST['id-solicitacao-aluno'] ?? null;
$solicitacao = $idSolicitacao ? AlunoSolicitacaoRepository::getById($idSolicitacao) : null;
$data = dadosAlunoPost();

if(!$solicitacao || $solicitacao['status'] !== 'pendente' || !$data){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}

$res = AlunoRepository::create($data);

if(!$res){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}

AlunoSolicitacaoRepository::aprovar($idSolicitacao);

header('Location: ../../../../pages/alunos/alunos.php?create=true');
exit;

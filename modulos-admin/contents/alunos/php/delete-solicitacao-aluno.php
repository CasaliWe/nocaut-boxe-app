<?php

require __DIR__ . '/../../../../config/config.php';

use Repositories\AlunoSolicitacaoRepository;

$id = $_POST['id-solicitacao-aluno'] ?? null;

if(!$id){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}

$res = AlunoSolicitacaoRepository::delete($id);

if(!$res){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/alunos/alunos.php?delete=true');
    exit;
}

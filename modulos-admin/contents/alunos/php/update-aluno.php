<?php

require __DIR__ . '/../../../../config/config.php';
require __DIR__ . '/aluno-form-data.php';

use Repositories\AlunoRepository;

$id = $_POST['id-aluno'] ?? null;
$data = dadosAlunoPost();

if(!$id || !$data){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}

$res = AlunoRepository::update($data, $id);

if(!$res){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/alunos/alunos.php?success=true');
    exit;
}

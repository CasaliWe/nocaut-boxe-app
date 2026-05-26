<?php

require __DIR__ . '/../../../../config/config.php';
require __DIR__ . '/aluno-form-data.php';

use Repositories\AlunoRepository;

$data = dadosAlunoPost();

if(!$data){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}

$res = AlunoRepository::create($data);

if(!$res){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/alunos/alunos.php?create=true');
    exit;
}

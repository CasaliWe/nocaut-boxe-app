<?php

require __DIR__ . '/../../../../config/config.php';

use Repositories\AlunoRepository;

$id = $_POST['id-aluno'] ?? null;

if(!$id){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}

$res = AlunoRepository::delete($id);

if(!$res){
    header('Location: ../../../../pages/alunos/alunos.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/alunos/alunos.php?delete=true');
    exit;
}

<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AdminsRepository;

$nome = $_POST['nome'];
$tipo = $_POST['tipo'];
$login = $_POST['login'];
$senha = $_POST['senha'];


$data = [
    'nome' => $nome,
    'tipo' => $tipo,
    'login' => $login,
    'senha' => $senha,
];

$res = AdminsRepository::create($data);

if(!$res){
    header('Location: ../../../../pages/auth/usuarios-admin.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/auth/usuarios-admin.php?create=true');
    exit;
}


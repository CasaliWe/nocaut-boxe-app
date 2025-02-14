<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AdminsRepository;

$id = $_POST['id-user'];
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

$res = AdminsRepository::update($data, $id);

if(!$res){
    header('Location: ../../../../pages/auth/usuarios-admin.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/auth/usuarios-admin.php?success=true');
    exit;
}


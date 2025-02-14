<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AdminsRepository;

$id = $_POST['id-user'];

$res = AdminsRepository::delete($id);

if(!$res){
    header('Location: ../../../../pages/auth/usuarios-admin.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/auth/usuarios-admin.php?delete=true');
    exit;
}


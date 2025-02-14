<?php

session_start();

require '../../../config/config.php';
use Repositories\AdminsRepository;

$loginInput = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_SPECIAL_CHARS);
$senhaInput = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // buscando admins no banco
    $dadosLogin = AdminsRepository::getAdmins();

    foreach ($dadosLogin as $login) {
        // testando login
        if($loginInput == $login['login'] && $senhaInput == $login['senha']){
            $_SESSION['login'] = true;
            $_SESSION['nome-user'] = $login['nome'];
            $_SESSION['tipo-user'] = $login['tipo'];
            header("Location: ../../../pages/treinos-musculacao/treinos-musculacao.php");
            exit;
        }
    }

    // caso não encontre o login
    $_SESSION['erro-login'] = true;
    header("Location: ../../../pages/auth/login.php");
    exit;
}

?>

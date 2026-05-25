<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ServicoValorRepository;

$id = $_POST['id-servico-valor'] ?? null;

if(!$id){
    header('Location: ../../../../pages/configuracoes/configuracoes.php?error=true');
    exit;
}

$res = ServicoValorRepository::delete($id);

if(!$res){
    header('Location: ../../../../pages/configuracoes/configuracoes.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/configuracoes/configuracoes.php?delete=true');
    exit;
}

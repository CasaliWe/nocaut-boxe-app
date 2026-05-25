<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\ServicoValorRepository;

function normalizarValorReal($valor) {
    $valor = preg_replace('/[^\d,\.]/', '', (string) $valor);
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);

    return is_numeric($valor) ? number_format((float) $valor, 2, '.', '') : null;
}

$id = $_POST['id-servico-valor'] ?? null;
$descricao = trim($_POST['descricao'] ?? '');
$valor = normalizarValorReal($_POST['valor'] ?? '');

if(!$id || $descricao === '' || $valor === null){
    header('Location: ../../../../pages/configuracoes/configuracoes.php?error=true');
    exit;
}

$data = [
    'descricao' => $descricao,
    'valor' => $valor,
];

$res = ServicoValorRepository::update($data, $id);

if(!$res){
    header('Location: ../../../../pages/configuracoes/configuracoes.php?error=true');
    exit;
}else{
    header('Location: ../../../../pages/configuracoes/configuracoes.php?success=true');
    exit;
}

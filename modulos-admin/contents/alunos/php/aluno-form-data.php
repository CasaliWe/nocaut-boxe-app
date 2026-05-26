<?php

use Repositories\ServicoValorRepository;

function textoAlunoPost($key) {
    return trim($_POST[$key] ?? '');
}

function dataAlunoPost($key) {
    $valor = trim($_POST[$key] ?? '');

    return $valor === '' ? null : $valor;
}

function percentualAlunoPost($key) {
    $valor = trim($_POST[$key] ?? '');
    $valor = str_replace('%', '', $valor);
    $valor = str_replace('.', '', $valor);
    $valor = str_replace(',', '.', $valor);
    $valor = preg_replace('/[^\d\.]/', '', $valor);

    return is_numeric($valor) ? (float) $valor : 0;
}

function idadeAlunoCadastro($dataNascimento) {
    if(!$dataNascimento){
        return null;
    }

    try {
        $nascimento = new DateTime($dataNascimento);
        $hoje = new DateTime(date('Y-m-d'));
    } catch (Exception $exception) {
        return null;
    }

    return $nascimento->diff($hoje)->y;
}

function dadosAlunoPost() {
    $nome = textoAlunoPost('nome-aluno');
    $dataNascimento = dataAlunoPost('data-nascimento-aluno');
    $idade = idadeAlunoCadastro($dataNascimento);
    $pacote = ServicoValorRepository::getById($_POST['servico-valor-id-aluno'] ?? null);

    if(!$pacote || $nome === '' || !$dataNascimento || !dataAlunoPost('data-vencimento-aluno')){
        return null;
    }

    if(textoAlunoPost('documento-aluno') === '' || textoAlunoPost('telefone-contato-aluno') === ''){
        return null;
    }

    if($idade !== null && $idade < 18 && (textoAlunoPost('responsavel-nome-aluno') === '' || textoAlunoPost('responsavel-telefone-aluno') === '')){
        return null;
    }

    $juros = percentualAlunoPost('juros-percentual-aluno');
    $desconto = percentualAlunoPost('desconto-percentual-aluno');
    $valorPacote = (float) $pacote['valor'];
    $valorFinal = max(0, $valorPacote + ($valorPacote * ($juros / 100)) - ($valorPacote * ($desconto / 100)));
    $status = textoAlunoPost('status-aluno');
    $statusPermitidos = ['em aberto', 'pago', 'vencido'];

    if(!in_array($status, $statusPermitidos, true)){
        $status = 'em aberto';
    }

    $dataPagamento = dataAlunoPost('data-pagamento-aluno');
    $dataVencimento = dataAlunoPost('data-vencimento-aluno');

    if($dataVencimento && strtotime($dataVencimento) < strtotime(date('Y-m-d'))){
        $status = 'vencido';
    }

    $tipoDocumento = textoAlunoPost('tipo-documento-aluno');
    if(!in_array($tipoDocumento, ['cpf', 'identidade'], true)){
        $tipoDocumento = 'cpf';
    }

    $modalidade = textoAlunoPost('modalidade-aluno');
    if(!in_array($modalidade, ['boxe', 'funcional', 'musculacao'], true)){
        return null;
    }

    $sexo = textoAlunoPost('sexo-aluno');
    if(!in_array($sexo, ['feminino', 'masculino', 'outro'], true)){
        return null;
    }

    $temProblemaSaude = textoAlunoPost('problema-saude-aluno') === '1' ? 1 : 0;
    $descricaoProblemaSaude = $temProblemaSaude ? textoAlunoPost('descricao-problema-saude-aluno') : null;

    if($temProblemaSaude && !$descricaoProblemaSaude){
        return null;
    }

    return [
        'nome' => $nome,
        'data_inicio' => dataAlunoPost('data-inicio-aluno'),
        'rua' => textoAlunoPost('rua-aluno'),
        'numero' => textoAlunoPost('numero-aluno'),
        'bairro' => textoAlunoPost('bairro-aluno'),
        'cep' => textoAlunoPost('cep-aluno'),
        'tipo_documento' => $tipoDocumento,
        'documento' => textoAlunoPost('documento-aluno'),
        'telefone_contato' => textoAlunoPost('telefone-contato-aluno'),
        'telefone_emergencia' => textoAlunoPost('telefone-emergencia-aluno'),
        'responsavel_nome' => textoAlunoPost('responsavel-nome-aluno'),
        'responsavel_telefone' => textoAlunoPost('responsavel-telefone-aluno'),
        'data_nascimento' => $dataNascimento,
        'sexo' => $sexo,
        'modalidade' => $modalidade,
        'autoriza_imagem' => isset($_POST['autoriza-imagem']) ? 1 : 0,
        'tem_problema_saude' => $temProblemaSaude,
        'descricao_problema_saude' => $descricaoProblemaSaude,
        'facebook' => textoAlunoPost('facebook-aluno'),
        'instagram' => textoAlunoPost('instagram-aluno'),
        'observacoes' => textoAlunoPost('observacoes-aluno'),
        'servico_valor_id' => $pacote['id'],
        'pacote_descricao' => $pacote['descricao'],
        'valor_pacote' => number_format($valorPacote, 2, '.', ''),
        'juros_percentual' => number_format($juros, 2, '.', ''),
        'desconto_percentual' => number_format($desconto, 2, '.', ''),
        'valor_final' => number_format($valorFinal, 2, '.', ''),
        'status' => $status,
        'data_pagamento' => $dataPagamento,
        'data_vencimento' => $dataVencimento,
    ];
}

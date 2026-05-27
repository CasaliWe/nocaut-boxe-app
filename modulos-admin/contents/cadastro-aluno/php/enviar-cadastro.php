<?php

require __DIR__ . '/../../../../config/config.php';
use Repositories\AlunoSolicitacaoRepository;

function textoSolicitacaoAlunoPost($key) {
    return trim($_POST[$key] ?? '');
}

function dataSolicitacaoAlunoPost($key) {
    $valor = trim($_POST[$key] ?? '');

    return $valor === '' ? null : $valor;
}

function idadeSolicitacaoAluno($dataNascimento) {
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

$nome = textoSolicitacaoAlunoPost('nome-aluno');
$dataNascimento = dataSolicitacaoAlunoPost('data-nascimento-aluno');
$idade = idadeSolicitacaoAluno($dataNascimento);
$tipoDocumento = textoSolicitacaoAlunoPost('tipo-documento-aluno');
$modalidade = textoSolicitacaoAlunoPost('modalidade-aluno');
$modalidadesPermitidas = [
    'boxe',
    'funcional',
    'musculacao',
    'boxe_funcional',
    'boxe_musculacao',
    'musculacao_funcional',
    'boxe_funcional_musculacao',
];
$sexo = textoSolicitacaoAlunoPost('sexo-aluno');
$temProblemaSaude = textoSolicitacaoAlunoPost('problema-saude-aluno') === '1' ? 1 : 0;
$descricaoProblemaSaude = $temProblemaSaude ? textoSolicitacaoAlunoPost('descricao-problema-saude-aluno') : null;

if(
    $nome === '' ||
    !$dataNascimento ||
    textoSolicitacaoAlunoPost('documento-aluno') === '' ||
    textoSolicitacaoAlunoPost('telefone-contato-aluno') === '' ||
    !in_array($tipoDocumento, ['cpf', 'identidade'], true) ||
    !in_array($modalidade, $modalidadesPermitidas, true) ||
    !in_array($sexo, ['feminino', 'masculino', 'outro'], true)
){
    header('Location: ../../../../cadastro-aluno.php?error=true');
    exit;
}

if($idade !== null && $idade < 18 && (textoSolicitacaoAlunoPost('responsavel-nome-aluno') === '' || textoSolicitacaoAlunoPost('responsavel-telefone-aluno') === '')){
    header('Location: ../../../../cadastro-aluno.php?error=true');
    exit;
}

if($temProblemaSaude && !$descricaoProblemaSaude){
    header('Location: ../../../../cadastro-aluno.php?error=true');
    exit;
}

$data = [
    'nome' => $nome,
    'rua' => textoSolicitacaoAlunoPost('rua-aluno'),
    'numero' => textoSolicitacaoAlunoPost('numero-aluno'),
    'bairro' => textoSolicitacaoAlunoPost('bairro-aluno'),
    'cep' => textoSolicitacaoAlunoPost('cep-aluno'),
    'tipo_documento' => $tipoDocumento,
    'documento' => textoSolicitacaoAlunoPost('documento-aluno'),
    'telefone_contato' => textoSolicitacaoAlunoPost('telefone-contato-aluno'),
    'telefone_emergencia' => textoSolicitacaoAlunoPost('telefone-emergencia-aluno'),
    'responsavel_nome' => textoSolicitacaoAlunoPost('responsavel-nome-aluno'),
    'responsavel_telefone' => textoSolicitacaoAlunoPost('responsavel-telefone-aluno'),
    'data_nascimento' => $dataNascimento,
    'sexo' => $sexo,
    'modalidade' => $modalidade,
    'autoriza_imagem' => isset($_POST['autoriza-imagem']) ? 1 : 0,
    'tem_problema_saude' => $temProblemaSaude,
    'descricao_problema_saude' => $descricaoProblemaSaude,
    'facebook' => textoSolicitacaoAlunoPost('facebook-aluno'),
    'instagram' => textoSolicitacaoAlunoPost('instagram-aluno'),
    'observacoes' => textoSolicitacaoAlunoPost('observacoes-aluno'),
    'status' => 'pendente',
];

$res = AlunoSolicitacaoRepository::create($data);

if(!$res){
    header('Location: ../../../../cadastro-aluno.php?error=true');
    exit;
}else{
    header('Location: ../../../../cadastro-aluno.php?success=true');
    exit;
}

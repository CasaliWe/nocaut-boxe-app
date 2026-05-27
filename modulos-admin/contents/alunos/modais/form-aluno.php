<?php
    $sufixo = $contexto === 'editar' ? '-editar' : ($contexto === 'aprovacao' ? '-aprovacao' : '');
    $contextoJs = $contexto;
    if(!isset($modalidades_aluno)){
        $modalidades_aluno = [
            'boxe' => 'Boxe',
            'funcional' => 'Funcional',
            'musculacao' => 'Musculação',
            'boxe_funcional' => 'Boxe + Funcional',
            'boxe_musculacao' => 'Boxe + Musculação',
            'musculacao_funcional' => 'Musculação + Funcional',
            'boxe_funcional_musculacao' => 'Boxe + Funcional + Musculação',
        ];
    }
?>

<div class="modal-body">
    <h6 class="fw-bold mb-3">Dados do aluno</h6>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-6">
            <label for="nome-aluno<?= $sufixo; ?>" class="small">Nome*</label>
            <input type="text" id="nome-aluno<?= $sufixo; ?>" name="nome-aluno" class="form-control" required>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <label for="data-inicio-aluno<?= $sufixo; ?>" class="small">Data de início*</label>
            <input type="date" id="data-inicio-aluno<?= $sufixo; ?>" name="data-inicio-aluno" value="<?= $contexto === 'add' ? date('Y-m-d') : ''; ?>" class="form-control" required>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <label for="data-nascimento-aluno<?= $sufixo; ?>" class="small">Data de nascimento*</label>
            <input type="date" id="data-nascimento-aluno<?= $sufixo; ?>" name="data-nascimento-aluno" onchange="verificarMenorIdadeAluno('<?= $contextoJs; ?>')" class="form-control" required>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <label for="sexo-aluno<?= $sufixo; ?>" class="small">Sexo*</label>
            <select id="sexo-aluno<?= $sufixo; ?>" name="sexo-aluno" class="form-control" required>
                <option value="">Selecione</option>
                <option value="feminino">Feminino</option>
                <option value="masculino">Masculino</option>
                <option value="outro">Outro</option>
            </select>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <label for="modalidade-aluno<?= $sufixo; ?>" class="small">Modalidade*</label>
            <select id="modalidade-aluno<?= $sufixo; ?>" name="modalidade-aluno" class="form-control" required>
                <option value="">Selecione</option>
                <?php foreach($modalidades_aluno as $valorModalidade => $labelModalidade){ ?>
                    <option value="<?= htmlspecialchars($valorModalidade, ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($labelModalidade, ENT_QUOTES, 'UTF-8'); ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="col-12 col-lg-4 d-flex align-items-end">
            <div class="form-check pb-2">
                <input class="form-check-input" type="checkbox" id="autoriza-imagem-aluno<?= $sufixo; ?>" name="autoriza-imagem">
                <label class="form-check-label small" for="autoriza-imagem-aluno<?= $sufixo; ?>">
                    Autoriza uso de imagem, foto e vídeo
                </label>
            </div>
        </div>
    </div>

    <h6 class="fw-bold mb-3">Endereço</h6>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-5">
            <label for="rua-aluno<?= $sufixo; ?>" class="small">Rua</label>
            <input type="text" id="rua-aluno<?= $sufixo; ?>" name="rua-aluno" class="form-control">
        </div>

        <div class="col-12 col-md-4 col-lg-2">
            <label for="numero-aluno<?= $sufixo; ?>" class="small">Número</label>
            <input type="text" id="numero-aluno<?= $sufixo; ?>" name="numero-aluno" class="form-control">
        </div>

        <div class="col-12 col-md-4 col-lg-3">
            <label for="bairro-aluno<?= $sufixo; ?>" class="small">Bairro</label>
            <input type="text" id="bairro-aluno<?= $sufixo; ?>" name="bairro-aluno" class="form-control">
        </div>

        <div class="col-12 col-md-4 col-lg-2">
            <label for="cep-aluno<?= $sufixo; ?>" class="small">CEP</label>
            <input type="text" id="cep-aluno<?= $sufixo; ?>" name="cep-aluno" oninput="formatarCepAluno(this)" maxlength="9" class="form-control" placeholder="00000-000">
        </div>
    </div>

    <h6 class="fw-bold mb-3">Documento e contatos</h6>
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-4 col-lg-3">
            <label for="tipo-documento-aluno<?= $sufixo; ?>" class="small">Tipo de documento*</label>
            <select id="tipo-documento-aluno<?= $sufixo; ?>" name="tipo-documento-aluno" onchange="ajustarDocumentoAluno('<?= $contextoJs; ?>')" class="form-control" required>
                <option value="cpf">CPF</option>
                <option value="identidade">Identidade</option>
            </select>
        </div>

        <div class="col-12 col-md-8 col-lg-3">
            <label for="documento-aluno<?= $sufixo; ?>" class="small">Documento*</label>
            <input type="text" id="documento-aluno<?= $sufixo; ?>" name="documento-aluno" oninput="formatarDocumentoAluno(this, '<?= $contextoJs; ?>')" maxlength="14" placeholder="000.000.000-00" class="form-control" required>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <label for="telefone-contato-aluno<?= $sufixo; ?>" class="small">Telefone de contato*</label>
            <input type="text" id="telefone-contato-aluno<?= $sufixo; ?>" name="telefone-contato-aluno" oninput="formatarTelefoneAluno(this)" maxlength="15" class="form-control" placeholder="(00) 00000-0000" required>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <label for="telefone-emergencia-aluno<?= $sufixo; ?>" class="small">Telefone de emergência</label>
            <input type="text" id="telefone-emergencia-aluno<?= $sufixo; ?>" name="telefone-emergencia-aluno" oninput="formatarTelefoneAluno(this)" maxlength="15" class="form-control" placeholder="(00) 00000-0000">
        </div>
    </div>

    <div id="campos-responsavel<?= $sufixo; ?>" class="campo-responsavel d-none">
        <h6 class="fw-bold mb-3">Responsável</h6>
        <div class="row g-3 mb-4">
            <div class="col-12 col-lg-6">
                <label for="responsavel-nome-aluno<?= $sufixo; ?>" class="small">Nome do responsável*</label>
                <input type="text" id="responsavel-nome-aluno<?= $sufixo; ?>" name="responsavel-nome-aluno" class="form-control">
            </div>

            <div class="col-12 col-lg-6">
                <label for="responsavel-telefone-aluno<?= $sufixo; ?>" class="small">Telefone do responsável*</label>
                <input type="text" id="responsavel-telefone-aluno<?= $sufixo; ?>" name="responsavel-telefone-aluno" oninput="formatarTelefoneAluno(this)" maxlength="15" class="form-control" placeholder="(00) 00000-0000">
            </div>
        </div>
    </div>

    <h6 class="fw-bold mb-3">Saúde, redes e observações</h6>
    <div class="row g-3 mb-4">
        <div class="col-12 col-lg-4">
            <label for="problema-saude-aluno<?= $sufixo; ?>" class="small">Problema de saúde*</label>
            <select id="problema-saude-aluno<?= $sufixo; ?>" name="problema-saude-aluno" onchange="verificarProblemaSaudeAluno('<?= $contextoJs; ?>')" class="form-control" required>
                <option value="0">Não</option>
                <option value="1">Sim</option>
            </select>
        </div>

        <div id="campo-descricao-problema-saude<?= $sufixo; ?>" class="campo-problema-saude d-none col-12 col-lg-8">
            <label for="descricao-problema-saude-aluno<?= $sufixo; ?>" class="small">Descreva o problema de saúde*</label>
            <input type="text" id="descricao-problema-saude-aluno<?= $sufixo; ?>" name="descricao-problema-saude-aluno" class="form-control">
        </div>

        <div class="col-12 col-lg-6">
            <label for="facebook-aluno<?= $sufixo; ?>" class="small">Facebook</label>
            <input type="text" id="facebook-aluno<?= $sufixo; ?>" name="facebook-aluno" class="form-control">
        </div>

        <div class="col-12 col-lg-6">
            <label for="instagram-aluno<?= $sufixo; ?>" class="small">Instagram</label>
            <input type="text" id="instagram-aluno<?= $sufixo; ?>" name="instagram-aluno" class="form-control">
        </div>

        <div class="col-12">
            <label for="observacoes-aluno<?= $sufixo; ?>" class="small">Observações</label>
            <textarea id="observacoes-aluno<?= $sufixo; ?>" name="observacoes-aluno" class="form-control" rows="3"></textarea>
        </div>
    </div>

    <h6 class="fw-bold mb-3">Pacote, valores e status</h6>
    <?php if(count($pacotes_valores) == 0){ ?>
        <div class="alert alert-danger small" role="alert">
            Nenhum pacote cadastrado em Configurações. Cadastre os valores dos serviços antes de cadastrar alunos.
        </div>
    <?php } ?>

    <div class="row g-3">
        <div class="col-12 col-lg-5">
            <label for="pacote-aluno<?= $sufixo; ?>" class="small">Pacote*</label>
            <input type="text" id="pacote-aluno<?= $sufixo; ?>" name="pacote-aluno" oninput="buscarPacotesAluno('<?= $contextoJs; ?>')" autocomplete="off" class="form-control" placeholder="Digite ao menos 3 letras..." required>
            <input type="hidden" id="servico-valor-id-aluno<?= $sufixo; ?>" name="servico-valor-id-aluno" data-valor="0">
            <div id="pacotes-opcoes-aluno<?= $sufixo; ?>" class="pacotes-alunos-opcoes d-none"></div>
            <small class="text-muted">Valor do pacote: <span id="valor-pacote-preview-aluno<?= $sufixo; ?>">Selecione um pacote cadastrado.</span></small>
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <label for="juros-percentual-aluno<?= $sufixo; ?>" class="small">Juros</label>
            <input type="text" id="juros-percentual-aluno<?= $sufixo; ?>" name="juros-percentual-aluno" inputmode="decimal" oninput="calcularValorFinalAluno('<?= $contextoJs; ?>')" onblur="formatarPercentualAluno(this); calcularValorFinalAluno('<?= $contextoJs; ?>')" class="form-control" placeholder="0%">
        </div>

        <div class="col-12 col-md-6 col-lg-2">
            <label for="desconto-percentual-aluno<?= $sufixo; ?>" class="small">Desconto</label>
            <input type="text" id="desconto-percentual-aluno<?= $sufixo; ?>" name="desconto-percentual-aluno" inputmode="decimal" oninput="calcularValorFinalAluno('<?= $contextoJs; ?>')" onblur="formatarPercentualAluno(this); calcularValorFinalAluno('<?= $contextoJs; ?>')" class="form-control" placeholder="0%">
        </div>

        <div class="col-12 col-lg-3">
            <label class="small">Valor final</label>
            <div class="valor-final-preview fw-bold" id="valor-final-preview-aluno<?= $sufixo; ?>">R$ 0,00</div>
        </div>

        <div class="col-12">
            <div class="alert alert-secondary small mb-0" role="alert">
                Para controlar mensalidade: quando o aluno pagar, clique em <strong>Registrar pagamento hoje</strong>. O sistema marca como pago, coloca a data de hoje no último pagamento e define o próximo vencimento para daqui 1 mês.
            </div>
        </div>

        <div class="col-12 col-md-4">
            <label for="status-aluno<?= $sufixo; ?>" class="small">Status*</label>
            <select id="status-aluno<?= $sufixo; ?>" name="status-aluno" class="form-control" required>
                <option value="em aberto">Em aberto</option>
                <option value="pago">Pago</option>
                <option value="vencido">Vencido</option>
            </select>
        </div>

        <div class="col-12 col-md-4">
            <label for="data-pagamento-aluno<?= $sufixo; ?>" class="small">Último pagamento</label>
            <input type="date" id="data-pagamento-aluno<?= $sufixo; ?>" name="data-pagamento-aluno" class="form-control">
        </div>

        <div class="col-12 col-md-4">
            <label for="data-vencimento-aluno<?= $sufixo; ?>" class="small">Próximo vencimento*</label>
            <input type="date" id="data-vencimento-aluno<?= $sufixo; ?>" name="data-vencimento-aluno" class="form-control" required>
        </div>

        <div class="col-12">
            <button type="button" onclick="registrarPagamentoAluno('<?= $contextoJs; ?>')" class="btn btn-outline-success btn-sm">
                <i class="me-1 fas fa-check"></i> Registrar pagamento hoje
            </button>
        </div>
    </div>
</div>

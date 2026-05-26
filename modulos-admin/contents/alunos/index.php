<?php
    function hAluno($valor) {
        return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
    }

    function formatarRealAluno($valor) {
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }

    function formatarDataAluno($data) {
        if(!$data){
            return '-';
        }

        return date('d/m/Y', strtotime($data));
    }

    function formatarDataHoraAluno($data) {
        if(!$data){
            return '-';
        }

        return date('d/m/Y H:i', strtotime($data));
    }

    function statusCalculadoAluno($aluno) {
        if($aluno['data_vencimento'] && strtotime($aluno['data_vencimento']) < strtotime(date('Y-m-d'))){
            return 'vencido';
        }

        if($aluno['status'] === 'pago'){
            return 'pago';
        }

        return $aluno['status'] ?: 'em aberto';
    }

    function badgeStatusAluno($status) {
        if($status === 'pago'){
            return 'bg-success';
        }

        if($status === 'vencido'){
            return 'bg-danger';
        }

        return 'bg-warning text-dark';
    }

    function avisoVencimentoAluno($aluno) {
        if(!$aluno['data_vencimento']){
            return null;
        }

        $hoje = new DateTime(date('Y-m-d'));
        $vencimento = new DateTime($aluno['data_vencimento']);
        $dias = (int) $hoje->diff($vencimento)->format('%r%a');

        if($dias < 0){
            return [
                'texto' => 'Vencido ha ' . abs($dias) . ' dia' . (abs($dias) == 1 ? '' : 's'),
                'classe' => 'bg-danger',
            ];
        }

        if($dias === 0){
            return [
                'texto' => 'Vence hoje',
                'classe' => 'bg-danger',
            ];
        }

        if($dias <= 7){
            return [
                'texto' => 'Vencendo em ' . $dias . ' dia' . ($dias == 1 ? '' : 's'),
                'classe' => 'bg-warning text-dark',
            ];
        }

        return null;
    }

    function payloadAluno($aluno) {
        return [
            'id' => $aluno['id'],
            'nome' => $aluno['nome'],
            'data_inicio' => $aluno['data_inicio'],
            'rua' => $aluno['rua'],
            'numero' => $aluno['numero'],
            'bairro' => $aluno['bairro'],
            'cep' => $aluno['cep'],
            'tipo_documento' => $aluno['tipo_documento'],
            'documento' => $aluno['documento'],
            'telefone_contato' => $aluno['telefone_contato'],
            'telefone_emergencia' => $aluno['telefone_emergencia'],
            'responsavel_nome' => $aluno['responsavel_nome'],
            'responsavel_telefone' => $aluno['responsavel_telefone'],
            'data_nascimento' => $aluno['data_nascimento'],
            'sexo' => $aluno['sexo'],
            'modalidade' => $aluno['modalidade'],
            'autoriza_imagem' => (int) $aluno['autoriza_imagem'],
            'tem_problema_saude' => (int) $aluno['tem_problema_saude'],
            'descricao_problema_saude' => $aluno['descricao_problema_saude'],
            'facebook' => $aluno['facebook'],
            'instagram' => $aluno['instagram'],
            'observacoes' => $aluno['observacoes'],
            'servico_valor_id' => $aluno['servico_valor_id'],
            'pacote_descricao' => $aluno['pacote_descricao'],
            'valor_pacote' => $aluno['valor_pacote'],
            'juros_percentual' => $aluno['juros_percentual'],
            'desconto_percentual' => $aluno['desconto_percentual'],
            'valor_final' => $aluno['valor_final'],
            'status' => $aluno['status'],
            'data_pagamento' => $aluno['data_pagamento'],
            'data_vencimento' => $aluno['data_vencimento'],
        ];
    }

    $pacotes_js = [];
    foreach($pacotes_valores as $pacote){
        $pacotes_js[] = [
            'id' => (int) $pacote['id'],
            'descricao' => $pacote['descricao'],
            'valor' => (float) $pacote['valor'],
        ];
    }
?>

<style>
    .campo-responsavel.d-none,
    .campo-problema-saude.d-none{
        display: none !important;
    }

    .valor-final-preview{
        border: 1px solid rgba(220, 53, 69, .35);
        border-radius: 6px;
        padding: 12px 14px;
        background-color: rgba(220, 53, 69, .04);
    }

    .pacotes-alunos-opcoes{
        border: 1px solid #dee2e6;
        border-radius: 6px;
        margin-top: 6px;
        max-height: 210px;
        overflow-y: auto;
        background-color: #fff;
    }

    .pacote-aluno-opcao{
        width: 100%;
        border: none;
        background-color: transparent;
        padding: 10px 12px;
        text-align: left;
        border-bottom: 1px solid #f1f1f1;
    }

    .pacote-aluno-opcao:last-child{
        border-bottom: none;
    }

    .pacote-aluno-opcao:hover{
        background-color: rgba(220, 53, 69, .08);
    }

    .pacotes-alunos-loading,
    .pacotes-alunos-vazio{
        padding: 10px 12px;
    }

    @media(max-width: 576px){
        .acoes-card-aluno{
            width: 100%;
        }

        .acoes-card-aluno .btn{
            width: 100%;
        }
    }
</style>

<section>
    <h6 class="fw-normal small mb-4">Sessão destinada ao cadastro, edição e acompanhamento dos alunos.</h6>

    <div class="alert alert-secondary d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-4" role="alert">
        <div>
            <h6 class="fw-bold mb-1">Aprovações de cadastro</h6>
            <p class="small mb-0">Espaço reservado para os cadastros enviados pelos alunos pelo link externo.</p>
        </div>
        <button type="button" class="mt-3 mt-lg-0 btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#aprovacoes-em-breve">
            Ver aprovações
        </button>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <h6 class="mb-0 fw-semibold">Filtros</h6>
        </div>
        <div class="card-body">
            <form method="get" class="row g-3 align-items-end">
                <div class="col-12 col-lg-3">
                    <label for="pesquisa" class="small">Pesquisar pelo nome</label>
                    <input type="text" id="pesquisa" name="pesquisa" value="<?= hAluno($filtros['pesquisa']); ?>" class="form-control" placeholder="Nome do aluno...">
                </div>

                <div class="col-12 col-md-6 col-lg-2">
                    <label for="situacao" class="small">Situação</label>
                    <select id="situacao" name="situacao" class="form-control">
                        <option value="">Todos</option>
                        <option value="vencendo" <?= $filtros['situacao'] === 'vencendo' ? 'selected' : ''; ?>>Vencendo</option>
                        <option value="vencido" <?= $filtros['situacao'] === 'vencido' ? 'selected' : ''; ?>>Vencido</option>
                        <option value="aniversario" <?= $filtros['situacao'] === 'aniversario' ? 'selected' : ''; ?>>Aniversário hoje</option>
                    </select>
                </div>

                <div class="col-12 col-md-6 col-lg-2">
                    <label for="modalidade-filtro" class="small">Modalidade</label>
                    <select id="modalidade-filtro" name="modalidade" class="form-control">
                        <option value="">Todas</option>
                        <option value="boxe" <?= $filtros['modalidade'] === 'boxe' ? 'selected' : ''; ?>>Boxe</option>
                        <option value="funcional" <?= $filtros['modalidade'] === 'funcional' ? 'selected' : ''; ?>>Funcional</option>
                        <option value="musculacao" <?= $filtros['modalidade'] === 'musculacao' ? 'selected' : ''; ?>>Musculação</option>
                    </select>
                </div>

                <div class="col-12 col-lg-3">
                    <label for="pacote-filtro" class="small">Pacote</label>
                    <select id="pacote-filtro" name="pacote" class="form-control">
                        <option value="">Todos</option>
                        <?php foreach($pacotes_valores as $pacote){ ?>
                            <option value="<?= $pacote['id']; ?>" <?= (string) $filtros['pacote'] === (string) $pacote['id'] ? 'selected' : ''; ?>>
                                <?= hAluno($pacote['descricao']); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-12 col-lg-2 d-flex gap-2">
                    <button type="submit" class="btn btn-danger btn-sm w-100">Filtrar</button>
                    <a href="<?= $base_url; ?>pages/alunos/alunos.php" class="btn btn-secondary btn-sm w-100">Limpar</a>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-4">
        <button type="button" class="mb-3 mb-lg-0 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add-aluno">
            <i class="me-1 fas fa-user-plus"></i> Cadastrar aluno
        </button>
        <p class="small mb-0 text-muted">Alunos encontrados: <span class="fw-bold"><?= count($alunos); ?></span></p>
    </div>

    <?php if(count($alunos) == 0){ ?>
        <div class="alert alert-danger mt-4" role="alert">
            <h5 class="alert-heading fw-semibold">Nenhum aluno encontrado!</h5>
            <p class="small mb-0">Cadastre um novo aluno ou ajuste os filtros acima.</p>
        </div>
    <?php }else{ ?>
        <div class="row row-cols-1 row-cols-xl-2 g-4">
            <?php foreach($alunos as $aluno){ ?>
                <?php
                    $statusAluno = statusCalculadoAluno($aluno);
                    $avisoVencimento = avisoVencimentoAluno($aluno);
                    $payload = hAluno(json_encode(payloadAluno($aluno), JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT));
                ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                            <div>
                                <h5 class="my-1 card-title"><?= hAluno($aluno['nome']); ?></h5>
                                <small class="text-muted"><?= hAluno($aluno['modalidade']); ?> - <?= hAluno($aluno['pacote_descricao']); ?></small>
                            </div>
                            <div class="mt-2 mt-md-0 d-flex flex-wrap gap-2">
                                <span class="badge <?= badgeStatusAluno($statusAluno); ?>"><?= hAluno(ucfirst($statusAluno)); ?></span>
                                <?php if($avisoVencimento){ ?>
                                    <span class="badge <?= $avisoVencimento['classe']; ?>"><?= hAluno($avisoVencimento['texto']); ?></span>
                                <?php } ?>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 small">
                                <div class="col-12 col-md-6">
                                    <p class="mb-2"><strong>Telefone:</strong> <?= hAluno($aluno['telefone_contato'] ?: '-'); ?></p>
                                    <p class="mb-2"><strong>Documento:</strong> <?= hAluno($aluno['tipo_documento'] ? strtoupper($aluno['tipo_documento']) . ' ' . $aluno['documento'] : '-'); ?></p>
                                    <p class="mb-2"><strong>Nascimento:</strong> <?= formatarDataAluno($aluno['data_nascimento']); ?></p>
                                </div>

                                <div class="col-12 col-md-6">
                                    <p class="mb-2"><strong>Valor final:</strong> <?= formatarRealAluno($aluno['valor_final']); ?></p>
                                    <p class="mb-2"><strong>Último pagamento:</strong> <?= formatarDataAluno($aluno['data_pagamento']); ?></p>
                                    <p class="mb-2"><strong>Próximo vencimento:</strong> <?= formatarDataAluno($aluno['data_vencimento']); ?></p>
                                </div>
                            </div>

                            <?php if($aluno['observacoes']){ ?>
                                <p class="small mt-3 mb-0"><strong>Observações:</strong> <?= hAluno($aluno['observacoes']); ?></p>
                            <?php } ?>
                        </div>

                        <div class="card-footer text-muted">
                            <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                                <div class="d-flex flex-column small">
                                    <span>Criado em: <?= formatarDataHoraAluno($aluno['created_at']); ?></span>
                                    <span>Editado em: <?= formatarDataHoraAluno($aluno['updated_at']); ?></span>
                                </div>

                                <div class="d-flex flex-column flex-sm-row gap-2 acoes-card-aluno">
                                    <button type="button" data-aluno='<?= $payload; ?>' onclick="editarAluno(this)" class="btn btn-success btn-sm">Editar</button>
                                    <button type="button" onclick="deletarAluno('<?= $aluno['id']; ?>')" class="btn btn-danger btn-sm">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
</section>

<script>
    const pacotesAlunos = <?= json_encode($pacotes_js, JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
    const realFormatterAluno = new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' });
    const timersBuscaPacotesAluno = {};

    function campoAluno(nome, contexto){
        const sufixo = contexto === 'editar' ? '-editar' : '';
        return document.getElementById(nome + sufixo);
    }

    function apenasDigitos(valor){
        return (valor || '').replace(/\D/g, '');
    }

    function formatarTelefoneAluno(campo){
        let valor = apenasDigitos(campo.value).slice(0, 11);

        if(valor.length <= 10){
            valor = valor.replace(/^(\d{2})(\d)/, '($1) $2');
            valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        }else{
            valor = valor.replace(/^(\d{2})(\d)/, '($1) $2');
            valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
        }

        campo.value = valor;
    }

    function formatarCepAluno(campo){
        let valor = apenasDigitos(campo.value).slice(0, 8);
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
        campo.value = valor;
    }

    function formatarCpfAluno(campo){
        let valor = apenasDigitos(campo.value).slice(0, 11);
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        campo.value = valor;
    }

    function ajustarDocumentoAluno(contexto){
        const tipo = campoAluno('tipo-documento-aluno', contexto);
        const documento = campoAluno('documento-aluno', contexto);

        if(!tipo || !documento){
            return;
        }

        if(tipo.value === 'cpf'){
            documento.placeholder = '000.000.000-00';
            documento.maxLength = 14;
            formatarCpfAluno(documento);
        }else{
            documento.placeholder = 'Identidade';
            documento.maxLength = 30;
        }
    }

    function formatarDocumentoAluno(campo, contexto){
        const tipo = campoAluno('tipo-documento-aluno', contexto);

        if(tipo && tipo.value === 'cpf'){
            formatarCpfAluno(campo);
        }
    }

    function parsePercentualAluno(valor){
        valor = (valor || '').toString().replace('%', '').replace(/\./g, '').replace(',', '.').trim();
        const numero = parseFloat(valor);
        return isNaN(numero) ? 0 : numero;
    }

    function formatarPercentualAluno(campo){
        const numero = parsePercentualAluno(campo.value);
        campo.value = numero > 0 ? numero.toString().replace('.', ',') + '%' : '';
    }

    function formatarPercentualParaInput(valor){
        const numero = parseFloat(valor || 0);
        return numero > 0 ? numero.toString().replace('.', ',') + '%' : '';
    }

    function pacotePorDescricao(descricao){
        return pacotesAlunos.find((pacote) => pacote.descricao === descricao);
    }

    function pacotePorId(id){
        return pacotesAlunos.find((pacote) => String(pacote.id) === String(id));
    }

    function normalizarBuscaPacoteAluno(valor){
        return (valor || '').toString().normalize('NFD').replace(/[\u0300-\u036f]/g, '').toLowerCase();
    }

    function opcoesPacotesAluno(contexto){
        return campoAluno('pacotes-opcoes-aluno', contexto);
    }

    function esconderOpcoesPacotesAluno(contexto){
        const opcoes = opcoesPacotesAluno(contexto);

        if(opcoes){
            opcoes.classList.add('d-none');
            opcoes.innerHTML = '';
        }
    }

    function buscarPacotesAluno(contexto){
        const inputPacote = campoAluno('pacote-aluno', contexto);
        const idPacote = campoAluno('servico-valor-id-aluno', contexto);
        const valorPreview = campoAluno('valor-pacote-preview-aluno', contexto);
        const opcoes = opcoesPacotesAluno(contexto);
        const termo = inputPacote.value.trim();

        idPacote.value = '';
        idPacote.dataset.valor = '0';
        valorPreview.textContent = 'Selecione um pacote cadastrado.';
        calcularValorFinalAluno(contexto);

        clearTimeout(timersBuscaPacotesAluno[contexto]);

        if(termo.length < 3){
            esconderOpcoesPacotesAluno(contexto);
            return;
        }

        opcoes.classList.remove('d-none');
        opcoes.innerHTML = '<div class="pacotes-alunos-loading small text-muted">Carregando pacotes...</div>';

        timersBuscaPacotesAluno[contexto] = setTimeout(function(){
            const termoNormalizado = normalizarBuscaPacoteAluno(termo);
            const encontrados = pacotesAlunos.filter((pacote) => {
                return normalizarBuscaPacoteAluno(pacote.descricao).includes(termoNormalizado);
            });

            opcoes.innerHTML = '';

            if(encontrados.length === 0){
                opcoes.innerHTML = '<div class="pacotes-alunos-vazio small text-muted">Nenhum pacote encontrado.</div>';
                return;
            }

            encontrados.forEach((pacote) => {
                const botao = document.createElement('button');
                botao.type = 'button';
                botao.className = 'pacote-aluno-opcao';
                botao.onclick = function(){
                    selecionarPacoteAlunoPorId(contexto, pacote.id);
                };

                const descricao = document.createElement('span');
                descricao.className = 'fw-semibold d-block';
                descricao.textContent = pacote.descricao;

                const valor = document.createElement('small');
                valor.className = 'text-muted';
                valor.textContent = realFormatterAluno.format(pacote.valor);

                botao.appendChild(descricao);
                botao.appendChild(valor);
                opcoes.appendChild(botao);
            });
        }, 250);
    }

    function selecionarPacoteAlunoPorId(contexto, id){
        const inputPacote = campoAluno('pacote-aluno', contexto);
        const idPacote = campoAluno('servico-valor-id-aluno', contexto);
        const valorPreview = campoAluno('valor-pacote-preview-aluno', contexto);
        const pacote = pacotePorId(id);

        if(!pacote){
            return;
        }

        inputPacote.value = pacote.descricao;
        idPacote.value = pacote.id;
        idPacote.dataset.valor = pacote.valor;
        valorPreview.textContent = realFormatterAluno.format(pacote.valor);
        esconderOpcoesPacotesAluno(contexto);
        calcularValorFinalAluno(contexto);
    }

    function calcularValorFinalAluno(contexto){
        const idPacote = campoAluno('servico-valor-id-aluno', contexto);
        const juros = campoAluno('juros-percentual-aluno', contexto);
        const desconto = campoAluno('desconto-percentual-aluno', contexto);
        const finalPreview = campoAluno('valor-final-preview-aluno', contexto);

        const valor = parseFloat(idPacote.dataset.valor || 0);
        const jurosValor = valor * (parsePercentualAluno(juros.value) / 100);
        const descontoValor = valor * (parsePercentualAluno(desconto.value) / 100);
        const final = Math.max(0, valor + jurosValor - descontoValor);

        finalPreview.textContent = realFormatterAluno.format(final);
    }

    function dataHojeAluno(){
        const hoje = new Date();
        hoje.setMinutes(hoje.getMinutes() - hoje.getTimezoneOffset());
        return hoje.toISOString().slice(0, 10);
    }

    function somarMesAluno(dataBase){
        const partes = dataBase.split('-').map(Number);
        const data = new Date(partes[0], partes[1] - 1, partes[2]);
        data.setMonth(data.getMonth() + 1);

        const ano = data.getFullYear();
        const mes = String(data.getMonth() + 1).padStart(2, '0');
        const dia = String(data.getDate()).padStart(2, '0');

        return ano + '-' + mes + '-' + dia;
    }

    function registrarPagamentoAluno(contexto){
        const hoje = dataHojeAluno();

        campoAluno('status-aluno', contexto).value = 'pago';
        campoAluno('data-pagamento-aluno', contexto).value = hoje;
        campoAluno('data-vencimento-aluno', contexto).value = somarMesAluno(hoje);
    }

    function verificarMenorIdadeAluno(contexto){
        const dataNascimento = campoAluno('data-nascimento-aluno', contexto);
        const bloco = document.getElementById(contexto === 'editar' ? 'campos-responsavel-editar' : 'campos-responsavel');
        const nomeResponsavel = campoAluno('responsavel-nome-aluno', contexto);
        const telefoneResponsavel = campoAluno('responsavel-telefone-aluno', contexto);

        if(!dataNascimento || !dataNascimento.value || !bloco){
            bloco.classList.add('d-none');
            nomeResponsavel.required = false;
            telefoneResponsavel.required = false;
            return;
        }

        const nascimento = new Date(dataNascimento.value + 'T00:00:00');
        const hoje = new Date();
        let idade = hoje.getFullYear() - nascimento.getFullYear();
        const mes = hoje.getMonth() - nascimento.getMonth();

        if(mes < 0 || (mes === 0 && hoje.getDate() < nascimento.getDate())){
            idade--;
        }

        if(idade < 18){
            bloco.classList.remove('d-none');
            nomeResponsavel.required = true;
            telefoneResponsavel.required = true;
        }else{
            bloco.classList.add('d-none');
            nomeResponsavel.required = false;
            telefoneResponsavel.required = false;
        }
    }

    function verificarProblemaSaudeAluno(contexto){
        const select = campoAluno('problema-saude-aluno', contexto);
        const bloco = document.getElementById(contexto === 'editar' ? 'campo-descricao-problema-saude-editar' : 'campo-descricao-problema-saude');
        const descricao = campoAluno('descricao-problema-saude-aluno', contexto);

        if(select.value === '1'){
            bloco.classList.remove('d-none');
            descricao.required = true;
        }else{
            bloco.classList.add('d-none');
            descricao.required = false;
            descricao.value = '';
        }
    }

    function editarAluno(botao){
        const aluno = JSON.parse(botao.dataset.aluno);

        campoAluno('id-aluno', 'editar').value = aluno.id || '';
        campoAluno('nome-aluno', 'editar').value = aluno.nome || '';
        campoAluno('data-inicio-aluno', 'editar').value = aluno.data_inicio || '';
        campoAluno('rua-aluno', 'editar').value = aluno.rua || '';
        campoAluno('numero-aluno', 'editar').value = aluno.numero || '';
        campoAluno('bairro-aluno', 'editar').value = aluno.bairro || '';
        campoAluno('cep-aluno', 'editar').value = aluno.cep || '';
        campoAluno('tipo-documento-aluno', 'editar').value = aluno.tipo_documento || 'cpf';
        campoAluno('documento-aluno', 'editar').value = aluno.documento || '';
        campoAluno('telefone-contato-aluno', 'editar').value = aluno.telefone_contato || '';
        campoAluno('telefone-emergencia-aluno', 'editar').value = aluno.telefone_emergencia || '';
        campoAluno('responsavel-nome-aluno', 'editar').value = aluno.responsavel_nome || '';
        campoAluno('responsavel-telefone-aluno', 'editar').value = aluno.responsavel_telefone || '';
        campoAluno('data-nascimento-aluno', 'editar').value = aluno.data_nascimento || '';
        campoAluno('sexo-aluno', 'editar').value = aluno.sexo || '';
        campoAluno('modalidade-aluno', 'editar').value = aluno.modalidade || '';
        campoAluno('autoriza-imagem-aluno', 'editar').checked = Number(aluno.autoriza_imagem) === 1;
        campoAluno('problema-saude-aluno', 'editar').value = Number(aluno.tem_problema_saude) === 1 ? '1' : '0';
        campoAluno('descricao-problema-saude-aluno', 'editar').value = aluno.descricao_problema_saude || '';
        campoAluno('facebook-aluno', 'editar').value = aluno.facebook || '';
        campoAluno('instagram-aluno', 'editar').value = aluno.instagram || '';
        campoAluno('observacoes-aluno', 'editar').value = aluno.observacoes || '';
        campoAluno('pacote-aluno', 'editar').value = aluno.pacote_descricao || '';
        campoAluno('servico-valor-id-aluno', 'editar').value = aluno.servico_valor_id || '';
        campoAluno('juros-percentual-aluno', 'editar').value = formatarPercentualParaInput(aluno.juros_percentual);
        campoAluno('desconto-percentual-aluno', 'editar').value = formatarPercentualParaInput(aluno.desconto_percentual);
        campoAluno('status-aluno', 'editar').value = aluno.status || 'em aberto';
        campoAluno('data-pagamento-aluno', 'editar').value = aluno.data_pagamento || '';
        campoAluno('data-vencimento-aluno', 'editar').value = aluno.data_vencimento || '';

        const pacote = pacotePorId(aluno.servico_valor_id);
        const idPacote = campoAluno('servico-valor-id-aluno', 'editar');
        const valorPacote = pacote ? pacote.valor : parseFloat(aluno.valor_pacote || 0);
        idPacote.dataset.valor = valorPacote;
        campoAluno('valor-pacote-preview-aluno', 'editar').textContent = realFormatterAluno.format(valorPacote);
        esconderOpcoesPacotesAluno('editar');

        ajustarDocumentoAluno('editar');
        verificarMenorIdadeAluno('editar');
        verificarProblemaSaudeAluno('editar');
        calcularValorFinalAluno('editar');

        var meuModal = new bootstrap.Modal(document.getElementById('editar-aluno'));
        meuModal.show();
    }

    function deletarAluno(id){
        document.getElementById('id-aluno-deletar').value = id;

        var meuModal = new bootstrap.Modal(document.getElementById('deletar-aluno'));
        meuModal.show();
    }

    document.addEventListener('click', function(event){
        if(!event.target.closest('.pacotes-alunos-opcoes') && !event.target.closest('[id^="pacote-aluno"]')){
            esconderOpcoesPacotesAluno('add');
            esconderOpcoesPacotesAluno('editar');
        }
    });
</script>

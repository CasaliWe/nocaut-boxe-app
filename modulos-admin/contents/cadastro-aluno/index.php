<?php
    $modalidades_publicas = [
        'boxe' => 'Boxe',
        'funcional' => 'Funcional',
        'musculacao' => 'Musculação',
        'boxe_funcional' => 'Boxe + Funcional',
        'boxe_musculacao' => 'Boxe + Musculação',
        'musculacao_funcional' => 'Musculação + Funcional',
        'boxe_funcional_musculacao' => 'Boxe + Funcional + Musculação',
    ];
?>

<style>
    .pagina-cadastro-aluno{
        min-height: 100vh;
        padding: 32px 16px;
        background: #f5f5f5;
    }

    .card-cadastro-aluno{
        max-width: 980px;
        border: none;
        border-radius: 8px;
    }

    .topo-cadastro-aluno{
        background-color: #212529;
        border-radius: 8px 8px 0 0;
    }

    .topo-cadastro-aluno img{
        max-width: 150px;
    }

    .campo-responsavel-publico.d-none,
    .campo-problema-saude-publico.d-none{
        display: none !important;
    }
</style>

<main class="pagina-cadastro-aluno d-flex align-items-center justify-content-center">
    <div class="card card-cadastro-aluno shadow-lg w-100">
        <div class="topo-cadastro-aluno p-4 text-center">
            <img src="<?= $base_url; ?>assets/imagens/site-admin/logo.png" alt="Nocaut Boxe">
        </div>

        <div class="card-body p-4 p-lg-5">
            <h1 class="fs-4 fw-bold mb-2">Cadastro de aluno</h1>
            <p class="small text-muted mb-4">Preencha seus dados para enviar a solicitação de cadastro. A equipe da Nocaut Boxe fará a aprovação depois.</p>

            <?php if(isset($_GET['success']) && $_GET['success'] === 'true'){ ?>
                <div class="alert alert-success" role="alert">
                    Cadastro enviado com sucesso! Em breve a equipe fará a aprovação.
                </div>
            <?php } ?>

            <?php if(isset($_GET['error']) && $_GET['error'] === 'true'){ ?>
                <div class="alert alert-danger" role="alert">
                    Não foi possível enviar o cadastro. Revise os campos e tente novamente.
                </div>
            <?php } ?>

            <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/cadastro-aluno/php/enviar-cadastro.php" method="post">
                <h6 class="fw-bold mb-3">Dados pessoais</h6>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-lg-6">
                        <label for="nome-aluno-publico" class="small">Nome completo*</label>
                        <input type="text" id="nome-aluno-publico" name="nome-aluno" class="form-control" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="data-nascimento-aluno-publico" class="small">Data de nascimento*</label>
                        <input type="date" id="data-nascimento-aluno-publico" name="data-nascimento-aluno" onchange="verificarMenorIdadePublico()" class="form-control" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="sexo-aluno-publico" class="small">Sexo*</label>
                        <select id="sexo-aluno-publico" name="sexo-aluno" class="form-control" required>
                            <option value="">Selecione</option>
                            <option value="feminino">Feminino</option>
                            <option value="masculino">Masculino</option>
                            <option value="outro">Outro</option>
                        </select>
                    </div>

                    <div class="col-12 col-lg-4">
                        <label for="modalidade-aluno-publico" class="small">Modalidade de interesse*</label>
                        <select id="modalidade-aluno-publico" name="modalidade-aluno" class="form-control" required>
                            <option value="">Selecione</option>
                            <?php foreach($modalidades_publicas as $valorModalidade => $labelModalidade){ ?>
                                <option value="<?= htmlspecialchars($valorModalidade, ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($labelModalidade, ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="col-12 col-lg-8 d-flex align-items-end">
                        <div class="form-check pb-2">
                            <input class="form-check-input" type="checkbox" id="autoriza-imagem-publico" name="autoriza-imagem">
                            <label class="form-check-label small" for="autoriza-imagem-publico">
                                Autorizo o uso de minha imagem em fotos e vídeos da academia
                            </label>
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Endereço</h6>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-lg-5">
                        <label for="rua-aluno-publico" class="small">Rua</label>
                        <input type="text" id="rua-aluno-publico" name="rua-aluno" class="form-control">
                    </div>

                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="numero-aluno-publico" class="small">Número</label>
                        <input type="text" id="numero-aluno-publico" name="numero-aluno" class="form-control">
                    </div>

                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="bairro-aluno-publico" class="small">Bairro</label>
                        <input type="text" id="bairro-aluno-publico" name="bairro-aluno" class="form-control">
                    </div>

                    <div class="col-12 col-md-4 col-lg-2">
                        <label for="cep-aluno-publico" class="small">CEP</label>
                        <input type="text" id="cep-aluno-publico" name="cep-aluno" oninput="formatarCepPublico(this)" maxlength="9" class="form-control" placeholder="00000-000">
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Documento e contatos</h6>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-md-4 col-lg-3">
                        <label for="tipo-documento-aluno-publico" class="small">Tipo de documento*</label>
                        <select id="tipo-documento-aluno-publico" name="tipo-documento-aluno" onchange="ajustarDocumentoPublico()" class="form-control" required>
                            <option value="cpf">CPF</option>
                            <option value="identidade">Identidade</option>
                        </select>
                    </div>

                    <div class="col-12 col-md-8 col-lg-3">
                        <label for="documento-aluno-publico" class="small">Documento*</label>
                        <input type="text" id="documento-aluno-publico" name="documento-aluno" oninput="formatarDocumentoPublico(this)" maxlength="14" placeholder="000.000.000-00" class="form-control" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="telefone-contato-aluno-publico" class="small">Telefone de contato*</label>
                        <input type="text" id="telefone-contato-aluno-publico" name="telefone-contato-aluno" oninput="formatarTelefonePublico(this)" maxlength="15" class="form-control" placeholder="(00) 00000-0000" required>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3">
                        <label for="telefone-emergencia-aluno-publico" class="small">Telefone de emergência</label>
                        <input type="text" id="telefone-emergencia-aluno-publico" name="telefone-emergencia-aluno" oninput="formatarTelefonePublico(this)" maxlength="15" class="form-control" placeholder="(00) 00000-0000">
                    </div>
                </div>

                <div id="campos-responsavel-publico" class="campo-responsavel-publico d-none">
                    <h6 class="fw-bold mb-3">Responsável</h6>
                    <div class="row g-3 mb-4">
                        <div class="col-12 col-lg-6">
                            <label for="responsavel-nome-aluno-publico" class="small">Nome do responsável*</label>
                            <input type="text" id="responsavel-nome-aluno-publico" name="responsavel-nome-aluno" class="form-control">
                        </div>

                        <div class="col-12 col-lg-6">
                            <label for="responsavel-telefone-aluno-publico" class="small">Telefone do responsável*</label>
                            <input type="text" id="responsavel-telefone-aluno-publico" name="responsavel-telefone-aluno" oninput="formatarTelefonePublico(this)" maxlength="15" class="form-control" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                </div>

                <h6 class="fw-bold mb-3">Saúde, redes e observações</h6>
                <div class="row g-3 mb-4">
                    <div class="col-12 col-lg-4">
                        <label for="problema-saude-aluno-publico" class="small">Problema de saúde*</label>
                        <select id="problema-saude-aluno-publico" name="problema-saude-aluno" onchange="verificarProblemaSaudePublico()" class="form-control" required>
                            <option value="0">Não</option>
                            <option value="1">Sim</option>
                        </select>
                    </div>

                    <div id="campo-descricao-problema-saude-publico" class="campo-problema-saude-publico d-none col-12 col-lg-8">
                        <label for="descricao-problema-saude-aluno-publico" class="small">Descreva o problema de saúde*</label>
                        <input type="text" id="descricao-problema-saude-aluno-publico" name="descricao-problema-saude-aluno" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label for="facebook-aluno-publico" class="small">Facebook</label>
                        <input type="text" id="facebook-aluno-publico" name="facebook-aluno" class="form-control">
                    </div>

                    <div class="col-12 col-lg-6">
                        <label for="instagram-aluno-publico" class="small">Instagram</label>
                        <input type="text" id="instagram-aluno-publico" name="instagram-aluno" class="form-control">
                    </div>

                    <div class="col-12">
                        <label for="observacoes-aluno-publico" class="small">Observações</label>
                        <textarea id="observacoes-aluno-publico" name="observacoes-aluno" class="form-control" rows="3"></textarea>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-danger">Enviar cadastro</button>
                </div>
            </form>
        </div>
    </div>
</main>

<script>
    function apenasDigitosPublico(valor){
        return (valor || '').replace(/\D/g, '');
    }

    function formatarTelefonePublico(campo){
        let valor = apenasDigitosPublico(campo.value).slice(0, 11);

        if(valor.length <= 10){
            valor = valor.replace(/^(\d{2})(\d)/, '($1) $2');
            valor = valor.replace(/(\d{4})(\d)/, '$1-$2');
        }else{
            valor = valor.replace(/^(\d{2})(\d)/, '($1) $2');
            valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
        }

        campo.value = valor;
    }

    function formatarCepPublico(campo){
        let valor = apenasDigitosPublico(campo.value).slice(0, 8);
        valor = valor.replace(/(\d{5})(\d)/, '$1-$2');
        campo.value = valor;
    }

    function formatarCpfPublico(campo){
        let valor = apenasDigitosPublico(campo.value).slice(0, 11);
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        campo.value = valor;
    }

    function ajustarDocumentoPublico(){
        const tipo = document.getElementById('tipo-documento-aluno-publico');
        const documento = document.getElementById('documento-aluno-publico');

        if(tipo.value === 'cpf'){
            documento.placeholder = '000.000.000-00';
            documento.maxLength = 14;
            formatarCpfPublico(documento);
        }else{
            documento.placeholder = 'Identidade';
            documento.maxLength = 30;
        }
    }

    function formatarDocumentoPublico(campo){
        const tipo = document.getElementById('tipo-documento-aluno-publico');

        if(tipo.value === 'cpf'){
            formatarCpfPublico(campo);
        }
    }

    function verificarMenorIdadePublico(){
        const dataNascimento = document.getElementById('data-nascimento-aluno-publico');
        const bloco = document.getElementById('campos-responsavel-publico');
        const nomeResponsavel = document.getElementById('responsavel-nome-aluno-publico');
        const telefoneResponsavel = document.getElementById('responsavel-telefone-aluno-publico');

        if(!dataNascimento.value){
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

    function verificarProblemaSaudePublico(){
        const select = document.getElementById('problema-saude-aluno-publico');
        const bloco = document.getElementById('campo-descricao-problema-saude-publico');
        const descricao = document.getElementById('descricao-problema-saude-aluno-publico');

        if(select.value === '1'){
            bloco.classList.remove('d-none');
            descricao.required = true;
        }else{
            bloco.classList.add('d-none');
            descricao.required = false;
            descricao.value = '';
        }
    }
</script>

<?php
    function formatarReal($valor) {
        return 'R$ ' . number_format((float) $valor, 2, ',', '.');
    }
?>

<style>
    @media(max-width: 768px){
        .tabela-servicos-valores{
            min-width: 620px;
            white-space: nowrap;
        }

        .scroll-servicos-valores{
            overflow-x: auto;
        }
    }
</style>

<section>
    <h6 class="fw-normal small mb-5">Sessão destinada às configurações gerais do sistema.</h6>

    <div class="card mb-4">
        <div class="card-header d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center">
            <div>
                <h5 class="mb-1">Definir valores dos serviços</h5>
                <p class="small mb-0 text-muted">Cadastre, edite ou exclua os valores cobrados por cada serviço.</p>
            </div>

            <button type="button" class="mt-3 mt-lg-0 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add-servico-valor">
                <i class="me-1 fas fa-plus"></i> Novo valor
            </button>
        </div>

        <div class="card-body">
            <?php if(count($servicos_valores) == 0){ ?>
                <div class="alert alert-danger mb-0" role="alert">
                    <h5 class="alert-heading fw-semibold">Nenhum valor cadastrado!</h5>
                    <p class="small mb-0">Clique no botão acima para definir o primeiro valor de serviço.</p>
                </div>
            <?php }else{ ?>
                <div class="table-responsive scroll-servicos-valores">
                    <table class="table table-striped table-hover align-middle mb-0 tabela-servicos-valores">
                        <thead>
                            <tr>
                                <th scope="col">Descrição</th>
                                <th scope="col">Valor</th>
                                <th scope="col" class="text-lg-end">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($servicos_valores as $servico) { ?>
                                <tr>
                                    <td class="fw-semibold"><?= htmlspecialchars($servico['descricao'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?= formatarReal($servico['valor']); ?></td>
                                    <td>
                                        <div class="d-flex justify-content-start justify-content-lg-end gap-2">
                                            <button type="button" onclick='editarServicoValor(<?= (int) $servico["id"]; ?>, <?= json_encode($servico["descricao"], JSON_HEX_APOS | JSON_HEX_QUOT); ?>, <?= json_encode(formatarReal($servico["valor"]), JSON_HEX_APOS | JSON_HEX_QUOT); ?>)' class="btn btn-success btn-sm">Editar</button>
                                            <button type="button" onclick="deletarServicoValor('<?= $servico['id']; ?>')" class="btn btn-danger btn-sm">Excluir</button>
                                        </div>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </div>
</section>

<script>
    function formatarCampoReal(campo){
        let valor = campo.value.replace(/\D/g, '');

        if(valor === ''){
            campo.value = '';
            return;
        }

        valor = (parseInt(valor, 10) / 100).toFixed(2);
        valor = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        campo.value = 'R$ ' + valor;
    }

    function editarServicoValor(id, descricao, valor){
        document.getElementById('id-servico-valor-editar').value = id;
        document.getElementById('descricao-servico-editar').value = descricao;
        document.getElementById('valor-servico-editar').value = valor;

        var meuModal = new bootstrap.Modal(document.getElementById('editar-servico-valor'));
        meuModal.show();
    }

    function deletarServicoValor(id){
        document.getElementById('id-servico-valor-deletar').value = id;

        var meuModal = new bootstrap.Modal(document.getElementById('deletar-servico-valor'));
        meuModal.show();
    }
</script>

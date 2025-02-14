<style>

</style>



<section>
    <h6 class="fw-normal small mb-5">Sessão destinada à – <span class="fw-bold">editar treino de musculação</span>.</h6>

    <!-- botões e input pesquisa -->
    <div class="mb-4 d-flex flex-column flex-lg-row justify-content-start justify-content-lg-between align-items-start align-items-lg-center mb-3">
        <button type="button" class="mb-3 mb-lg-0 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add-treino-musculacao"><i class="me-1 fas fa-user-plus"></i> Criar treino do aluno </button>
        <a href="<?= $base_url; ?>pages/treinos-musculacao/adicionar-exercicios-musculacao.php" class="btn btn-sm btn-secondary"><i class="me-1 fas fa-book"></i> Cadastrar exercícios da musculação</a>
    </div>

    <form method="get" class="input-group mb-4">
        <input type="text" required class="form-control" name="pesquisa" placeholder="Pesquisar...">
        <button class="btn btn-outline-secondary btn-sm" type="submit">Pesquisar <i class="ms-1 fas fa-search"></i></button>
    </form>
    <!-- botões e input pesquisa -->



    <?php if(count($aluno_treino_musculacao) == 0){ ?>

        <!-- AVISO SEM TREINO CADASTRADO -->
        <div class="alert alert-danger mt-5" role="alert">
            <h5 class="alert-heading fw-semibold">Nenhum treino cadastrado!</h5>
            <p class="small mb-0">Clique no botão acima para criar um novo treino de musculação para o aluno.</p>
        </div>
        <!-- AVISO SEM TREINO CADASTRADO -->

    <?php }else{ ?>

        <!-- ALUNOS TREINOS -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-xxl-3 g-4">
            <?php foreach ($aluno_treino_musculacao as $aluno) { ?>
                <div class="col">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="my-1 card-title"><?= $aluno['nome_aluno']; ?></h5>
                        </div>
                        <div class="card-body">
                            <p class="card-text"><strong>Tipo de Treino:</strong> <?= $aluno['tipo_treino']; ?></p>
                            <p class="card-text"><strong>Modo do Treino:</strong> <?= $aluno['modo_treino']; ?></p>
                            <p class="card-text"><strong>Duração:</strong> <?= $aluno['duracao_treino']; ?></p>
                            <p class="card-text"><strong>Regenerativo:</strong> <?= $aluno['regenerativo'] ?></p>
                            <p class="card-text"><strong>Intervalo:</strong> <?= $aluno['intervalo']; ?></p>

                            <button onclick="copiarLink('<?= $base_url; ?>treino-aluno.php?uid=<?= $aluno['uid']; ?>')" class="btn btn-outline-danger btn-sm">Copiar link do aluno <i class="ms-1 fas fa-hand-pointer"></i></button>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="d-flex flex-column">
                                <small class="mb-2">Criado em: <?= date('d-m-Y', strtotime($aluno['created_at'])); ?></small>
                                <small class="mb-2">Atualizado em: <?= date('d-m-Y', strtotime($aluno['updated_at'])); ?></small>
                            </div>
                            <div class="mt-3 mb-2">
                                <a href="<?= $base_url; ?>pages/treinos-musculacao/editar-treino.php?id=<?= $aluno['id']; ?>" class="btn btn-success btn-sm">Editar</a>
                                <a href="<?= $base_url; ?>pages/treinos-musculacao/exercicios-treino.php?id=<?= $aluno['id']; ?>" class="btn btn-secondary btn-sm">Exercícios</a>
                                <button onclick="deletarAlunoTreino('<?= $base_url; ?>modulos-admin/contents/treinos-musculacao/php/deletar-treino-aluno.php?id=<?= $aluno['id']; ?>')" class="btn btn-danger btn-sm">Excluír</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <!-- ALUNOS TREINOS -->

    <?php } ?>
</section>



<script>
    function deletarAlunoTreino(url){
        document.getElementById("url-deletar-treino").href = url;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-delete-aluno-treino'));
        meuModal.show();
    }

    function copiarLink(url) {
        // Cria um elemento de texto temporário
        var tempInput = document.createElement("input");
        tempInput.style.position = "absolute";
        tempInput.style.left = "-9999px";
        tempInput.value = url;
        document.body.appendChild(tempInput);
        // Seleciona o texto e copia para a área de transferência
        tempInput.select();
        document.execCommand("copy");
        // Remove o elemento de texto temporário
        document.body.removeChild(tempInput);
        // Exibe uma mensagem de confirmação (opcional)
        var meuModal = new bootstrap.Modal(document.getElementById('modal-link-copiado'));
        meuModal.show();
    }
</script>
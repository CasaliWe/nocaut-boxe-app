<style>
    #logo-header-treino-aluno{
        width: 100px;
    }

    ._container-gif-preview{
        width: 90% !important;
        height: 50px !important;
    }
    ._container-gif-preview img{
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;  
        object-position: center;
    }

    ._blocos{
        width: 55% !important;
    }
    ._container-exercicios-aluno{
        width: 100% !important;
        margin-left: auto;
        margin-right: auto;
    }
    ._container-exercicios-aluno-unico{
        width: 50% !important;
        margin-left: auto;
        margin-right: auto;
    }

    @media(min-width:1200px){
        ._container-treinos-aluno{
            max-width: 800px;
        }

        ._container-gif-preview{
            width: 60% !important;
            height: 60px !important;
        }
    }

    @media(max-width:992px){
        ._blocos{
            width: 100% !important;
        }
        ._container-exercicios-aluno-unico{
            width: 95% !important;
        }
    }
    
    .accordion-button:not(.collapsed) {
        color: white !important;
        font-weight: 600 !important;
        background-color: #dc3545 !important;
        box-shadow: inset 0 calc(-1* var(--bs-accordion-border-width)) 0 var(--bs-accordion-border-color);
    }
    .accordion-button:focus {
        z-index: 3;
        border-color: #dc3545 !important;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 70, 0.3);
    }
    .accordion-button:not(.collapsed)::after {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='white' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
        transform: var(--bs-accordion-btn-icon-transform);
    }
</style>


<!-- header -->
<div class="py-3 px-5 bg-dark d-flex justify-content-center align-items-center">
    <img id="logo-header-treino-aluno" src='<?= $base_url ?>assets/imagens/site-admin/logo.png'>
</div>
<!-- header -->

<?php
    if($treino_aluno == null){ ?>
        <h4 class='mb-4 text-center mt-5 text-danger'>Treino não encontrado</h4>
        <p class='w-75 mx-auto text-center text-secondary'>O treino solicitado não foi encontrado ou não há treino disponível no momento. Por favor, verifique novamente sua url ou entre em contato conosco <a href="https://wa.me/5554999919493">Clicando aqui!</a></p>
    <?php exit(); } ?>

<!-- content -->
<main class="_container-treinos-aluno container mx-auto mt-4 pb-5 px-3 px-lg-1">
    <h5 class="text-center mb-3 text-secondary fw-semibold">Aluno: <span class="text-danger"><?= $treino_aluno['nome_aluno']; ?></span></h5>
    <p class="text-center text-secondary mb-5 small">Treino <strong><?= $treino_aluno['tipo_treino']; ?></strong> <br> Modo <strong><?= $treino_aluno['modo_treino']; ?></strong> <br> Duração de <strong><?= $treino_aluno['duracao_treino']; ?></strong> <br> regenerativo de <strong><?= $treino_aluno['regenerativo']; ?></strong> <br> Intervalo de <strong><?= $treino_aluno['intervalo']; ?></strong></p>

    <!-- aviso quando não tem nenhum exercício -->
    <?php if($grupos_treino == []){ ?>
        <h4 class='mb-4 text-center mt-5 text-danger'>Sem exercícios</h4>
    <?php } ?>
    <!-- aviso quando não tem nenhum exercício -->


    <!-- quando for apenas um único bloco -->
    <?php if(count($blocos) == 1){ ?>
        <!-- loop exercícios -->
        <?php foreach ($grupos_treino as $key => $grupo_exercicios) { ?>

            <?php foreach ($grupo_exercicios['exercicios_completos'] as $key => $exercicio) { ?>

                <!-- separando serie da repetição -->
                <?php
                    $serie_repeticao = explode('x', $exercicio['serie_rep']);
                    $serie = $serie_repeticao[0];
                    $repeticao = $serie_repeticao[1];
                ?>
                <!-- separando serie da repetição -->

                <div class="_container-exercicios-aluno-unico row rounded border py-3 px-3 mb-4">
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <div class="_container-gif-preview"><img style="cursor: pointer;" onclick="abrirModalGif('<?= $base_url ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio['exercicio']['gif']; ?>')" src='<?= $base_url ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio['exercicio']['gif']; ?>'></div>
                    </div>
                    
                    <div style="cursor: pointer;" onclick="mudarCargaExercicio('<?= $exercicio['exercicio']['nome']; ?>', '<?= $exercicio['carga']; ?>', '<?= $exercicio['id']; ?>', '<?= $treino_aluno['uid']; ?>')" class="col-9">
                        <h6 class="fw-normal text-secondary"><span class="fw-bold"><?= $grupo_exercicios['nome']; ?></span> | <?= $exercicio['exercicio']['nome']; ?></h6>
                        <div>
                            <span class="small me-3 text-secondary fw-semibold"><i class="text-danger fas fa-layer-group"></i> <?= $serie; ?></span>
                            <span class="small me-3 text-secondary fw-semibold"><i class="text-danger fas fa-sync-alt"></i> <?= $repeticao; ?></span>
                            <span class="small me-0 text-secondary fw-semibold"><i class="text-danger fas fa-weight-hanging"></i> <?= $exercicio['carga']; ?></span>
                        </div>
                    </div>
                </div>

            <?php } ?>

        <?php } ?>
        <!-- loop exercícios -->
    <?php } ?>
    <!-- quando for apenas um único bloco -->


    <!-- loop bloco quando tiver vários -->
    <?php if(count($blocos) > 1){ ?>
        <?php foreach ($blocos as $key => $bloco) { ?>
            <div class="_blocos mx-auto mb-4 item-acordion accordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id-<?= $bloco['identificador']; ?>" aria-expanded="false" aria-controls="id-<?= $bloco['identificador']; ?>">
                            <?= $bloco['nome_bloco']; ?>
                        </button>
                    </h2>
                    <div id="id-<?= $bloco['identificador']; ?>" class="pt-4 accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
            
                            <!-- loop exercícios -->
                            <?php foreach ($grupos_treino as $key => $grupo_exercicios) { ?>

                                <?php foreach ($grupo_exercicios['exercicios_completos'] as $key => $exercicio) { ?>

                                    <?php if($bloco['identificador'] == $grupo_exercicios['bloco']){ ?>
                                        <!-- separando serie da repetição -->
                                        <?php
                                            $serie_repeticao = explode('x', $exercicio['serie_rep']);
                                            $serie = $serie_repeticao[0];
                                            $repeticao = $serie_repeticao[1];
                                        ?>
                                        <!-- separando serie da repetição -->

                                        <div class="_container-exercicios-aluno row rounded border py-3 px-3 mb-4">
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <div class="_container-gif-preview"><img style="cursor: pointer;" onclick="abrirModalGif('<?= $base_url ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio['exercicio']['gif']; ?>')" src='<?= $base_url ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio['exercicio']['gif']; ?>'></div>
                                            </div>
                                            
                                            <div style="cursor: pointer;" onclick="mudarCargaExercicio('<?= $exercicio['exercicio']['nome']; ?>', '<?= $exercicio['carga']; ?>', '<?= $exercicio['id']; ?>', '<?= $treino_aluno['uid']; ?>')" class="col-9">
                                                <h6 class="fw-normal text-secondary"><span class="fw-bold"><?= $grupo_exercicios['nome']; ?></span> | <?= $exercicio['exercicio']['nome']; ?></h6>
                                                <div>
                                                    <span class="small me-3 text-secondary fw-semibold"><i class="text-danger fas fa-layer-group"></i> <?= $serie; ?></span>
                                                    <span class="small me-3 text-secondary fw-semibold"><i class="text-danger fas fa-sync-alt"></i> <?= $repeticao; ?></span>
                                                    <span class="small me-0 text-secondary fw-semibold"><i class="text-danger fas fa-weight-hanging"></i> <?= $exercicio['carga']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                <?php } ?>

                            <?php } ?>
                            <!-- loop exercícios -->
            
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    <!-- loop bloco quando tiver vários -->

</main>
<!-- content -->





<script>
    function abrirModalGif(url){
        document.getElementById('gif-full-screen').src = url;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-gif-full-screen'));
        meuModal.show();
    }

    function mudarCargaExercicio(nome, cargaAtual, id, uid){
        document.getElementById('exercicio-nome').textContent = nome;
        document.getElementById('exercicio-carga').textContent = cargaAtual;
        document.getElementById('id-exercicio').value = id;
        document.getElementById('uid').value = uid;
        var meuModal = new bootstrap.Modal(document.getElementById('alterar-carga-exercicio'));
        meuModal.show();
    }
</script>
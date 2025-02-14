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

    @media(min-width:1200px){
        ._container-treinos-aluno{
            max-width: 800px;
        }

        ._container-exercicios-aluno{
            width: 60% !important;
            margin-left: auto;
            margin-right: auto;
        }

        ._container-gif-preview{
            width: 60% !important;
            height: 60px !important;
        }
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
<main class="_container-treinos-aluno container mx-auto mt-4 pb-5 px-5 px-lg-1">
    <h5 class="text-center mb-3 text-secondary fw-semibold">Aluno: <span class="text-danger"><?= $treino_aluno['nome_aluno']; ?></span></h5>
    <p class="text-center text-secondary mb-5 small">Treino <strong><?= $treino_aluno['tipo_treino']; ?></strong> <br> Modo <strong><?= $treino_aluno['modo_treino']; ?></strong> <br> Duração de <strong><?= $treino_aluno['duracao_treino']; ?></strong> <br> regenerativo de <strong><?= $treino_aluno['regenerativo']; ?></strong> <br> Intervalo de <strong><?= $treino_aluno['intervalo']; ?></strong></p>

    <?php if($grupos_treino == []){ ?>
        <h4 class='mb-4 text-center mt-5 text-danger'>Sem exercícios</h4>
    <?php } ?>

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
    <!-- loop exercícios -->

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
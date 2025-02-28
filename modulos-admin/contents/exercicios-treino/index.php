<style>
    .container-exercicios-card{
        width: 90% !important;
    }

    @media (min-width:1500px) {
        .container-exercicios-card{
            width: 70% !important;
        }
    }

    @media (max-width:992px) {
        .container-exercicios-card{
            width: 100% !important;
        }

        .btn-add-grupo-exercicio{
            width: 30% !important;
            margin-top: 15px !important;
        }

        #exercicios-treino-aluno-container{
            width: 650px !important;
        }
    }
</style>



<section>
    <h6 class="fw-normal small mb-5">Sessão destinada à gerenciar os exercícios <span class="fw-bold">dos treinos</span> de cada aluno.</h6>
    
    <div class="container-exercicios-card d-flex flex-column flex-lg-row align-items-start align-items-lg-center justify-content-between mb-5">
        <button type="button" class="btn btn-sm btn-danger mb-3 mb-lg-0" data-bs-toggle="modal" data-bs-target="#adicionar-bloco-exercicio"><i class="me-0 me-lg-2 fas fa-plus"></i> Adicionar bloco de exercícios</button>
        <a href="<?= $base_url; ?>pages/treinos-musculacao/treinos-musculacao.php" class="btn-sm btn btn-secondary px-3"><i class="me-1 fas fa-arrow-left"></i> Voltar</a>
    </div>

    <div class="mb-5">
        <h6 class="small fw-normal">Aluno: <span class="fw-bold text-danger"><?= $treino_aluno['nome_aluno']; ?></span></h6>
        <h6 class="small fw-normal">Modo do treino: <span class="fw-bold text-danger"><?= $treino_aluno['modo_treino']; ?></span></h6>
    </div>

    <?php foreach ($blocos as $key => $bloco) { ?>
        <div class="card mb-5 container-exercicios-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title my-1 d-flex justify-content-start align-items-center"><?= $bloco['nome_bloco']; ?></h5>
                <div>
                    <i style="cursor: pointer;" onclick="editarBloco('<?= $bloco['nome_bloco']; ?>', '<?= $bloco['identificador'] ?>', '<?= $_GET['id']; ?>')" class="fas fa-edit me-2"></i>
                    <i style="cursor: pointer;" onclick="deletarBloco('<?= $bloco['identificador'] ?>', '<?= $_GET['id']; ?>')" class="fas fa-trash"></i>
                </div>
            </div>
            <div class="card-body py-4">
                
                <!-- adicionar grupo -->
                <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/adicionar-grupo-treino.php" method="post" class="mb-5 d-flex justify-content-between align-items-end">
                    <input type="hidden" name="id" value="<?= $treino_aluno['id']; ?>">
                    <input type="hidden" name="identificador-bloco" value="<?= $bloco['identificador']; ?>">

                    <div class='w-100'>
                    <label for='grupo' class="small">Selecione o Grupo de exercício*</label>
                    <select name="grupo" id="grupo" class='form-control' required>
                        <option disabled>Selecione</option>
                        <?php foreach ($exercicios_grupos as $key => $grupo) { ?>
                            <option value="<?= $grupo['id']; ?>"><?= $grupo['nome']; ?></option>
                        <?php } ?>
                    </select>
                    </div>

                    <button class="btn-add-grupo-exercicio ms-2 ms-lg-3 py-2 text-center d-flex justify-content-center align-items-center btn btn-sm btn-danger"><i class="me-0 me-lg-2 fas fa-plus"></i> <span class="d-none d-lg-block">Adicionar</span></button>
                </form>
                <!-- adicionar grupo -->

                
                <!-- listar grupos -->
                <?php foreach ($grupos_treino as $key => $grupo) { ?>
                    <?php if($grupo['grupo_nome']['identificador_bloco'] == $bloco['identificador']){ ?>
                        <div class="mb-4 item-acordion accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header d-flex justify-content-between align-items-center">
                                    <button class="pe-1 accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#exibi-grupo-treino-aluno-<?= $grupo['grupo_nome']['id']; ?>-<?= $grupo['grupo_nome']['identificador_bloco'] ?>" aria-expanded="false" aria-controls="exibi-grupo-treino-aluno-<?= $grupo['grupo_nome']['id']; ?>-<?= $grupo['grupo_nome']['identificador_bloco'] ?>">
                                        <?= $grupo['grupo_nome']['nome']; ?>
                                    </button>

                                    <div style="cursor: pointer;" class="dropdown ms-3 me-3" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v" style="font-size: .7em;"></i>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a onclick="deletarGrupo('<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/deletar-grupo-completo.php?id=<?= $grupo['id_grupo_treino']; ?>&id-treino=<?= $_GET['id']; ?>')" class="dropdown-item">Deletar</a></li>
                                        </ul>
                                    </div>
                                </h2>
                                <div id="exibi-grupo-treino-aluno-<?= $grupo['grupo_nome']['id']; ?>-<?= $grupo['grupo_nome']['identificador_bloco'] ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body" style="overflow-x: auto;">
                        
                                        <!-- botão para adicionar exercício -->
                                        <?php 
                                            $exercicios_json = htmlspecialchars(json_encode($grupo['exercicios_grupo']), ENT_QUOTES, 'UTF-8');
                                        ?>
                                        <button onclick="abrirModalExercicioGrupo('<?= $grupo['id_grupo_treino']; ?>', '<?= $exercicios_json; ?>')" class="mt-3 mb-3 btn btn-danger btn-sm"><i class="me-2 fas fa-plus"></i> Adicionar exercício</button>
                                        <!-- botão para adicionar exercício -->


                                        <!-- listar exercícios -->
                                        <?php if(count($grupo['grupo_nome']['exercicios_completos']) == 0){ ?>
                                            <div class="alert alert-danger mt-2" role="alert">
                                                <p class="small mb-0">Nenhum exercício adicionado.</p>
                                            </div>
                                        <?php }else{ ?>
                                            <div class="mt-2" id="exercicios-treino-aluno-container">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Nome do Exercício</th>
                                                            <th scope="col">Série X Rep</th>
                                                            <th scope="col">Carga</th>
                                                            <th scope="col">Gif</th>
                                                            <th scope="col" class="text-end">Ação</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($grupo['grupo_nome']['exercicios_completos'] as $key => $exercicio_completo) { ?>                                                 
                                                            <tr>
                                                                <td><?= $exercicio_completo['exercicio']['nome']; ?></td>
                                                                <td><?= $exercicio_completo['serie_rep']; ?></td>
                                                                <td><?= $exercicio_completo['carga']; ?></td>
                                                                <td><button onclick="abrirModalExibirGif('<?= $base_url; ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio_completo['exercicio']['gif']; ?>')" class="btn btn-warning btn-sm">Visualizar gif</button></td>
                                                                <td class="text-end">
                                                                    <i onclick="deletarExercicioFinalTreino('<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/deletar-exercicio-completo.php?id=<?= $exercicio_completo['id']; ?>&id-treino=<?= $_GET['id']; ?>')" style="cursor: pointer;"class="fas fa-trash"></i>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        <?php } ?>
                                        <!-- listar exercícios -->
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
                <!-- listar grupos -->

            </div>
        </div>
    <?php } ?>

    <!-- mensagem de aviso caso não tenha blocos cadastrados -->
    <?php if(count($blocos) == 0){ ?>
        <div class="alert alert-danger mt-5" role="alert">
            <p class="small mb-0">Nenhum grupo de exercício cadastrado.</p>
        </div>
    <?php } ?>
    <!-- mensagem de aviso caso não tenha blocos cadastrados -->

</section>



<script>
    function abrirModalExibirGif(url){
        document.getElementById('gif-full-screen').src = url;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-gif-full-screen'));
        meuModal.show();
    }

    

    function abrirModalExercicioGrupo(id, exerciciosGrupo){
        var exercicios = JSON.parse(exerciciosGrupo);

        document.getElementById("id_grupo_treino").value = id;

        document.getElementById('select-exercicio-modal').innerHTML = ''

        exercicios.forEach(exercicio => {
            document.getElementById('select-exercicio-modal').innerHTML += `<option value="${exercicio.id}">${exercicio.nome}</option>`;
        });

        var meuModal = new bootstrap.Modal(document.getElementById('adicionar-exercicio-grupo'));
        meuModal.show();
    }

    
    function deletarExercicioFinalTreino(url){
        document.getElementById('url-deletar-exercicio-completo').href = url;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-deletar-exercicio-completo'));
        meuModal.show();
    }


    function deletarGrupo(url){
        document.getElementById('url-deletar-grupo-completo').href = url;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-deletar-grupo-completo'));
        meuModal.show();
    }


    function deletarBloco(identifcador, idRetorno){
        document.getElementById('id-bloco-deletar').value = identifcador;
        document.getElementById('id-retorno').value = idRetorno;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-deletar-bloco'));
        meuModal.show();
    }
    
    function editarBloco(nome, identifcador, idRetorno){
        document.getElementById('id-bloco-editar').value = identifcador;
        document.getElementById('id-retorno-editar').value = idRetorno;
        document.getElementById('identificador-editar').value = nome;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-editar-bloco'));
        meuModal.show();
    }
</script>
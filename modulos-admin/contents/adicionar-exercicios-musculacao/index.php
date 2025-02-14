<style>
    .container-gif-exercicio{
        width: 35px;
        height: 50px;
        overflow: hidden;
        background-color: red;
    }
    .container-gif-exercicio img{
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center;
    }

    @media(max-width:992px){
        ._btn-criar-exercicio{
            width: 100% !important;
        }

        ._container-tabela-exercicios{
            overflow-x: auto !important;
            width: 100% !important;
        }
        ._tabela-exercicios{
            width: 500px !important;
        }
    }
</style>



<section>
    <h6 class="fw-normal small mb-4">Sessão destinada à cadastrar novos exercícios <span class="fw-bold">dos treinos de musculação</span>.</h6>

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-5">
        <button type="button" class="mb-3 mb-lg-0 btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#add-grupo"><i class="me-2 fas fa-book"></i> Cadastrar novo Grupo de exercício</button>
        <a href="<?= $base_url; ?>pages/treinos-musculacao/treinos-musculacao.php" class="btn btn-secondary btn-sm px-4"><i class="me-2 fas fa-backward"></i> Voltar</a>
    </div>


    <?php if (count($exercicios_grupos) == 0) { ?>
        <div class="alert alert-danger" role="alert">
            Nenhum grupo de exercício cadastrado.
        </div>
    <?php } ?>

    <?php foreach ($exercicios_grupos as $key => $grupo) { ?>
        <div class="mb-4 item-acordion accordion">
            <div class="accordion-item">
                <h2 class="accordion-header d-flex justify-content-between align-items-center">
                    <button class="pe-1 accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#grupo-exercicio-<?= $grupo['id']; ?>" aria-expanded="false" aria-controls="grupo-exercicio-<?= $grupo['id']; ?>">
                        <?= $grupo['nome']; ?>
                    </button>

                    <div style="cursor: pointer;" class="dropdown ms-3 me-3" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-ellipsis-v" style="font-size: .7em;"></i>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a onclick="editarGrupo('<?= $grupo['id']; ?>', '<?= $grupo['nome']; ?>')" class="dropdown-item">Editar</a></li>
                            <li><a onclick="deletarGrupo('<?= $grupo['id']; ?>')" class="dropdown-item">Deletar</a></li>
                        </ul>
                    </div>
                </h2>
                <div id="grupo-exercicio-<?= $grupo['id']; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body py-4">
        
                        <!-- ADICIONAR EXERCÍCIOS -->
                        <form class="pb-4 border-bottom" action="<?= $base_url; ?>modulos-admin/contents/adicionar-exercicios-musculacao/php/add-exercicio.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="grupo_id" value="<?= $grupo['id']; ?>">
                        
                            <div class='mb-3'>
                              <label for='nome' class="small">Nome do exercício*</label>
                              <input type='text' id='nome' name='nome' placeholder='Ex: Bíceps...' class='form-control' required>
                            </div>

                            <div class='mb-4'>
                              <label for='gif' class="small">Gif do exercício*</label>
                              <input type='file' id='gif' name='gif' class='form-control' required>
                            </div>

                            <div>
                                <button class="btn btn-danger btn-sm px-x _btn-criar-exercicio"><i class="me-2 fas fa-plus"></i> Adicionar exercício</button>
                            </div>
                        </form>
                        <!-- ADICIONAR EXERCÍCIOS -->

                        
                        <!-- EXERCÍCIOS -->
                        <?php if (count($grupo['exercicios']) == 0) { ?>
                            <div class="alert alert-danger" role="alert">
                                Nenhum exercício cadastrado.
                            </div>
                        <?php }else {?>
                            <div class="mt-5 _container-tabela-exercicios">
                                <table class="table table-striped _tabela-exercicios">
                                    <thead>
                                        <tr>
                                            <th scope="col-6">Nome do Exercício</th>
                                            <th scope="col-4">Gif</th>
                                            <th scope="col-2" class="text-end">Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($grupo['exercicios'] as $exercicio) { ?>
                                            <tr>
                                                <td><?= $exercicio['nome']; ?></td>
                                                <td><button onclick="abrirModalExibirGif('<?= $base_url; ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio['gif']; ?>')" class="btn btn-warning btn-sm">Visualizar gif</button></td>
                                                <td class="text-end">
                                                    <i style="cursor: pointer;" onclick="editarExercicio('<?= $exercicio['id']; ?>','<?= $exercicio['nome']; ?>','<?= $base_url; ?>assets/imagens/arquivos/gifs-musculacao/<?= $exercicio['gif']; ?>', '<?= $exercicio['gif']; ?>')" class="fas fa-edit me-2"></i> 
                                                    <i style="cursor: pointer;" onclick="deletarExercicio('<?= $base_url; ?>modulos-admin/contents/adicionar-exercicios-musculacao/php/delete-exercicio.php?id=<?= $exercicio['id']; ?>&gif=<?= $exercicio['gif']; ?>')" class="fas fa-trash"></i>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>
                        <!-- EXERCÍCIOS -->

        

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>



<script>
    function abrirModalExibirGif(url){
            document.getElementById('gif-full-screen').src = url;
            var meuModal = new bootstrap.Modal(document.getElementById('modal-gif-full-screen'));
            meuModal.show();
    }

    function editarExercicio(id, nome, gif, gifDeletar){
        document.getElementById('id-exercicio-editar').value = id;
        document.getElementById('gif-exercicio-deletar').value = gifDeletar;
        document.getElementById('nome-exercicio-editar').value = nome;
        document.getElementById('gif-exercicio-editar').src = gif;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-editar-exercicio'));
        meuModal.show();
    }
    
    function deletarExercicio(url){
        document.getElementById('url-deletar-exercicio').href = url;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-deletar-exercicio'));
        meuModal.show();
    }

    function editarGrupo(id, nome){
        document.getElementById('id-grupo-editar').value = id;
        document.getElementById('nome-grupo-editar').value = nome;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-editar-grupo'));
        meuModal.show();
    }

    function deletarGrupo(id){
        document.getElementById('id-deletar').value = id;
        var meuModal = new bootstrap.Modal(document.getElementById('modal-deletar-grupo'));
        meuModal.show();
    }
</script>
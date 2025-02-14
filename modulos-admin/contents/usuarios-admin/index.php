<style>
    @media(max-width:992px){
        #header-acordeon{
            font-size: 12px !important;
        }
    }
</style>



<section>
    <h6 class="fw-normal small mb-5">Sessão destinada à gestão dos usuários do sistema – <span class="fw-bold">criar, editar, remover</span>.</h6>

    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center mb-5 w-100">
        <button type="button" class="mb-3 mb-lg-0 btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#add-usuario-sistema"><i class="me-1 fas fa-user-plus"></i> Criar novo usuário do sistema </button>
        <a href="<?= $base_url; ?>pages/treinos-musculacao/treinos-musculacao.php" class="btn btn-sm btn-secondary"> <i class="me-2 fas fa-backward"></i> Voltar </a>
    </div>

    <?php foreach ($usuarios as $key => $user) { ?>
        <div class="mb-4 item-acordion accordion">
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button id="header-acordeon" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id-user-<?= $user['id']; ?>" aria-expanded="false" aria-controls="id-user-<?= $user['id']; ?>">
                        <span class="fw-bold me-2 text-uppercase"><?= $user['tipo']; ?></span> - <?= $user['nome']; ?>
                    </button>
                </h2>
                <div id="id-user-<?= $user['id']; ?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
         
                        <form action="<?= $base_url; ?>modulos-admin/contents/usuarios-admin/php/update-usuario.php" method="post">
                            <input type="hidden" name="id-user" value="<?= $user['id']; ?>">
                        
                            <div class='mb-3'>
                              <label for='nome-<?= $user['id']; ?>' class="small">Nome do usuário*</label>
                              <input type='text' id='nome-<?= $user['id']; ?>' name='nome' value="<?= $user['nome']; ?>" class='form-control' required>
                            </div>

                            <div class='mb-3'>
                              <label for='tipo-<?= $user['id']; ?>' class="small">Tipo de usuário*</label>
                                <select name="tipo" id="tipo-<?= $user['id']; ?>" class='form-control' required>
                                    <option value="administrador" <?= $user['tipo'] == 'administrador' ? 'selected' : '' ?>>administrador</option>
                                    <option value="colaborador" <?= $user['tipo'] == 'colaborador' ? 'selected' : '' ?>>colaborador</option>
                                </select>
                            </div>

                            <div class='mb-3'>
                              <label for='login-<?= $user['id']; ?>' class="small">Login do usuário*</label>
                              <input type='text' id='login-<?= $user['id']; ?>' name='login' value="<?= $user['login']; ?>" class='form-control' required>
                            </div>

                            <div class='mb-3'>
                              <label for='senha-<?= $user['id']; ?>' class="small">Senha do usuário*</label>
                              <input type='password' id='senha-<?= $user['id']; ?>' name='senha' value="<?= $user['senha']; ?>" class='form-control' required>
                            </div>

                            <div class="d-flex mt-4">
                                <button type="submit" class="me-2 btn btn-danger btn-sm">Atualizar dados</button>
                                <button type="button" onclick="deletarUser('<?= $user['id']; ?>')" class="btn btn-secondary btn-sm">Deletar usuário</button>
                            </div>
                        </form>
         
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</section>



<script>
    function deletarUser(id) {
        document.getElementById('id-user-deletar').value = id;
        var meuModal = new bootstrap.Modal(document.getElementById('aviso-delete-user'));
        meuModal.show();
    }
</script>
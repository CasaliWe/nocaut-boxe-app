<div class="modal fade" id="aviso-delete-user" tabindex="-1" aria-labelledby="aviso-delete-user" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar usuário</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= $base_url; ?>modulos-admin/contents/usuarios-admin/php/delete-user.php" method="post">
          <div class="modal-body">
          
            <p class="fs-6">Tem certeza que deseja deletar o usuário?</p>
            <input type="hidden" name="id-user" id="id-user-deletar">

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Deletar</button>
          </div>
      </form>
    </div>
  </div>
</div>
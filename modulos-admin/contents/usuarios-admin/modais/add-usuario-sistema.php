<div class="modal fade" id="add-usuario-sistema" tabindex="-1" aria-labelledby="add-usuario-sistema" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Criar novo usuário do sistema</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="<?= $base_url; ?>modulos-admin/contents/usuarios-admin/php/create-user-admin.php" method="post">
          <div class="modal-body">
          
          <div class='mb-3'>
              <label for='nome' class="small">Nome do usuário*</label>
                <input type='text' id='nome' name='nome' class='form-control' required>
              </div>

              <div class='mb-3'>
                <label for='tipo' class="small">Tipo de usuário*</label>
                  <select name="tipo" id="tipo" class='form-control' required>
                      <option value="administrador" selected>administrador</option>
                      <option value="colaborador">colaborador</option>
                  </select>
              </div>

              <div class='mb-3'>
                <label for='login' class="small">Login do usuário*</label>
                <input type='text' id='login' name='login' class='form-control' required>
              </div>

              <div class='mb-3'>
                <label for='senha' class="small">Senha do usuário*</label>
                <input type='password' id='senha' name='senha' class='form-control' required>
              </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Criar</button>
          </div>
      </form>
    </div>
  </div>
</div>
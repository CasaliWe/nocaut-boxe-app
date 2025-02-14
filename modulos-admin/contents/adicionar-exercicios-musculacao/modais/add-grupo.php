<div class="modal fade" id="add-grupo" tabindex="-1" aria-labelledby="add-grupo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Cadastrar novo Grupo de exercício</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/adicionar-exercicios-musculacao/php/add-grupo.php" method="post">
          
          <div class="modal-body">
          
                <div class='mb-3'>
                    <label for='nome' class="small">Nome do Grupo*</label>
                    <input type='text' id='nome' name='nome' placeholder='Ex: Braço' class='form-control' required>
                </div>
          
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Adicionar</button>
          </div>
      </form>
    </div>
  </div>
</div>
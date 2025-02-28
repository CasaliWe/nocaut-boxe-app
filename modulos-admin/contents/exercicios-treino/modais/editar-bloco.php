<div class="modal fade" id="modal-editar-bloco" tabindex="-1" aria-labelledby="modal-editar-bloco" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar bloco</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/editar-bloco.php" method="post">
              <div class="modal-body">
                <input type="hidden" id="id-bloco-editar" name="id-bloco-editar">
                <input type="hidden" id="id-retorno-editar" name="id-retorno-editar">
                <div class='mb-3'>
                  <label for='identificador-editar'>Identificador do bloco*</label>
                  <input type='text' id='identificador-editar' name='identificador-editar' class='form-control' required>
                </div>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-danger">Editar</button>
              </div>
          </form>
    </div>
  </div>
</div>
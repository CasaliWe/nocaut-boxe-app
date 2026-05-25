<div class="modal fade" id="editar-servico-valor" tabindex="-1" aria-labelledby="editar-servico-valor" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar valor de serviço</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/configuracoes/php/update-servico-valor.php" method="post">
          <input type="hidden" id="id-servico-valor-editar" name="id-servico-valor">

          <div class="modal-body">

              <div class='mb-3'>
                <label for='descricao-servico-editar' class="small">Descrição*</label>
                <input type='text' id='descricao-servico-editar' name='descricao' class='form-control' required>
              </div>

              <div class='mb-3'>
                <label for='valor-servico-editar' class="small">Valor*</label>
                <input type='text' id='valor-servico-editar' name='valor' class='form-control input-real' inputmode='numeric' oninput='formatarCampoReal(this)' required>
              </div>

          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Atualizar</button>
          </div>
      </form>
    </div>
  </div>
</div>

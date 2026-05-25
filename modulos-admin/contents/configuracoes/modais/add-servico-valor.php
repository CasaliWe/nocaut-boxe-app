<div class="modal fade" id="add-servico-valor" tabindex="-1" aria-labelledby="add-servico-valor" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Novo valor de serviço</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/configuracoes/php/create-servico-valor.php" method="post">
          <div class="modal-body">

              <div class='mb-3'>
                <label for='descricao-servico' class="small">Descrição*</label>
                <input type='text' id='descricao-servico' name='descricao' placeholder='Ex: Boxe...' class='form-control' required>
              </div>

              <div class='mb-3'>
                <label for='valor-servico' class="small">Valor*</label>
                <input type='text' id='valor-servico' name='valor' placeholder='Ex: R$ 150,00' class='form-control input-real' inputmode='numeric' oninput='formatarCampoReal(this)' required>
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

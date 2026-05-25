<div class="modal fade" id="deletar-servico-valor" tabindex="-1" aria-labelledby="deletar-servico-valor" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Excluir valor de serviço</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/configuracoes/php/delete-servico-valor.php" method="post">
          <input type="hidden" id="id-servico-valor-deletar" name="id-servico-valor">

          <div class="modal-body">
            <p class="fs-6 mb-0">Tem certeza que deseja excluir este valor de serviço?</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Excluir</button>
          </div>
      </form>
    </div>
  </div>
</div>

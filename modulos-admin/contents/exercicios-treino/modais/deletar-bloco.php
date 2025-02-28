<div class="modal fade" id="modal-deletar-bloco" tabindex="-1" aria-labelledby="modal-deletar-bloco" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Deletar bloco</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
          <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/deletar-bloco.php" method="post">
              <div class="modal-body">
                <input type="hidden" name="identificador" id="id-bloco-deletar" value="">
                <input type="hidden" name="retorno" id="id-retorno" value="">
                <p class="fs-6">Tem certeza que deseja deletar este bloco de exercício?</p>
              
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-danger">Deletar</button>
              </div>
          </form>
    </div>
  </div>
</div>
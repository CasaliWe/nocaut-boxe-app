<div class="modal fade" id="alterar-carga-exercicio" tabindex="-1" aria-labelledby="alterar-carga-exercicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Alterar carga do exercício</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/treino-aluno/php/alterar-carga-exercicio.php" method="post">

          <div class="modal-body">
             
                <!-- recebe o id para atualizar a carga -->
                <input type="hidden" id="id-exercicio" name="id">

                <!-- recebe o uid para retorno da página -->
                <input type="hidden" id="uid" name="uid">

                <h6>Exercício: <span id="exercicio-nome" class="fw-semibold"> </span></h6>
                <h6 class="mb-4">Carga atual: <span id="exercicio-carga" class="fw-semibold"> </span></h6>

                <!-- recebe a carga -->
                <div class='mb-3'>
                  <label for='carga' class="small">Altera carga para:</label>
                  <select id='carga' name='carga'  class='form-control' required>
                    <option value='Máx' selected>Máx</option>
                    <option value='Livre'>Livre</option>
                    <?php for($peso = 1; $peso <= 100; $peso++){ ?>
                      <option value='<?= $peso; ?>kg'><?= $peso; ?>kg</option>
                    <?php } ?>
                  </select>
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

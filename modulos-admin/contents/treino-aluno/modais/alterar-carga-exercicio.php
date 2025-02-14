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
                    <option value='1kg'>1kg</option>
                    <option value='2kg'>2kg</option>
                    <option value='3kg'>3kg</option>
                    <option value='4kg'>4kg</option>
                    <option value='5kg'>5kg</option>
                    <option value='6kg'>6kg</option>
                    <option value='7kg'>7kg</option>
                    <option value='8kg'>8kg</option>
                    <option value='9kg'>9kg</option>
                    <option value='10kg'>10kg</option>
                    <option value='15kg'>15kg</option>
                    <option value='20kg'>20kg</option>
                    <option value='25kg'>25kg</option>
                    <option value='30kg'>30kg</option>
                    <option value='35kg'>35kg</option>
                    <option value='40kg'>40kg</option>
                    <option value='45kg'>45kg</option>
                    <option value='50kg'>50kg</option>
                    <option value='55kg'>55kg</option>
                    <option value='60kg'>60kg</option>
                    <option value='65kg'>65kg</option>
                    <option value='70kg'>70kg</option>
                    <option value='75kg'>75kg</option>
                    <option value='80kg'>80kg</option>
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
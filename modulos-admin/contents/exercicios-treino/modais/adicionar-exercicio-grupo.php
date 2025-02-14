<div class="modal fade" id="adicionar-exercicio-grupo" tabindex="-1" aria-labelledby="adicionar-exercicio-grupo" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Adicionar exercício ao grupo</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/adicionar-exercicio-treino-grupo.php" method="post">

          <div class="modal-body">
             
                <!-- recebe o id do grupo fk -->
                <input type="hidden" id="id_grupo_treino" name="id">

                <!-- recebe o id do aluno treino passado no GET para retorno -->
                <input type="hidden" name="aluno_treino_id" value="<?= $_GET['id']; ?>">

                <!-- recebe os exercicios -->
                <div class='mb-3'>
                  <label for='select-exercicio-modal' class="small">Exercício</label>
                  <select id='select-exercicio-modal' name='exercicio'  class='form-control' required>
                    
                        <!-- vem do js -->

                  </select>
                </div>

                <!-- recebe a carga -->
                <div class='mb-3'>
                  <label for='carga' class="small">Carga</label>
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


                <div class='mb-3'>
                  <label for='serie_rep' class="small">Série x Repetição*</label>
                  <select id='serie_rep' name='serie_rep' class='form-control' required>
                    <option value='3x15'>3x15</option>
                    <option value='3x12'>3x12</option>
                    <option value='3x10'>3x10</option>
                    <option value='3x8'>3x8</option>
                    <option value='3x6'>3x6</option>
                    <option value='3x4'>3x4</option>
                    <option value='4x15'>4x15</option>
                    <option value='4x12'>4x12</option>
                    <option value='4x10'>4x10</option>
                    <option value='4x8'>4x8</option>
                    <option value='4x6'>4x6</option>
                    <option value='4x4'>4x4</option>
                  </select>
                </div>
          
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Salvar</button>
          </div>
      </form>
    </div>
  </div>
</div>
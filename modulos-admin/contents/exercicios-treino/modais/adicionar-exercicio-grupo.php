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
                    <option value='Livre'>Livre</option>
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
                    <option value='45 seg'>45 seg</option>
                    <option value='1 min'>1 min</option>
                    <option value='1:30 min'>1:30 min</option>
                    <option value='1x'>1x</option>
                    <option value='2x'>2x</option>
                    <option value='3x'>3x</option>
                    <option value='4x'>4x</option>
                    <option value='5x'>5x</option>
                    <option value='6x'>6x</option>
                    <option value='7x'>7x</option>
                    <option value='8x'>8x</option>
                    <option value='9x'>9x</option>
                    <option value='10x'>10x</option>
                    <option value='11x'>11x</option>
                    <option value='12x'>12x</option>
                    <option value='13x'>13x</option>
                    <option value='14x'>14x</option>
                    <option value='15x'>15x</option>
                    <option value='16x'>16x</option>
                    <option value='17x'>17x</option>
                    <option value='18x'>18x</option>
                    <option value='19x'>19x</option>
                    <option value='20x'>20x</option>
                    <option value='21x'>21x</option>
                    <option value='22x'>22x</option>
                    <option value='23x'>23x</option>
                    <option value='24x'>24x</option>
                    <option value='25x'>25x</option>
                    <option value='26x'>26x</option>
                    <option value='27x'>27x</option>
                    <option value='28x'>28x</option>
                    <option value='29x'>29x</option>
                    <option value='30x'>30x</option>
                    <option value='31x'>31x</option>
                    <option value='32x'>32x</option>
                    <option value='33x'>33x</option>
                    <option value='34x'>34x</option>
                    <option value='35x'>35x</option>
                    <option value='36x'>36x</option>
                    <option value='37x'>37x</option>
                    <option value='38x'>38x</option>
                    <option value='39x'>39x</option>
                    <option value='40x'>40x</option>
                    <option value='41x'>41x</option>
                    <option value='42x'>42x</option>
                    <option value='43x'>43x</option>
                    <option value='44x'>44x</option>
                    <option value='45x'>45x</option>
                    <option value='46x'>46x</option>
                    <option value='47x'>47x</option>
                    <option value='48x'>48x</option>
                    <option value='49x'>49x</option>
                    <option value='50x'>50x</option>
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
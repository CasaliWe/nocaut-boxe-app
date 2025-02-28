<div class="modal fade" id="add-treino-musculacao" tabindex="-1" aria-labelledby="add-treino-musculacao" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Novo treino de musculação</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/treinos-musculacao/php/adicionar-aluno-treino.php" method="post">
          <div class="modal-body">
          
              <div class='mb-3'>
                <label for='nome-aluno' class="small">Nome do aluno*</label>
                <input type='text' id='nome-aluno' name='nome-aluno' placeholder='Ex: João Pedro...' class='form-control' required>
              </div>

              <div class='mb-3'>
                <label for='tipo-treino' class="small">Tipo do treino*</label>
                <select id='tipo-treino' name='tipo-treino' class='form-control' required>
                  <option value='Iniciante'>Iniciante</option>
                  <option value='Intermediário'>Intermediário</option>
                  <option value='Avançado'>Avançado</option>
                </select>
              </div>

              <div class='mb-3'>
                <label for='duracao-treino' class="small">Duração do treino*</label>
                <select id='duracao-treino' name='duracao-treino' class='form-control' required>
                  <option value='1 semana'>1 semana</option>
                  <option value='2 semanas'>2 semanas</option>
                  <option value='3 semanas'>3 semanas</option>
                  <option value='4 semanas'>4 semanas</option>
                  <option value='5 semanas'>5 semanas</option>
                  <option value='6 semanas'>6 semanas</option>
                  <option value='7 semanas'>7 semanas</option>
                  <option value='8 semanas'>8 semanas</option>
                  <option value='9 semanas'>9 semanas</option>
                  <option value='10 semanas'>10 semanas</option>
                  <option value='11 semanas'>11 semanas</option>
                  <option value='12 semanas'>12 semanas</option>
                  <option value='13 semanas'>13 semanas</option>
                  <option value='14 semanas'>14 semanas</option>
                  <option value='15 semanas'>15 semanas</option>
                  <option value='16 semanas'>16 semanas</option>
                  <option value='17 semanas'>17 semanas</option>
                  <option value='18 semanas'>18 semanas</option>
                  <option value='19 semanas'>19 semanas</option>
                  <option value='20 semanas'>20 semanas</option>
                </select>
              </div>

              <div class='mb-3'>
                <label for='regenerativo' class="small">Regenerativo*</label>
                <select id='regenerativo' name='regenerativo' class='form-control' required>
                  <option value='1 semana'>1 semana</option>
                </select>
              </div>

              <div class='mb-3'>
                <label for='modo_treino' class="small">Modo do treino*</label>
                <select id='modo_treino' name='modo_treino' class='form-control' required>
                  <option value='Normal'>Normal</option>
                  <option value='Bi-set'>Bi-set</option>
                  <option value='Tri-set'>Tri-set</option>
                </select>
              </div>
              
              <div class='mb-3'>
                <label for='intervalo' class="small">Intervalo entre os exercícios*</label>
                <select id='intervalo' name='intervalo' class='form-control' required>
                  <option value='45 segundos'>45 segundos</option>
                  <option value='01:00 minuto'>01:00 minuto</option>
                  <option value='01:30 minutos'>01:30 minutos</option>
                </select>
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
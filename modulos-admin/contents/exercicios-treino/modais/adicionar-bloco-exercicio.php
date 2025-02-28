<div class="modal fade" id="adicionar-bloco-exercicio" tabindex="-1" aria-labelledby="adicionar-bloco-exercicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Adicionar bloco de exercícios</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/exercicios-treino/php/adicionar-bloco-exercicio.php" method="post">

          <div class="modal-body">
                <!-- recebe o id do aluno treino passado no GET para retorno e fk -->
                <input type="hidden" name="aluno_treino_id" value="<?= $_GET['id']; ?>">

                <!-- input para o nome do bloco -->
                <div class='mb-3'>
                  <label for='nome-bloco' class="small">Identificador para o bloco*</label>
                  <input type="text" class="form-control" id="nome-bloco" name="nome-bloco" placeholder="Ex: Treino 1..." required>
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
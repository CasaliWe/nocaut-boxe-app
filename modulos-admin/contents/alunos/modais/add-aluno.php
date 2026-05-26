<div class="modal fade" id="add-aluno" tabindex="-1" aria-labelledby="add-aluno" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/alunos/php/create-aluno.php" method="post" class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Cadastrar aluno</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <?php
            $contexto = 'add';
            include __DIR__ . '/form-aluno.php';
          ?>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-danger">Cadastrar</button>
        </div>
    </form>
  </div>
</div>

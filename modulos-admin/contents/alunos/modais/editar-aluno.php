<div class="modal fade" id="editar-aluno" tabindex="-1" aria-labelledby="editar-aluno" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/alunos/php/update-aluno.php" method="post" class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Editar aluno</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <input type="hidden" id="id-aluno-editar" name="id-aluno">

          <?php
            $contexto = 'editar';
            include __DIR__ . '/form-aluno.php';
          ?>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-danger">Atualizar</button>
        </div>
    </form>
  </div>
</div>

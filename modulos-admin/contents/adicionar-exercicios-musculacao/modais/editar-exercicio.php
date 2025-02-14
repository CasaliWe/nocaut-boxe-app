<style>
    #container-preview-gif{
        width: 50px !important;
        height: 50px !important;
        margin-top: 10px !important;
    }
    #container-preview-gif img{
        width: 100% !important;
        height: 100% !important;
        object-fit: cover;
        object-position: center;
    }
</style>




<div class="modal fade" id="modal-editar-exercicio" tabindex="-1" aria-labelledby="modal-editar-exercicio" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Editar exercício</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/adicionar-exercicios-musculacao/php/editar-exercicio.php" method="post" enctype="multipart/form-data">
          
          <div class="modal-body">

                <input type='hidden' id='id-exercicio-editar' name='id'>
                <input type='hidden' id='gif-exercicio-deletar' name='gif-deletar'>
          
                <div class='mb-3'>
                    <label for='nome' class="small">Nome do Exercício*</label>
                    <input type='text' id='nome-exercicio-editar' name='nome' class='form-control' required>
                </div>

                <div class='mb-3'>
                    <label for='gif' class="small">Gif do Exercício*</label>
                    <input type='file' id='gif' name='gif' class='form-control'>
                    <div id="container-preview-gif">
                        <img id="gif-exercicio-editar">
                    </div>
                </div>
          
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-danger">Editar</button>
          </div>
      </form>
    </div>
  </div>
</div>
<div class="modal fade" id="aprovacoes-alunos" tabindex="-1" aria-labelledby="aprovacoes-alunos" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Aprovações de cadastro</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <?php if(count($solicitacoes_alunos) == 0){ ?>
            <div class="alert alert-secondary mb-0" role="alert">
                <h6 class="fw-bold mb-1">Nenhuma solicitação pendente.</h6>
                <p class="small mb-0">Quando um aluno preencher o link externo, a solicitação aparecerá aqui.</p>
            </div>
        <?php }else{ ?>
            <div class="list-group">
                <?php foreach($solicitacoes_alunos as $solicitacao){ ?>
                    <?php $payloadSolicitacao = hAluno(json_encode(payloadSolicitacaoAluno($solicitacao), JSON_UNESCAPED_UNICODE | JSON_HEX_APOS | JSON_HEX_QUOT)); ?>
                    <div class="list-group-item">
                        <div class="d-flex flex-column flex-lg-row justify-content-between gap-3">
                            <div>
                                <h6 class="fw-bold mb-1"><?= hAluno($solicitacao['nome']); ?></h6>
                                <p class="small mb-1">
                                    <?= hAluno(labelModalidadeAluno($solicitacao['modalidade'])); ?> -
                                    <?= hAluno($solicitacao['telefone_contato']); ?>
                                </p>
                                <p class="small text-muted mb-0">Enviado em: <?= formatarDataHoraAluno($solicitacao['created_at']); ?></p>
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2 align-self-lg-center">
                                <button type="button" data-solicitacao='<?= $payloadSolicitacao; ?>' onclick="aprovarSolicitacaoAluno(this)" class="btn btn-success btn-sm">Aprovar</button>
                                <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/alunos/php/delete-solicitacao-aluno.php" method="post">
                                    <input type="hidden" name="id-solicitacao-aluno" value="<?= $solicitacao['id']; ?>">
                                    <button type="submit" class="btn btn-outline-danger btn-sm">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="aprovar-aluno-solicitacao" tabindex="-1" aria-labelledby="aprovar-aluno-solicitacao" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
    <form onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/alunos/php/aprovar-solicitacao-aluno.php" method="post" class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Aprovar cadastro do aluno</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <input type="hidden" id="id-solicitacao-aluno-aprovacao" name="id-solicitacao-aluno">

          <?php
            $contexto = 'aprovacao';
            include __DIR__ . '/form-aluno.php';
          ?>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
          <button type="submit" class="btn btn-danger">Aprovar e cadastrar</button>
        </div>
    </form>
  </div>
</div>

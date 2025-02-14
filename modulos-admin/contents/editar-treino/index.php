<style>

</style>



<section>
    <h6 class="fw-normal small mb-5">Sessão destinada à <span class="fw-bold">editar treino de musculação</span>.</h6>

    <form class="mb-5" onsubmit="loading()" action="<?= $base_url; ?>modulos-admin/contents/editar-treino/php/editar-treino.php" method="post">
        
        <input type="hidden" name="id" value="<?= $treino_aluno['id']; ?>">
        
        <div class="mb-3">
            <label for="nome" class="small form-label">Nome*</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= $treino_aluno['nome_aluno']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tipo-treino" class="small form-label">Tipo de Treino*</label>
            <select class="form-select" id="tipo-treino" name="tipo-treino" required>
                <option selected disabled>Selecione o tipo de treino</option>
                
                <option value='Iniciante' <?= $treino_aluno['tipo_treino'] == 'Iniciante' ? 'selected' : '' ?>>Iniciante <?= $treino_aluno['tipo_treino'] == 'Iniciante' ? '(Atual)' : '' ?></option>
                <option value='Intermediário' <?= $treino_aluno['tipo_treino'] == 'Intermediário' ? 'selected' : '' ?>>Intermediário <?= $treino_aluno['tipo_treino'] == 'Intermediário' ? '(Atual)' : '' ?></option>
                <option value='Avançado' <?= $treino_aluno['tipo_treino'] == 'Avançado' ? 'selected' : '' ?>>Avançado <?= $treino_aluno['tipo_treino'] == 'Avançado' ? '(Atual)' : '' ?></option>
            </select>
        </div>
        <div class="mb-3">
            <label for="duracao" class="small form-label">Duração*</label>
            <select class="form-select" id="duracao" name="duracao" required>
                <option selected disabled>Selecione a duração</option>

                <option value='1 semana' <?= $treino_aluno['duracao_treino'] == '1 semana' ? 'selected' : '' ?>>1 semana <?= $treino_aluno['duracao_treino'] == '1 semana' ? '(Atual)' : '' ?></option>
                <option value='2 semanas' <?= $treino_aluno['duracao_treino'] == '2 semanas' ? 'selected' : '' ?>>2 semanas <?= $treino_aluno['duracao_treino'] == '2 semanas' ? '(Atual)' : '' ?></option>
                <option value='3 semanas' <?= $treino_aluno['duracao_treino'] == '3 semanas' ? 'selected' : '' ?>>3 semanas <?= $treino_aluno['duracao_treino'] == '3 semanas' ? '(Atual)' : '' ?></option>
                <option value='4 semanas' <?= $treino_aluno['duracao_treino'] == '4 semanas' ? 'selected' : '' ?>>4 semanas <?= $treino_aluno['duracao_treino'] == '4 semanas' ? '(Atual)' : '' ?></option>
                <option value='5 semanas' <?= $treino_aluno['duracao_treino'] == '5 semanas' ? 'selected' : '' ?>>5 semanas <?= $treino_aluno['duracao_treino'] == '5 semanas' ? '(Atual)' : '' ?></option>
                <option value='6 semanas' <?= $treino_aluno['duracao_treino'] == '6 semanas' ? 'selected' : '' ?>>6 semanas <?= $treino_aluno['duracao_treino'] == '6 semanas' ? '(Atual)' : '' ?></option>
                <option value='7 semanas' <?= $treino_aluno['duracao_treino'] == '7 semanas' ? 'selected' : '' ?>>7 semanas <?= $treino_aluno['duracao_treino'] == '7 semanas' ? '(Atual)' : '' ?></option>
                <option value='8 semanas' <?= $treino_aluno['duracao_treino'] == '8 semanas' ? 'selected' : '' ?>>8 semanas <?= $treino_aluno['duracao_treino'] == '8 semanas' ? '(Atual)' : '' ?></option>
                <option value='9 semanas' <?= $treino_aluno['duracao_treino'] == '9 semanas' ? 'selected' : '' ?>>9 semanas <?= $treino_aluno['duracao_treino'] == '9 semanas' ? '(Atual)' : '' ?></option>
                <option value='10 semanas' <?= $treino_aluno['duracao_treino'] == '10 semanas' ? 'selected' : '' ?>>10 semanas <?= $treino_aluno['duracao_treino'] == '10 semanas' ? '(Atual)' : '' ?></option>
            </select>
        </div>
        <div class="mb-3">
            <label for="regenerativo" class="small form-label">Regenerativo*</label>
            <select class="form-select" id="regenerativo" name="regenerativo" required>
                <option selected disabled>Selecione a duração</option>

                <option value='1 semana' <?= $treino_aluno['regenerativo'] == '1 semana' ? 'selected' : '' ?>>1 semana <?= $treino_aluno['regenerativo'] == '1 semana' ? '(Atual)' : '' ?></option>
            </select>
        </div>
        <div class='mb-3'>
            <label for='modo_treino' class="small">Modo do treino*</label>
            <select id='modo_treino' name='modo_treino' class='form-control' required>
                <option value='Normal' <?= $treino_aluno['modo_treino'] == 'Normal' ? 'selected' : '' ?>>Normal <?= $treino_aluno['modo_treino'] == 'Normal' ? '(Atual)' : '' ?></option>
                <option value='Bi-set' <?= $treino_aluno['modo_treino'] == 'Bi-set' ? 'selected' : '' ?>>Bi-set <?= $treino_aluno['modo_treino'] == 'Bi-set' ? '(Atual)' : '' ?></option>
                <option value='Tri-set' <?= $treino_aluno['modo_treino'] == 'Tri-set' ? 'selected' : '' ?>>Tri-set <?= $treino_aluno['modo_treino'] == 'Tri-set' ? '(Atual)' : '' ?></option>
            </select>
        </div>
        <div class="mb-5">
            <label for="intervalo" class="small form-label">Intervalo*</label>
            <select class="form-select" id="intervalo" name="intervalo" required>
                <option selected disabled>Selecione a duração</option>

                <option value='45 segundos' <?= $treino_aluno['intervalo'] == '45 segundos' ? 'selected' : '' ?>>45 segundos <?= $treino_aluno['intervalo'] == '45 segundos' ? '(Atual)' : '' ?></option>
                <option value='01:00 minuto' <?= $treino_aluno['intervalo'] == '01:00 minuto' ? 'selected' : '' ?>>01:00 minuto <?= $treino_aluno['intervalo'] == '01:00 segundos' ? '(Atual)' : '' ?></option>
                <option value='01:30 minutos' <?= $treino_aluno['intervalo'] == '01:30 minutos' ? 'selected' : '' ?>>01:30 minutos <?= $treino_aluno['intervalo'] == '01:30 segundos' ? '(Atual)' : '' ?></option>
            </select>
        </div>

        <button type="submit" class="me-2 btn btn-danger px-3"><i class="me-1 fas fa-edit"></i> Atualizar Treino</button>
        <a href="<?= $base_url; ?>pages/treinos-musculacao/treinos-musculacao.php" class="btn btn-secondary px-3"><i class="me-1 fas fa-arrow-left"></i> Voltar</a>
    </form>
</section>



<script>

</script>
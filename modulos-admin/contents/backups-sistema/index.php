<style>
    #container-bloco-backups{
        width: 70% !important;
    }

    @media(min-width:1500px){
        #container-bloco-backups{
            width: 50% !important;
        }
    }
    @media(max-width:992px){
        #container-bloco-backups{
            width: 100% !important;
        }
    }
</style>

<p>Nesta sessão você pode fazer <strong>backups</strong> do banco de dados e dos arquivos do seu site.</p>

<main class="mt-5">
    <div>
        <div id="container-bloco-backups" class="row justify-content-start">
            <div class="col-12">
                <div class="mb-5 card text-left">
                    <div class="card-body">
                        <h5 class="card-title">Backup do Banco de Dados</h5>
                        <p class="card-text">Clique no botão abaixo para fazer backup do banco de dados.</p>
                        <form onsubmit="loading()" action="<?= $base_url; ?>helpers/backup-db.php">
                            <button type="submit" class="btn btn-danger btn-sm btn-block">
                                <i class="me-2 fas fa-database"></i> Fazer Backup
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card text-left">
                    <div class="card-body">
                        <h5 class="card-title">Backup de Arquivos</h5>
                        <p class="card-text">Clique no botão abaixo para fazer backup dos arquivos.</p>
                        <form onsubmit="loading()" action="<?= $base_url; ?>helpers/backup-arquivos.php">
                            <button type="submit" class="btn btn-secondary btn-sm btn-block">
                                <i class="me-2 fas fa-folder"></i> Fazer Backup
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

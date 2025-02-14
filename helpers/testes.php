<?php

namespace Repositories;

require __DIR__ . '/../config/config.php';
use Repositories\GrupoTreinoRepository;
echo json_encode(GrupoTreinoRepository::getAll('12'));
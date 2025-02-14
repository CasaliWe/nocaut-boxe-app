<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class GrupoTreino extends Model {
    protected $table = 'grupo_treino';
    protected $fillable = [
        'id_grupo_treino',
        'id_treino',
    ];
    public $timestamps = false;
}
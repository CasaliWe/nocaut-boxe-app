<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class AlunoTreinoMusculacao extends Model {
    protected $table = 'aluno_treino_musculacao';
    protected $fillable = [
        'uid', 
        'nome_aluno', 
        'tipo_treino',
        'duracao_treino',
        'regenerativo',
        'modo_treino',
        'intervalo',
    ];
    public $timestamps = true;
}
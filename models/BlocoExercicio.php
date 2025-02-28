<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class BlocoExercicio extends Model {
    protected $table = 'bloco_exercicio';
    protected $fillable = [
        'identificador',
        'aluno_treino_id',
        'nome_bloco'
    ];
    public $timestamps = false;
}
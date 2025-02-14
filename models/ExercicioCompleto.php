<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ExercicioCompleto extends Model {
    protected $table = 'exercicio_completo';
    protected $fillable = [
        'exercicio',
        'carga',
        'serie_rep',
        'grupo_exercicios_id'
    ];
    public $timestamps = false;
}
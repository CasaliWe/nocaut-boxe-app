<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Exercicios extends Model {
    protected $table = 'exercicios';
    protected $fillable = [
        'nome',
        'gif',
        'grupo_exercicios_id'
    ];
    public $timestamps = false;

    public function grupo_exercicios()
    {
        return $this->belongsTo(GrupoExercicios::class, 'grupo_exercicios_id');
    }
}
<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class GrupoExercicios extends Model {
    protected $table = 'grupo_exercicios';
    protected $fillable = [
        'nome'
    ];
    public $timestamps = false;

    public function exercicios()
    {
        return $this->hasMany(Exercicios::class, 'grupo_exercicios_id' , 'id');
    }
}
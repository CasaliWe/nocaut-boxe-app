<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class ServicoValor extends Model {
    protected $table = 'servicos_valores';
    protected $fillable = [
        'descricao',
        'valor',
    ];
    public $timestamps = true;
}

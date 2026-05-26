<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model {
    protected $table = 'alunos';
    protected $fillable = [
        'nome',
        'data_inicio',
        'rua',
        'numero',
        'bairro',
        'cep',
        'tipo_documento',
        'documento',
        'telefone_contato',
        'telefone_emergencia',
        'responsavel_nome',
        'responsavel_telefone',
        'data_nascimento',
        'sexo',
        'modalidade',
        'autoriza_imagem',
        'tem_problema_saude',
        'descricao_problema_saude',
        'facebook',
        'instagram',
        'observacoes',
        'servico_valor_id',
        'pacote_descricao',
        'valor_pacote',
        'juros_percentual',
        'desconto_percentual',
        'valor_final',
        'status',
        'data_pagamento',
        'data_vencimento',
    ];
    public $timestamps = true;

    public function pacote() {
        return $this->belongsTo(ServicoValor::class, 'servico_valor_id');
    }
}

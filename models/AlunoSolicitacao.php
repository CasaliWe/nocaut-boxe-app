<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class AlunoSolicitacao extends Model {
    protected $table = 'aluno_solicitacoes';
    protected $fillable = [
        'nome',
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
        'status',
        'aprovado_em',
    ];
    public $timestamps = true;
}

<?php
namespace Repositories;

use Models\Aluno;

class AlunoRepository {
    public static function getAll($filtros = []) {
        $alunos = Aluno::with('pacote');

        if(!empty($filtros['pesquisa'])){
            $alunos->where('nome', 'like', '%' . $filtros['pesquisa'] . '%');
        }

        if(!empty($filtros['modalidade'])){
            $alunos->where('modalidade', $filtros['modalidade']);
        }

        if(!empty($filtros['pacote'])){
            $alunos->where('servico_valor_id', $filtros['pacote']);
        }

        if(!empty($filtros['situacao'])){
            $hoje = date('Y-m-d');
            $seteDias = date('Y-m-d', strtotime('+7 days'));

            if($filtros['situacao'] === 'vencendo'){
                $alunos
                    ->whereNotNull('data_vencimento')
                    ->whereBetween('data_vencimento', [$hoje, $seteDias]);
            }

            if($filtros['situacao'] === 'vencido'){
                $alunos
                    ->whereNotNull('data_vencimento')
                    ->where('data_vencimento', '<', $hoje);
            }

            if($filtros['situacao'] === 'aniversario'){
                $alunos
                    ->whereMonth('data_nascimento', date('m'))
                    ->whereDay('data_nascimento', date('d'));
            }
        }

        return $alunos->orderBy('updated_at', 'desc')->get();
    }

    public static function create($data) {
        $res = Aluno::create($data);

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    public static function update($data, $id) {
        $aluno = Aluno::where('id', $id)->first();

        if(!$aluno){
            return false;
        }

        foreach($data as $key => $value){
            $aluno->{$key} = $value;
        }

        return $aluno->save();
    }

    public static function delete($id) {
        $res = Aluno::where('id', $id)->delete();

        if(!$res){
            return false;
        }else{
            return true;
        }
    }
}

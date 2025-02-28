<?php
namespace Repositories;

use Models\AlunoTreinoMusculacao;
use Models\GrupoTreino;
use Models\ExercicioCompleto;
use Models\BlocoExercicio;

class AlunoTreinoMusculacaoRepository {
    // buscando todos os treinos alunos
    public static function getAll($pesquisa) {
        if($pesquisa){
            return AlunoTreinoMusculacao::where('nome_aluno', 'like', '%'.$pesquisa.'%')->orderBy('updated_at', 'desc')->get();
        }else{
            return AlunoTreinoMusculacao::orderBy('updated_at', 'desc')->get();
        }
    }

    // criando um novo treino aluno
    public static function create($data) {
        $res = AlunoTreinoMusculacao::create($data);

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    // deletando treino
    public static function deleteTreino($id) {
        // deletando treino do aluno
        $res = AlunoTreinoMusculacao::where('id', $id)->delete();

        // deletando exercicios completos do grupo
        $grupo_treino = GrupoTreino::where('id_treino', $id)->get();
        foreach ($grupo_treino as $key => $grupo) {
            ExercicioCompleto::where('grupo_exercicios_id', $grupo['id'])->delete();
        }

        // deletando bloco exercicios do grupo
        BlocoExercicio::where('aluno_treino_id', $id)->delete();

        // deletando grupo treino criado pro aluno (oq tem somente id)
        $grupo_treino_delete = GrupoTreino::where('id_treino', $id)->delete();

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    // buscando treino aluno
    public static function getTreinoAluno($id) {
        return AlunoTreinoMusculacao::where('id', $id)->first();
    }

    // atualizando treino aluno
    public static function updateTreinoAluno($data, $id) {
        $res = AlunoTreinoMusculacao::where('id', $id)->update($data);

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    // buscando treino aluno pelo uid
    public static function getTreinoAlunoUid($uid) {
        return AlunoTreinoMusculacao::where('uid', $uid)->first();
    }
}
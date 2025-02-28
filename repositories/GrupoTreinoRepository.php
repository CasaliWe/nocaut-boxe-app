<?php
namespace Repositories;

use Models\GrupoTreino;
use Models\GrupoExercicios;
use Models\Exercicios;
use Models\ExercicioCompleto;
use Models\AlunoTreinoMusculacao;
use Models\BlocoExercicio;

class GrupoTreinoRepository {


    // buscando todos grupos
    public static function getAll($id_treino) {
        // pegando os ids dos grupos
        $grupos_id = GrupoTreino::where('id_treino', $id_treino)->get();

        // receberá os dados para retornar
        $dadosFinais = [];

        // percorrendo cada id de grupo para obter os dados daquele grupo especifico
        foreach ($grupos_id as $grupo_id) {
            // pegando o grupo de exercicios da tabela grupo_exercicios com o nome do grupo
            $grupo = GrupoExercicios::where('id', $grupo_id->id_grupo_treino)->first();

            // pegando os exercicios completos do grupo da tabela exercicios_completos
            $exercicios_completos_com_id_exericicio = ExercicioCompleto::where('grupo_exercicios_id', $grupo_id->id)->get();
            $exercicios_completos = [];
            foreach ($exercicios_completos_com_id_exericicio as $exercicio_completo) {
                $exercicio = Exercicios::where('id', $exercicio_completo->exercicio)->first();
                $exercicios_completos[] = [
                    'id' => $exercicio_completo->id,
                    'exercicio' => $exercicio,
                    'carga' => $exercicio_completo->carga,
                    'serie_rep' => $exercicio_completo->serie_rep,
                    'grupo_exercicios_id' => $exercicio_completo->grupo_exercicios_id
                ];
            }

            
            // pegando os exercicios do grupo da tabela exercicios para colocar no select do modal
            $exercicioGrupo = Exercicios::where('grupo_exercicios_id', $grupo_id->id_grupo_treino)->get();
            
            // montando os dados para retornar
            $dadosFinais[] = [
                'grupo_nome' => [
                    'id' => $grupo->id,
                    'nome' => $grupo->nome,
                    'identificador_bloco' => $grupo_id->identificador_bloco,
                    'exercicios_completos' => $exercicios_completos
                ],
                'exercicios_grupo' => $exercicioGrupo,
                'id_grupo_treino' => $grupo_id->id
            ];
        }

        // retornando os dados organizados
        return $dadosFinais;
    }
    



    // criando grupo treino
    public static function create($id_treino, $grupo_id, $identificador_bloco) {
        return GrupoTreino::create([
            'id_grupo_treino' => $grupo_id,
            'id_treino' => $id_treino,
            'identificador_bloco' => $identificador_bloco
        ]);
    }


    // criando exercicio grupo
    public static function createExercicioGrupo($data) {
        return ExercicioCompleto::create([
            'exercicio' => $data['exercicio'],
            'carga' => $data['carga'],
            'serie_rep' => $data['serie_rep'],
            'grupo_exercicios_id' => $data['id_grupo_treino'],
        ]);
    }


    // deletando exercicio completo 
    public static function deleteExercicioCompleto($id) {
        $res = ExercicioCompleto::where('id', $id)->delete();

        if($res){
            return true;
        }else{
            return false;
        }
    }

    // deletando grupo completo 
    public static function deleteGrupoCompleto($id) {
        $res = ExercicioCompleto::where('grupo_exercicios_id', $id)->delete();
        $res = GrupoTreino::where('id', $id)->delete();

        if($res){
            return true;
        }else{
            return false;
        }
    }



    // buscando todos grupos com uid para listar na página de treino do aluno
    public static function getAllUid($uid) {

        // var q retorna todos os dados
        $dadosFinais = [];

        // pegando dados do treino do aluno
        $treino_aluno = AlunoTreinoMusculacao::where('uid', $uid)->first();

        if(!$treino_aluno){
            return null;
        }

        // pegando os grupo que são apenas com ids
        $grupo_com_id_treino_aluno = GrupoTreino::where('id_treino', $treino_aluno->id)->get();

        // percorrendo cada grupo para obter os dados daquele grupo especifico passando o id do grupo;
        // pegando também os exercicios completos de cada grupo passando o id do grupo (somente de ids);
        foreach ($grupo_com_id_treino_aluno as $key => $grupo_com_id) {

            // pegando o grupo de exercicios da tabela grupo_exercicios com o nome do grupo
            $grupo = GrupoExercicios::where('id', $grupo_com_id->id_grupo_treino)->first();

            // pegando os exercicios completos do grupo da tabela exercicios_completos
            $exercicios_completos = ExercicioCompleto::where('grupo_exercicios_id', $grupo_com_id->id)->get();
            
            // percorrendo cada exercicio completo para obter os dados do exercicio (NOME DELE)
            foreach ($exercicios_completos as $key => $exercicio_completo) {
                // pegando o exercicio da tabela exercicios com o id do exercicio
                $exercicio = Exercicios::where('id', $exercicio_completo->exercicio)->first();

                // montando os dados para retornar
                $exercicios_completos[$key] = [
                    'id' => $exercicio_completo->id,
                    'exercicio' => $exercicio,
                    'carga' => $exercicio_completo->carga,
                    'serie_rep' => $exercicio_completo->serie_rep,
                    'grupo_exercicios_id' => $exercicio_completo->grupo_exercicios_id
                ];
            }
            
            
            
            
            $dadosFinais[] = [
                'nome' => $grupo->nome,
                'bloco' => $grupo_com_id->identificador_bloco,
                'exercicios_completos' => $exercicios_completos
            ];
        }


        return $dadosFinais;
    }


    // atualizando carga do exercicio
    public static function updateCarga($data, $id) {
        $res = ExercicioCompleto::where('id', $id)->update($data);

        if($res){
            return true;
        }else{
            return false;
        }
    }


    // criando bloco
    public static function createBloco($data) {
        $res = BlocoExercicio::create([
            'identificador' => $data['identificador'],
            'nome_bloco' => $data['nome_bloco'],
            'aluno_treino_id' => $data['aluno_treino_id']
        ]);

        if($res){
            return true;
        }else{
            return false;
        }
    }

    // pegando os blocos passando o id do aluno treino
    public static function getBlocos($id) {
        $res = BlocoExercicio::where('aluno_treino_id', $id)->get();

        if($res){
            return $res;
        }else{
            return false;
        }
    }

    // pegando os blocos passando o UID do aluno treino
    public static function getBlocosUid($uid) {
        $aluno = AlunoTreinoMusculacao::where('uid', $uid)->first();
        
        if(!$aluno){
            return false;
        }
        
        $res = BlocoExercicio::where('aluno_treino_id', $aluno->id)->get();

        if($res){
            return $res;
        }else{
            return false;
        }
    }


    // deletando bloco
    public static function deletarBloco($identificador) {
        
        // buscando os grupo
        $grupo = GrupoTreino::where('identificador_bloco', $identificador)->get();

        // percorrendo cada grupo para deletar os exercicios completos
        foreach ($grupo as $key => $value) {
            ExercicioCompleto::where('grupo_exercicios_id', $value->id)->delete();
        }

        // deletando os grupos
        GrupoTreino::where('identificador_bloco', $identificador)->delete();

        // deletando o bloco
        $res = BlocoExercicio::where('identificador', $identificador)->delete();


        if($res){
            return true;
        }else{
            return false;
        }
    }


    // atualizando bloco
    public static function updateBloco($identificador, $nome) {
        $res = BlocoExercicio::where('identificador', $identificador)->update(['nome_bloco' => $nome]);

        if($res){
            return true;
        }else{
            return false;
        }
    }
}
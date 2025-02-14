<?php
namespace Repositories;

use Models\GrupoExercicios;
use Models\Exercicios;
use Models\ExercicioCompleto;
use Models\GrupoTreino;

class ExerciciosRepository {
    // buscando todos os exercicios
    public static function getAll() {
        return GrupoExercicios::with('exercicios')->get();
    }

    // criando um novo grupo de exercicios
    public static function create($nome) {
        return GrupoExercicios::create([
            'nome' => $nome
        ]);
    }

    // deletando um grupo de exercícios
    public static function delete($id) {
        
        // buscando gifs para deletar
        $gifExercicios = Exercicios::select('gif')->where('grupo_exercicios_id', $id)->get();
        
        // deletando gifs
        foreach ($gifExercicios as $gif) {
            $filePathDesk = __DIR__ . '/../assets/imagens/arquivos/gifs-musculacao/' . $gif['gif'];
            unlink($filePathDesk);
        }

        // deletando exercicio completo
        $grupo_treino = GrupoTreino::where('id_grupo_treino', $id)->get();
        foreach ($grupo_treino as $key => $grupo) {
            ExercicioCompleto::where('grupo_treino_id', $grupo['id'])->delete();
        }

        // deletando grupo treino QUE TEM O ID DO GRUPO DE EXERCICIOS
        $grupo_treino_delete = GrupoTreino::where('id_grupo_treino', $id)->delete();

        // deletando exercicios desse grupo
        Exercicios::where('grupo_exercicios_id', $id)->delete();

        // deletando grupo execicios
        $res = GrupoExercicios::where('id', $id)->delete();

        if($res) {
            return true;
        } else {
            return false;
        }

    }

    // atualizando um grupo de exercícios
    public static function update($nome, $id) {
        $res = GrupoExercicios::where('id', $id)->update([
            'nome' => $nome
        ]);

        if($res) {
            return true;
        } else {
            return false;
        }
    }

    // criando um novo exercício
    public static function createExercicio($nome, $gif, $grupo_id) {
        return Exercicios::create([
            'nome' => $nome,
            'gif' => $gif,
            'grupo_exercicios_id' => $grupo_id
        ]);
    }

    // deletando um exercício
    public static function deleteExercicio($id) {
        $res = Exercicios::where('id', $id)->delete();
        $res2 = ExercicioCompleto::where('exercicio', $id)->delete();

        if($res) {
            return true;
        } else {
            return false;
        }
    }

    // atualizando um grupo de exercícios
    public static function updateExercicio($nome, $gif, $id) {
        if($gif != null) {
            $res = Exercicios::where('id', $id)->update([
                'nome' => $nome,
                'gif' => $gif
            ]);
        } else {
            $res = Exercicios::where('id', $id)->update([
                'nome' => $nome
            ]);
        }

        if($res) {
            return true;
        } else {
            return false;
        }
    }

    // buscando todos os grupos de exercícios
    public static function getAllGrupos() {
        return GrupoExercicios::all();
    }
}
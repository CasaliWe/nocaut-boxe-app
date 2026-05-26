<?php
namespace Repositories;

use Models\ServicoValor;

class ServicoValorRepository {
    public static function getAll() {
        return ServicoValor::orderBy('descricao', 'asc')->get();
    }

    public static function getById($id) {
        return ServicoValor::where('id', $id)->first();
    }

    public static function create($data) {
        $res = ServicoValor::create($data);

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    public static function update($data, $id) {
        $servico = ServicoValor::where('id', $id)->first();

        if(!$servico){
            return false;
        }

        $servico->descricao = $data['descricao'];
        $servico->valor = $data['valor'];

        return $servico->save();
    }

    public static function delete($id) {
        $res = ServicoValor::where('id', $id)->delete();

        if(!$res){
            return false;
        }else{
            return true;
        }
    }
}

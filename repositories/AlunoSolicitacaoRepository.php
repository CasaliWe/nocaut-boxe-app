<?php
namespace Repositories;

use Models\AlunoSolicitacao;

class AlunoSolicitacaoRepository {
    public static function getPendentes() {
        return AlunoSolicitacao::where('status', 'pendente')->orderBy('created_at', 'desc')->get();
    }

    public static function getById($id) {
        return AlunoSolicitacao::where('id', $id)->first();
    }

    public static function create($data) {
        $res = AlunoSolicitacao::create($data);

        if(!$res){
            return false;
        }else{
            return true;
        }
    }

    public static function aprovar($id) {
        $solicitacao = AlunoSolicitacao::where('id', $id)->first();

        if(!$solicitacao){
            return false;
        }

        $solicitacao->status = 'aprovado';
        $solicitacao->aprovado_em = date('Y-m-d H:i:s');

        return $solicitacao->save();
    }

    public static function delete($id) {
        $res = AlunoSolicitacao::where('id', $id)->delete();

        if(!$res){
            return false;
        }else{
            return true;
        }
    }
}

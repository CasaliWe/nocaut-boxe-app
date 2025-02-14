<?php
namespace Repositories;

use Models\Admins;

class AdminsRepository {
    // buscando todos os usuários
    public static function getAdmins() {
        return Admins::all();
    }

    // atualizando dados do usuário
    public static function update($data, $id) {
        $res = Admins::where('id', $id)->update($data);

        if($res){
            return true;
        }else{
            return false;
        }
    }

    // criando user usando o ::create
    public static function create($data) {
        $res = Admins::create($data);

        if($res){
            return true;
        }else{
            return false;
        }
    }

    // deletando user
    public static function delete($id) {
        $res = Admins::where('id', $id)->delete();

        if($res){
            return true;
        }else{
            return false;
        }
    }
}
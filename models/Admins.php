<?php

namespace Models;

use Illuminate\Database\Eloquent\Model;

class Admins extends Model {
    protected $table = 'admins';
    protected $fillable = [
        'login', 
        'senha',
        'nome',
        'tipo'
    ];
    public $timestamps = false;
}
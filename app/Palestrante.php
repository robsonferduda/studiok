<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Palestrante extends Model
{    
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'palestrante_pal';
    protected $primaryKey = 'id_palestrante_pal';
    protected $fillable = ['id_pessoa_pes','ds_empresa_pal','ds_cargo_pal','biografia_pal','path_imagem_pal','ds_tratamento_pal'];
    
    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa', 'id_pessoa_pes', 'id_pessoa_pes');
    }   
    
    public function atividades()
    {
        return $this->belongsToMany('App\Atividade','atividade_palestrante_atp','id_palestrante_pal','id_atividade_ati')
                    ->withTimestamps();
    }
}
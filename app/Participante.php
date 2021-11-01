<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participante extends Model
{    
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'participante_par';
    protected $primaryKey = 'id_participante_par';
    protected $fillable = ['id_pessoa_pes','nm_cracha_par','nu_cpf_par','biografia_pal','id_situacao_sit'];
    
    public function pessoa()
    {
        return $this->belongsTo('App\Pessoa', 'id_pessoa_pes', 'id_pessoa_pes');
    }

    public function eventos()
    {
        return $this->belongsToMany('App\Evento','evento_participante_evp','id_participante_par','id_evento_eve')
                    ->withTimestamps();
    }
    
}
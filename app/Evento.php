<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Evento extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'evento_eve';
    protected $primaryKey = 'id_evento_eve';
    protected $fillable = ['nm_evento_eve','dt_inicio_eve','dt_fim_eve'];

    public function participantes()
    {
        return $this->belongsToMany('App\Participante','evento_participante_evp','id_evento_eve','id_participante_par')
                    ->withTimestamps();
    }

    public function usuarios()
    {
        return $this->belongsToMany('App\User','evento_usuario_evu','id_evento_eve','id') 
                    ->withTimestamps();
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade', 'id_evento_eve', 'id_evento_eve');
    }

    public function salas()
    {
        return $this->hasMany('App\Sala', 'id_evento_eve', 'id_evento_eve');
    }
}
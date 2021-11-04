<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Atividade extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'atividade_ati';
    protected $primaryKey = 'id_atividade_ati';
    protected $fillable = ['id_sala_sal','id_evento_eve','id_tipo_atividade_tia','nm_atividade_ati','ds_atividade_ati','dt_inicio_atividade_ati','dt_termino_atividade_ati','fl_ativa_ati','fl_destaque_ati','fl_corrente_ati'];

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'id_evento_eve', 'id_evento_eve');
    }

    public function sala()
    {
        return $this->hasOne('App\Sala', 'id_sala_sal', 'id_sala_sal');
    }

    public function atividadesParalelas()
    {
        return $this->hasMany('App\AtividadeParalela', 'id_atividade_ati', 'id_atividade_ati');
    }

    public function chat()
    {
        return $this->hasMany('App\Chat', 'id_atividade_ati', 'id_atividade_ati');
    }

    public function tipo()
    {
        return $this->hasOne('App\TipoAtividade', 'id_tipo_atividade_tia', 'id_tipo_atividade_tia');
    }

    public function palestrantes()
    {
        return $this->belongsToMany('App\Palestrante','atividade_palestrante_atp','id_atividade_ati','id_palestrante_pal')
                    ->withTimestamps();
    }    
}
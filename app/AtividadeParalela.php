<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtividadeParalela extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'atividades_paralelas_atp';
    protected $primaryKey = 'id_atividades_paralelas_atp';
    protected $fillable = ['id_sala_sal','id_atividade_ati','hr_inicio_atp','hr_fim_atp','titulo_atp','autores_atp'];

    public function atividade()
    {
        return $this->belongsTo('App\Atividade', 'id_atividade_ati', 'id_atividade_ati');
    }

    public function sala()
    {
        return $this->hasOne('App\Sala', 'id_sala_sal', 'id_sala_sal');
    }  
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoAtividade extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'tipo_atividade_tia';
    protected $primaryKey = 'id_tipo_atividade_tia';
    protected $fillable = ['ds_tipo_atividade_tia'];

    public function atividade()
    {
        return $this->belongsTo('App\Atividade', 'id_tipo_atividade_tia', 'id_tipo_atividade_tia');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoInscricao extends Model
{
    //use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'tipo_inscricao_tii';
    protected $primaryKey = 'id_tipo_inscricao_tii';
    protected $fillable = ['ds_tipo_inscricao_tii'];

    public function participante()
    {
        return $this->belongsTo('App\Participante', 'id_tipo_inscricao_tii', 'id_tipo_inscricao_tii');
    }
}
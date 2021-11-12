<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Situacao extends Model
{
    //use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'situacao_sit';
    protected $primaryKey = 'id_situacao_sit';
    protected $fillable = ['ds_situacao_sit'];

    public function participante()
    {
        return $this->belongsTo('App\Participante', 'id_tipo_inscricao_tii', 'id_tipo_inscricao_tii');
    }
}
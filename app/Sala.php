<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sala extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'sala_sal';
    protected $primaryKey = 'id_sala_sal';
    protected $fillable = ['id_tipo_sala_tis','nm_sala_sal','ds_local_sal'];

    public function tipo()
    {
        return $this->hasOne('App\TipoSala', 'id_tipo_sala_tis', 'id_tipo_sala_tis');
    }

    public function atividades()
    {
        return $this->belongsTo('App\Atividade', 'id_sala_sal', 'id_sala_sal');
    }
}
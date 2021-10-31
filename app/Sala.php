<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Sala extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    
    protected $connection = 'pgsql';
    protected $table = 'sala_sal';
    protected $primaryKey = 'id_sala_sal';
    protected $fillable = ['id_evento_eve','id_tipo_sala_tis','nm_sala_sal','ds_local_sal','ds_ambiente_sal'];

    public function tipo()
    {
        return $this->hasOne('App\TipoSala', 'id_tipo_sala_tis', 'id_tipo_sala_tis');
    }

    public function evento()
    {
        return $this->belongsTo('App\Evento', 'id_evento_eve', 'id_evento_eve');
    }

    public function atividades()
    {
        return $this->hasMany('App\Atividade', 'id_sala_sal', 'id_sala_sal');
    }

    public function atividadesParalelas()
    {
        return $this->belongsTo('App\AtividadeParalela', 'id_sala_sal', 'id_sala_sal');
    }
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoSala extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'tipo_sala_tis';
    protected $primaryKey = 'id_tipo_sala_tis';
    protected $fillable = ['ds_tipo_sala_tis'];

    public function sala()
    {
        return $this->belongsTo('App\Sala', 'id_tipo_sala_tis', 'id_tipo_sala_tis');
    }
}
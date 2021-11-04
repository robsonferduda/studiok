<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtividadeAcesso extends Model
{
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'atividade_acessos_ata';
    protected $primaryKey = 'id_atividade_acessos_ata';
    protected $fillable = ['id_sala_ati','id_usuario_usu','id_atividade_ati'];
  
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chat extends Model
{    
    use SoftDeletes;
    
    protected $connection = 'pgsql';
    protected $table = 'chat_atividade_cha';
    protected $primaryKey = 'id_chat_atividade_cha';
    protected $fillable = ['id_atividade_ati','id_usuario_usu','mensagem_cha'];
    
    public function atividade()
    {
        return $this->belongsTo('App\Atividade', 'id_atividade_ati', 'id_atividade_ati');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'id_usuario_usu');
    }
}
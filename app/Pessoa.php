<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pessoa extends Model
{    
    protected $connection = 'pgsql';
    protected $table = 'pessoa_pes';
    protected $primaryKey = 'id_pessoa_pes';
    protected $fillable = ['ds_email_pes', 'nm_pessoa_pes','nu_orcid_pes'];
    

    public function participante()
    {
        return $this->hasOne('App\Participante', 'id_pessoa_pes', 'id_pessoa_pes');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id_pessoa_pes', 'id_pessoa_pes');
    }    
}
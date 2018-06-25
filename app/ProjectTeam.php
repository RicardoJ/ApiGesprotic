<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    protected $table = 'projectteam';
    //public $timestamps = false;
    protected $fillable = ['nombreDelIntegranteDelProyecto','rolDelIntegrante','emailDelIntegrante','competenciasDelIntegranteDelProyecto'];
    protected $primaryKey = ['id_projectteam'];
}

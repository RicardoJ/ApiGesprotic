<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    protected $table = 'projectteam';
    protected $fillable = ['nombreDelIntegranteDelProyecto','rolDelIntegrante','emailDelIntegrante','competenciasDelIntegranteDelProyecto'];
    protected $guarded = ['id_projectteam'];
}

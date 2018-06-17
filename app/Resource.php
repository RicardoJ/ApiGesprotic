<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resource';
    protected $fillable = ['descripcion','fechaFinal','fechaInicial','nombreDelRecurso','origen','relevancia','tipo','unidades'];
    protected $guarded = ['id_resource'];
}

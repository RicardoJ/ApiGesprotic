<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $table = 'resource';
    public $timestamps = false;
    protected $fillable = ['descripcion','fechaFinal','fechaInicial','nombreDelRecurso','origen','relevancia','tipo','unidades'];
    protected $primaryKey = 'id_resource';
}

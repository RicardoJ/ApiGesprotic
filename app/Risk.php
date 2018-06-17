<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    protected $table = 'risk';
    public $timestamps = false;
    protected $fillable = ['actaDeRiesgo','id_project'];
    protected $guarded = ['id_risk'];

   
    public function project()
    {
        return $this->belongsTo('App\project','id_project');
    }
}

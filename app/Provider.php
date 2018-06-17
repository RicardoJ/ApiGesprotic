<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'provider';
    public $timestamps = false;
    protected $fillable = ['nombreDeLaEmpresa','nombrePersonaDeContacto','telefono','direccion','email'];
    protected $guarded = ['id_provider'];

    public function agreement()
    {
        return $this->hasOne('App\agreement', 'id_provider');
        
    }

}

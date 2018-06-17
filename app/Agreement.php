<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $table = 'agreement';
    protected $fillable = ['contenidoDelContrato','fechaDeEntrega','fechaDelContrato','metodoDePago','nombreDeLaEmpresa','personaEncargada','id_provider'];
    protected $guarded = ['id_agreement'];
    public function providers()
    {
        return $this->BelongsTo('App\provider', 'id_provider');
        
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Change extends Model
{
    protected $table = 'change';
    public $timestamps = false;
    protected $fillable = ['cambioProuestoPor','descripcion','estado','nombreDelCambio','responsableDelCambio','id_changeRequest'];
    protected $guarded = ['id_change'];
    public function changeRequests()
    {
        return $this->BelongsTo('App\changeRequest', 'id_changeRequest');
        
    }
}

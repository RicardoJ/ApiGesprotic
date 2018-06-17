<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    protected $table = 'changeRequest';
    public $timestamps = false;
    protected $fillable = ['actaSolicitudDeCambio','id_project'];
    protected $guarded = ['id_changeRequest'];

    public function change()
    {
        return $this->hasOne('App\change', 'id_change');
        
    }
    public function project()
    {
        return $this->belongsTo('App\project','id_project');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = 'configuration';
    protected $fillable = ['documentoDeConfiguracion','id_project'];
    protected $guarded = ['id_configuration'];
    public function project()
    {
        return $this->BelongsTo('App\project', 'id_project');
        
    }
}

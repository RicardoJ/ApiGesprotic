<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'project';
    public $timestamps = false;
    protected $fillable = ['actaDeConstitucion','directorDelProyecto','nombreDelProyecto','planDirectorDelProyecto'];
    protected $guarded = ['id_project'];


    public function lessonLearned()
    {
        return $this->hasOne('App\lessonLearned', 'id_project');
        
    }
    public function changeRequests()
    {
        return $this->hasMany('App\changeRequest','id_changeRequest');
    }
    public function configuration()
    {
        return $this->hasOne('App\configuration', 'id_project');
        
    }
    public function risk()
    {
        return $this->hasMany('App\risk','id_risk');
    }
}

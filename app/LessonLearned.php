<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LessonLearned extends Model
{
    protected $table = 'lessonLearned';
    protected $fillable = ['descripcion','informe','nombreDeLeccion','objetivo','id_project'];
   
    public function project()
    {
        return $this->BelongsTo('App\project', 'id_project');
        
    }
}

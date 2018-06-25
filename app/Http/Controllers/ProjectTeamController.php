<?php

namespace App\Http\Controllers;

use App\ProjectTeam;
use Illuminate\Http\Request;

class ProjectTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projectteam = ProjectTeam::all()->toArray();
        return response()->json($projectteam);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nombreDelIntegranteDelProyecto= $request->get('nombreDelIntegranteDelProyecto');
        $rolDelIntegrante= $request->get('rolDelIntegrante');
        $emailDelIntegrante= $request->get('emailDelIntegrante');
        $competenciasDelIntegranteDelProyecto= $request->get('competenciasDelIntegranteDelProyecto');
    try{
        if(!$nombreDelIntegranteDelProyecto||!$rolDelIntegrante||!$emailDelIntegrante||!$competenciasDelIntegranteDelProyecto){
            return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
           }
        
        $projectteam = new ProjectTeam ([
            'nombreDelIntegranteDelProyecto' => $request->input('nombreDelIntegranteDelProyecto'),
            'rolDelIntegrante' => $request->input('rolDelIntegrante'),
            'emailDelIntegrante' => $request->input('emailDelIntegrante'),
            'competenciasDelIntegranteDelProyecto' => $request->input('competenciasDelIntegranteDelProyecto')
        ]);
        $projectteam->save();
        return response()->json(['Creado'=>$projectteam],200);

        
    }catch(\Exception $e){
        
        Log::critical("no se ha podido crear el integrante: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
        return response('Algo esta mal',500);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function show($id_projectteam)
    {
        try{
           
            $projectteam =ProjectTeam::find($id_projectteam);
            
            
            if (!$projectteam) {
                return response()->json(['No existe el proveedor'],404);
            }
            return response()->json(['datos' => $projectteam],200);

        }catch(\Exception $e){
            
            Log::critical("no esta creado el proveedor: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_projectteam)
    {
        $metodo= $request->method();
        $projectteam = ProjectTeam::find($id_projectteam);

        $nombreDelIntegranteDelProyecto= $request->get('nombreDelIntegranteDelProyecto');
        $rolDelIntegrante= $request->get('rolDelIntegrante');
        $emailDelIntegrante= $request->get('emailDelIntegrante');
        $competenciasDelIntegranteDelProyecto= $request->get('competenciasDelIntegranteDelProyecto');

        if($metodo==="PATCH"){
         
            if ($nombreDelIntegranteDelProyecto!=null && $nombreDelIntegranteDelProyecto !='') {
                $projectteam->nombreDelIntegranteDelProyecto=$nombreDelIntegranteDelProyecto;
            }
           
            if ($rolDelIntegrante!=null && $rolDelIntegrante !='') {
                $projectteam->rolDelIntegrante=$rolDelIntegrante;
            }
           
            if ($emailDelIntegrante!=null && $emailDelIntegrante !='') {
                $projectteam->emailDelIntegrante=$emailDelIntegrante;
            }
           
            
            if ($competenciasDelIntegranteDelProyecto!=null && $competenciasDelIntegranteDelProyecto !='') {
                $projectteam->competenciasDelIntegranteDelProyecto=$competenciasDelIntegranteDelProyecto;
           
        }
        $projectteam->save();
        return response()->json(['integrante  editado'],200);
    }
    
    if(!$nombreDelIntegranteDelProyecto||!$rolDelIntegrante||!$emailDelIntegrante||!$competenciasDelIntegranteDelProyecto){
        return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
       }
       $projectteam->nombreDelIntegranteDelProyecto=$nombreDelIntegranteDelProyecto;
       $projectteam->rolDelIntegrante=$rolDelIntegrante;
       $projectteam->emailDelIntegrante=$emailDelIntegrante;
       $projectteam->competenciasDelIntegranteDelProyecto=$competenciasDelIntegranteDelProyecto;
     
       $projectteam->save();
       return response()->json(['integrante editado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProjectTeam  $projectTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_projectteam)
    {
        try{
           
            $projectteam =ProjectTeam::find($id_projectteam);
            if (!$projectteam) {
                return response()->json(['No existe el integrante'],404);
            }
           
            $projectteam->delete();
            return response()->json(['Eliminado' => $projectteam],200);

       }catch(\Exception $e){
            
            Log::critical("ERROR: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }
}

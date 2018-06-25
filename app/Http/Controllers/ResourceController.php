<?php

namespace App\Http\Controllers;

use App\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $resource = Resource::all()->toArray();
        return response()->json($resource);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $descripcion= $request->get('descripcion');
        $fechaInicial= $request->get('fechaInicial');
        $fechaFinal= $request->get('fechaFinal');
        $nombreDelRecurso= $request->get('nombreDelRecurso');
        $origen= $request->get('origen');
        $relevancia= $request->get('relevancia');
        $tipo= $request->get('tipo');
        $unidades= $request->get('unidades');
    try{
        if(!$descripcion||!$fechaInicial||!$fechaFinal||!$nombreDelRecurso||!$origen||!$relevancia||!$tipo||!$unidades){
            return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
           }
        
        $resource = new Resource ([
            'descripcion' => $request->input('descripcion'),
            'fechaInicial' => $request->input('fechaInicial'),
            'fechaFinal' => $request->input('fechaFinal'),
            'nombreDelRecurso' => $request->input('nombreDelRecurso'),
            'origen' => $request->input('origen'),
            'relevancia' => $request->input('relevancia'),
            'tipo' => $request->input('tipo'),
            'unidades' => $request->input('unidades')
        ]);
        $resource->save();
        return response()->json(['Creado'=>$resource],200);

        
    }catch(\Exception $e){
        Log::critical("no se ha podido crear el Recurso: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
        return response('Algo esta mal',500);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show($id_resource)
    {
        try{
           
            $resource =Resource::find($id_resource);
            if (!$resource) {
                return response()->json(['No existe el recurso'],404);
            }
            return response()->json(['datos' => $resource],200);

        }catch(\Exception $e){
            
            Log::critical("no esta creado el recurso: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_resource)
    {
        $metodo= $request->method();
        $resource = Resource::find($id_resource);

        $descripcion= $request->get('descripcion');
        $fechaInicial= $request->get('fechaInicial');
        $fechaFinal= $request->get('fechaFinal');
        $nombreDelRecurso= $request->get('nombreDelRecurso');
        $origen= $request->get('origen');
        $relevancia= $request->get('relevancia');
        $tipo= $request->get('tipo');
        $unidades= $request->get('unidades');

        if($metodo==="PATCH"){
         
            if ($descripcion!=null && $descripcion !='') {
                $resource->descripcion=$descripcion;
            }
           
            if ($fechaInicial!=null && $fechaInicial !='') {
                $resource->fechaInicial=$fechaInicial;
            }
           
            if ($fechaFinal!=null && $fechaFinal !='') {
                $resource->fechaFinal=$fechaFinal;
            }
           
            if ($nombreDelRecurso!=null && $nombreDelRecurso !='') {
                $resource->nombreDelRecurso=$nombreDelRecurso;
            }
            
            if ($origen!=null && $origen !='') {
                $resource->origen=$origen;
            }
            if ($relevancia!=null && $relevancia !='') {
                $resource->relevancia=$relevancia;
            }
            if ($tipo!=null && $tipo !='') {
                $resource->tipo=$tipo;
            }
            if ($unidades!=null && $unidades !='') {
                $resource->unidades=$unidades;
            }
        $resource->save();
        return response()->json(['Recurso editado'],200);
    }
    
    if(!$descripcion||!$fechaInicial||!$fechaFinal||!$nombreDelRecurso||!$origen||!$relevancia||!$tipo||!$unidades){
        return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
       }
       $resource->descripcion=$descripcion;
       $resource->fechaInicial=$fechaInicial;
       $resource->fechaFinal=$fechaFinal;
       $resource->nombreDelRecurso=$nombreDelRecurso;
       $resource->origen=$origen;
       $resource->relevancia=$relevancia;
       $resource->tipo=$tipo;
       $resource->unidades=$unidades;
       $resource->save();
       return response()->json(['Recurso editado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_resource)
    {
        try{
           
            $resource =Resource::find($id_resource);
            if (!$resource) {
                return response()->json(['No existe el recurso'],404);
            }
           
            $resource->delete();
            return response()->json(['Eliminado' => $resource],200);

       }catch(\Exception $e){
            
            Log::critical("ERROR: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }
}

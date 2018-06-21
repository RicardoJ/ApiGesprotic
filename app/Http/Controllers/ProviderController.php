<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $provider = Provider::all()->toArray();
        return response()->json($provider);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
   
    try{
        if(!$request->get('nombreDeLaEmpresa')||!$request->get('nombrePersonaDeContacto')||!$request->get('telefono')||!$request->get('direccion')||!$request->get('email')){
            return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
           }
        
        $provider = new Provider ([
            'nombreDeLaEmpresa' => $request->input('nombreDeLaEmpresa'),
            'nombrePersonaDeContacto' => $request->input('nombrePersonaDeContacto'),
            'telefono' => $request->input('telefono'),
            'direccion' => $request->input('direccion'),
            'email' => $request->input('email')
        ]);
        $provider->save();
        return response()->json($provider,200);

        
    }catch(\Exception $e){
        
        Log::critical("no se ha podido crear el proveedor: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
        return response('Algo esta mal',500);
    }
      

    }

    /**
     * Display the specified resource.
     *
     * 
     * @param int $id_provider
     * @return \Illuminate\Http\Response
     */
    public function show($id_provider)
    {
     
       try{
           
            $provider =Provider::find($id_provider);
            
            
            if (!$provider) {
                return response()->json(['No existe el proveedor'],404);
            }
            return response()->json(['datos' => $provider],200);

        }catch(\Exception $e){
            
            Log::critical("no esta creado el proveedor: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id_provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_provider)
    {
        $metodo= $request->method();
        $provider = Provider::find($id_provider);
        if($metodo==="PATCH"){
            $nombreDeLaEmpresa= $request->get('nombreDeLaEmpresa');
            if ($nombreDeLaEmpresa!=null && $nombreDeLaEmpresa !='') {
                $provider->nombreDeLaEmpresa=$nombreDeLaEmpresa;
            }
            $nombrePersonaDeContacto= $request->get('nombrePersonaDeContacto');
            if ($nombrePersonaDeContacto!=null && $nombrePersonaDeContacto !='') {
                $provider->nombrePersonaDeContacto=$nombrePersonaDeContacto;
            }
            $telefono= $request->get('telefono');
            if ($telefono!=null && $telefono !='') {
                $provider->telefono=$telefono;
            }
            $direccion= $request->get('direccion');
            if ($direccion!=null && $direccion !='') {
                $provider->direccion=$direccion;
            }
            $email= $request->get('email');
            if ($email!=null && $email !='') {
                $provider->email=$email;
           
        }
        $provider->save();
        return response()->json(['Proveedor editado'],200);
    }
    $nombreDeLaEmpresa= $request->get('nombreDeLaEmpresa');
    $nombrePersonaDeContacto= $request->get('nombrePersonaDeContacto');
    $telefono= $request->get('telefono');
    $direccion= $request->get('direccion');
    $email= $request->get('email');
    if(!$nombreDeLaEmpresa|| !$nombrePersonaDeContacto||!$telefono||!$direccion||!$email){
        return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],404);
       }
       $provider->nombreDeLaEmpresa=$nombreDeLaEmpresa;
       $provider->nombrePersonaDeContacto=$nombrePersonaDeContacto;
       $provider->telefono=$telefono;
       $provider->direccion=$direccion;
       $provider->email=$email;
       $provider->save();
       return response()->json(['Proveedor editado'],200);

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_provider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_provider)
    {
        try{
           
            $provider =Provider::find($id_provider);
            
            
            if (!$provider) {
                return response()->json(['No existe el proveedor'],404);
            }
            $provider->delete();
            return response()->json(['Eliminado' => $provider],200);

        }catch(\Exception $e){
            
            Log::critical("ERROR: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }
}

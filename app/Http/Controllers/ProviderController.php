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
     * @param  \App\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Provider $provider)
    {
        //
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

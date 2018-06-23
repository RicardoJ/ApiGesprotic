<?php

namespace App\Http\Controllers;

use App\Agreement;
use Illuminate\Http\Request;

class AgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $agreement = Agreement::all()->toArray();
        return response()->json($agreement);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {/*
        Pendiente a correcion o eliminar de aqui esta funcion 

        $contenidoDelContrato= $request->get('contenidoDelContrato');
        $fechaDeEntrega= $request->get('fechaDeEntrega');
        $fechaDelContrato= $request->get('fechaDelContrato');
        $metodoDePago= $request->get('metodoDePago');
        $nombreDeLaEmpresa= $request->get('nombreDeLaEmpresa');
        $personaEncargada= $request->get('personaEncargada');
        $id_provider= $request->get('id_provider');
        try{
            if(!$contenidoDelContrato||!$fechaDeEntrega||!$fechaDelContrato||!$metodoDePago||!$nombreDeLaEmpresa||!$personaEncargada||!$id_provider){
                return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
               }
            
            $agreement = new Agreement ([
                'contenidoDelContrato' => $request->input('contenidoDelContrato'),
                'fechaDeEntrega' => $request->input('fechaDeEntrega'),
                'fechaDelContrato' => $request->input('fechaDelContrato'),
                'metodoDePago' => $request->input('metodoDePago'),
                'nombreDeLaEmpresa' => $request->input('nombreDeLaEmpresa'),
                'personaEncargada' => $request->input('personaEncargada'),
                'id_provider'=>$request->input('id_provider')
            ]);
            $agreement->save();
            return response()->json(['Creado'=>$agreement],200);
            
            
        }catch(\Exception $e){
            
            Log::critical("no se ha podido crear el proveedor: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id_agreement
     * @return \Illuminate\Http\Response
     */
    public function show($id_agreement)
    {
        try{
           
            $agreement =Agreement::find($id_agreement);
            
            
            if (!$agreement) {
                return response()->json(['No existe el contrato'],404);
            }
            return response()->json(['datos' => $agreement],200);

        }catch(\Exception $e){
            
            Log::critical("no esta creado el contrato: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
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
    public function update(Request $request, $id_agreement)
    {
        $metodo= $request->method();
        $agreement = Agreement::find($id_agreement);
        $contenidoDelContrato= $request->get('contenidoDelContrato');
        $fechaDeEntrega= $request->get('fechaDeEntrega');
        $fechaDelContrato= $request->get('fechaDelContrato');
        $metodoDePago= $request->get('metodoDePago');
        $nombreDeLaEmpresa= $request->get('nombreDeLaEmpresa');
        $personaEncargada= $request->get('personaEncargada');
        $id_provider= $request->get('id_provider');

        if($metodo==="PATCH"){
            
            if ($contenidoDelContrato!=null && $contenidoDelContrato !='') {
                $agreement->contenidoDelContrato=$contenidoDelContrato;
            }
            
            if ($fechaDeEntrega!=null && $fechaDeEntrega !='') {
                $agreement->fechaDeEntrega=$fechaDeEntrega;
            }
            
            if ($fechaDelContrato!=null && $fechaDelContrato !='') {
                $agreement->fechaDelContrato=$fechaDelContrato;
            }
            
            if ($metodoDePago!=null && $metodoDePago !='') {
                $agreement->metodoDePago=$metodoDePago;
            }
            
            if ($nombreDeLaEmpresa!=null && $nombreDeLaEmpresa !='') {
                $agreement->nombreDeLaEmpresa=$nombreDeLaEmpresa;
            }
            
            if ($personaEncargada!=null && $personaEncargada !='') {
                $agreement->personaEncargada=$personaEncargada;
            }
            if ($id_provider!=null && $id_provider !='') {
                $agreement->id_provider=$id_provider;
            }
        $agreement->save();
        return response()->json([' editado'],200);
    }
    
    if(!$contenidoDelContrato|| !$fechaDeEntrega||!$fechaDelContrato||!$metodoDePago||!$nombreDeLaEmpresa||!$personaEncargada||!$id_provider){
        return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],404);
       }
       $agreement->contenidoDelContrato=$contenidoDelContrato;
       $agreement->fechaDeEntrega=$fechaDeEntrega;
       $agreement->fechaDelContrato=$fechaDelContrato;
       $agreement->metodoDePago=$metodoDePago;
       $agreement->nombreDeLaEmpresa=$nombreDeLaEmpresa;
       $agreement->personaEncargada=$personaEncargada;
       $agreement->id_provider=$id_provider;
       $agreement->save();
       return response()->json(['contrato editado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id_agreement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_agreement)
    {
        try{
           
            $agreement =Agreement::find($id_agreement);
            
            
            if (!$agreement) {
                return response()->json(['No existe el contrato'],404);
            }
            $agreement->delete();
            return response()->json(['Eliminado' => $agreement],200);

        }catch(\Exception $e){
            
            Log::critical("ERROR: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }
}

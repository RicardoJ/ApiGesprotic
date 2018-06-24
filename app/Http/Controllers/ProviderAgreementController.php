<?php

namespace App\Http\Controllers;

use App\ProviderAgreement;
use App\Provider;
use App\Agreement;
use Illuminate\Http\Request;

class ProviderAgreementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_provider)
    {
        $provider = Provider::find($id_provider);
        $agreement = $provider->agreement;
        if (!$provider) {
            return response()->json(['No existe el proveedor'],404);
        }
        return response()->json(['Proveedor con contrato'=>$agreement],202);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id_provider)
    {
        $contenidoDelContrato= $request->get('contenidoDelContrato');
        $fechaDeEntrega= $request->get('fechaDeEntrega');
        $fechaDelContrato= $request->get('fechaDelContrato');
        $metodoDePago= $request->get('metodoDePago');
        $nombreDeLaEmpresa= $request->get('nombreDeLaEmpresa');
        $personaEncargada= $request->get('personaEncargada');
        
        try{
            if(!$contenidoDelContrato||!$fechaDeEntrega||!$fechaDelContrato||!$metodoDePago||!$nombreDeLaEmpresa||!$personaEncargada){
                return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],422);
               }
            $provider=Provider::find($id_provider);
            if (!$provider) {
                return response()->json(['No existe el proveedor'],404);
            }else{
            $agreement = new Agreement ([
                'contenidoDelContrato' => $request->input('contenidoDelContrato'),
                'fechaDeEntrega' => $request->input('fechaDeEntrega'),
                'fechaDelContrato' => $request->input('fechaDelContrato'),
                'metodoDePago' => $request->input('metodoDePago'),
                'nombreDeLaEmpresa' => $request->input('nombreDeLaEmpresa'),
                'personaEncargada' => $request->input('personaEncargada'),
                'id_provider'=>$id_provider
            ]);
            $agreement->save();
            return response()->json(['Creado'=>$agreement],200);
        }
            
        }catch(\Exception $e){
            
            Log::critical("no se ha podido crear el proveedor: {$e->getCode()} , {$e->getLine()} , {$e->getMessage()}");
            return response('Algo esta mal',500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProviderAgreement  $providerAgreement
     * @return \Illuminate\Http\Response
     */
    public function show(ProviderAgreement $providerAgreement)
    {
        //
    }

 

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProviderAgreement  $providerAgreement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_provider,$id_agreement)
    {
        $metodo= $request->method();
        $provider = Provider::find($id_provider);
        if (!$provider) {
            return response()->json(['No se encuentra  el proveedor'],404);
        }
        $agreement=$provider->agreement()->find($id_agreement);
        if (!$agreement) {
                return response()->json(['No existe el contrato'],404);
            }

            $contenidoDelContrato= $request->get('contenidoDelContrato');
            $fechaDeEntrega= $request->get('fechaDeEntrega');
            $fechaDelContrato= $request->get('fechaDelContrato');
            $metodoDePago= $request->get('metodoDePago');
            $nombreDeLaEmpresa= $request->get('nombreDeLaEmpresa');
            $personaEncargada= $request->get('personaEncargada');

            $flag=false;
        if($metodo==="PATCH"){
         
            if ($contenidoDelContrato!=null && $contenidoDelContrato !='') {
                $agreement->contenidoDelContrato=$contenidoDelContrato;
                $flag=true;
            }
            
            if ($fechaDeEntrega!=null && $fechaDeEntrega !='') {
                $agreement->fechaDeEntrega=$fechaDeEntrega;
                $flag=true;
            }
            
            if ($fechaDelContrato!=null && $fechaDelContrato !='') {
                $agreement->fechaDelContrato=$fechaDelContrato;
                $flag=true;
            }
            
            if ($metodoDePago!=null && $metodoDePago !='') {
                $agreement->metodoDePago=$metodoDePago;
                $flag=true;
            }
            
            if ($nombreDeLaEmpresa!=null && $nombreDeLaEmpresa !='') {
                $agreement->nombreDeLaEmpresa=$nombreDeLaEmpresa;
                $flag=true;
            }
            
            if ($personaEncargada!=null && $personaEncargada !='') {
                $agreement->personaEncargada=$personaEncargada;
                $flag=true;
            }
          
            if ($flag) {
                $agreement->save();
                return response()->json(['Contrato editado'],202);
            }
            return response()->json(['No se ha podido guardar los cambios'],200);
       
    }
    
    if(!$contenidoDelContrato|| !$fechaDeEntrega||!$fechaDelContrato||!$metodoDePago||!$nombreDeLaEmpresa||!$personaEncargada){
        return response()->json(['Advertencia'=> 'Datos erroneos o incompletos'],404);
       }
       $agreement->contenidoDelContrato=$contenidoDelContrato;
       $agreement->fechaDeEntrega=$fechaDeEntrega;
       $agreement->fechaDelContrato=$fechaDelContrato;
       $agreement->metodoDePago=$metodoDePago;
       $agreement->nombreDeLaEmpresa=$nombreDeLaEmpresa;
       $agreement->personaEncargada=$personaEncargada;
       //$agreement->id_provider=$id_provider;
       $agreement->save();
       return response()->json(['contrato editado'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderAgreement  $providerAgreement
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_provider,$id_agreement)
    {
        $provider = Provider::find($id_provider);
        if (!$provider) {
            return response()->json(['No se encuentra  el proveedor'],404);
        }
        $agreement=$provider->agreement()->find($id_agreement);
        if (!$agreement) {
                return response()->json(['No existe el contrato del proveedor asociado'],404);
            }
            $agreement->delete();
            return response()->json(['contrato eliminado'],200);
    }
}

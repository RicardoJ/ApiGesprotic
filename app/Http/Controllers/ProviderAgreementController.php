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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProviderAgreement  $providerAgreement
     * @return \Illuminate\Http\Response
     */
    public function edit(ProviderAgreement $providerAgreement)
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
    public function update(Request $request, ProviderAgreement $providerAgreement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProviderAgreement  $providerAgreement
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProviderAgreement $providerAgreement)
    {
        //
    }
}

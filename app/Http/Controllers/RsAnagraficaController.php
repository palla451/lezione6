<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use Illuminate\Http\Request;

class RsAnagraficaController extends Controller
{

    public function index()
    {
        // formato json paginati per 15
        return Anagrafica::paginate(15);
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
    public function store(Request $request)
    {
        // richiamo il Model ed inietto i dati di $request //
        $mdlAnagrafica = new Anagrafica();
        $mdlAnagrafica->nome        = $request->get('fldNome');
        $mdlAnagrafica->cognome     = $request->get('fldCognome');
        $mdlAnagrafica->email       = $request->get('fldEmail');

       $mdlAnagrafica->save();

        $data   = [
           // 'name' => $request->get('fldName'),
            'status' => 200,
            'msg'   => 'Record anagrafica inserito',
            'idCreated' => $mdlAnagrafica->id
        ];

        // restituisco il JSON con $data
        return response()
            ->json($data, 200)
            ->withCallback($request->get('callback'))
        ;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Anagrafica  $anagrafica
     * @return \Illuminate\Http\Response
     */
    public function show(Anagrafica $anagrafica)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Anagrafica  $anagrafica
     * @return \Illuminate\Http\Response
     */
    public function edit(Anagrafica $anagrafica)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Anagrafica  $anagrafica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anagrafica $anagrafica)
    {
        // === Istanza anagrafica del Model Anagrafica


        $anagrafica->nome = $request->get('fldNome');
        $anagrafica->cognome = $request->get('fldCognome');
        $anagrafica->email = $request->get('fldEmail');

        $anagrafica->save();

        $data   = [
            // 'name' => $request->get('fldName'),
            'status' => 200,
            'msg'   => 'Record anagrafica modificato',
            'idCreated' => $anagrafica->id
        ];

        // === restituisco il JSON con $data
        return response()
            ->json($data, 200)
            ->withCallback($request->get('callback'))
            ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Anagrafica  $anagrafica
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anagrafica $anagrafica)
    {
        //
    }
}

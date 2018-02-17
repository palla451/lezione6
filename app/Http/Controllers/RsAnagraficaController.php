<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use Illuminate\Http\Request;

class RsAnagraficaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $mdlAnagrafica->nome        = $request->get('fldName');
        $mdlAnagrafica->cognome     = $request->get('fldCognome');
        $mdlAnagrafica->email       = $request->get('fldEmail');

        $mdlAnagrafica->save();

        $data   = [
            'status' => 200,
            'msg'   => 'Record inserito',
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
        //
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

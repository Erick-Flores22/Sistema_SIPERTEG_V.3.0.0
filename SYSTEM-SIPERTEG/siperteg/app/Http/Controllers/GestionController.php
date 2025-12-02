<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Illuminate\Http\Request;

class GestionController extends Controller
{
    public function index()
    {
        $gestiones = Gestion::withCount('periodos')->get();
        return view('gestiones.index', compact('gestiones'));
    }

    public function create()
    {
        return view('gestiones.create');
    }

    public function store(Request $request)
    {
        $request->validate(['anio' => 'required|integer|unique:gestiones,anio']);
        $gestion = Gestion::create(['anio' => $request->anio]);

        // generar 12 periodos
        for ($m = 1; $m <= 12; $m++) {
            $gestion->periodos()->create(['mes' => $m]);
        }

        return redirect()->route('gestiones.index')->with('success','Gestión creada');
    }
}

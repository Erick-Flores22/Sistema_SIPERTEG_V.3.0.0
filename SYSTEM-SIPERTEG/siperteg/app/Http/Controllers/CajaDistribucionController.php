<?php

namespace App\Http\Controllers;

use App\Models\CajaDistribucion;
use App\Models\Nodo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CajaDistribucionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Lista paginada de cajas con su nodo */
    public function index()
    {
        $cajas = CajaDistribucion::with('nodo')
                   ->orderBy('id', 'desc')
                   ->paginate(10);

        return view('cajas_distribucion.index', compact('cajas'));
    }

    /** Formulario para crear */
    public function create()
    {
        $nodos = Nodo::orderBy('nombre')->get();
        return view('cajas_distribucion.create', compact('nodos'));
    }

    /** Guarda la nueva caja */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nodo_id' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'capacidad' => 'required|integer',
            'potencia_partida' => 'required|numeric',
            'potencia_llegada' => 'required|numeric',
            'potencia_distribucion' => 'required|numeric',
            'usuarios_conectados' => 'required|integer',
            'foto_nodo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'plano_troncal' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'observaciones' => 'nullable|string',
        ]);

        if ($request->hasFile('plano_subtroncal')) {
            $validated['plano_subtroncal'] = $request->file('plano_subtroncal')->store('planos', 'public');
        }

        if ($request->hasFile('foto_caja')) {
            $validated['foto_caja'] = $request->file('foto_caja')->store('fotos_cajas', 'public');
        }

        // Aumentar contador de cajas conectadas en el nodo
        $nodo = Nodo::find($request->nodo_id);
        $nodo->increment('cajas_conectadas');

        CajaDistribucion::create($validated);

        return redirect()
            ->route('cajas_distribucion.index')
            ->with('success', 'Caja registrada correctamente.');
    }

    /** Formulario de edición */
    public function edit(CajaDistribucion $cajaDistribucion)
    {
        $nodos = Nodo::orderBy('nombre')->get();
        return view('cajas_distribucion.edit', compact('cajaDistribucion', 'nodos'));
    }

    /** Actualiza la caja */
    public function update(Request $request, CajaDistribucion $cajaDistribucion)
    {
        $validated = $request->validate([
            'nodo_id' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'capacidad' => 'required|integer',
            'potencia_partida' => 'required|numeric',
            'potencia_llegada' => 'required|numeric',
            'potencia_distribucion' => 'required|numeric',
            'usuarios_conectados' => 'required|integer',
            'plano_subtroncal' => 'nullable|string',
            'foto_caja' => 'nullable|string',
            'observaciones' => 'nullable|string',
        ]);

        $cajaDistribucion->update($validated);

        return redirect()
            ->route('cajas_distribucion.index')
            ->with('success', 'Caja actualizada correctamente.');
    }

    /** Elimina la caja */
    public function destroy(CajaDistribucion $cajaDistribucion)
    {
        $cajaDistribucion->delete();

        return redirect()
            ->route('cajas_distribucion.index')
            ->with('success', 'Caja eliminada correctamente.');
    }

    /** Muestra la caja */
    public function show($id)
{
    $caja = CajaDistribucion::with('nodo')->findOrFail($id);
    return view('cajas_distribucion.show', ['cajaDistribucion' => $caja]);
}
public function mapa($id)
{
    $caja = CajaDistribucion::findOrFail($id);

    // Abonados vinculados desde datos_tecnicos
    $abonados = DB::table('datos_tecnicos')
        ->join('abonados', 'datos_tecnicos.abonado_id', '=', 'abonados.id')
        ->where('datos_tecnicos.caja_distribucion_id', $id)
        ->select('abonados.id', 'abonados.nombre')
        ->get();

    return view('cajas_distribucion.mapa', compact('caja', 'abonados'));
}
public function porNodo($nodoId)
{
    $cajas = CajaDistribucion::where('nodo_id', $nodoId)->get(['id','nombre']);
    return response()->json($cajas);
}

}

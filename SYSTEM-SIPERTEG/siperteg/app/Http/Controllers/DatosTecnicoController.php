<?php

namespace App\Http\Controllers;

use App\Models\DatosTecnico;
use App\Models\Nodo;
use App\Models\CajaDistribucion;
use App\Models\Abonado;
use App\Models\Plan;
use Illuminate\Http\Request;

class DatosTecnicoController extends Controller
{
    public function index()
    {
        $datos = DatosTecnico::with(['abonado','nodo', 'cajaDistribucion', 'plan'])->paginate(10);
        return view('datos_tecnicos.index', compact('datos'));
    }

    public function create(Request $request)
    {
        // Abonados sin datos técnicos
        $abonados = Abonado::whereDoesntHave('datosTecnico')
            ->orderBy('apellido')
            ->orderBy('nombre')
            ->select('id','nombre','apellido','ci')
            ->get();

        $nodos = Nodo::orderBy('nombre')->get(['id','nombre']);
        $cajas = CajaDistribucion::orderBy('nombre')->get(['id','nombre']);
        $planes = Plan::orderBy('nombre')->get(); // <- AQUÍ VA

        return view('datos_tecnicos.create', compact('nodos', 'cajas', 'abonados', 'planes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'abonado_id'           => ['required','integer','exists:abonados,id','unique:datos_tecnicos,abonado_id'],
            'plan_id'              => ['required','exists:planes,id'], // <- CORRECTO
            'odn'                  => ['required','string'],

            'password'             => ['required','string'],
            'codigo_tecnico'       => ['required','string'],
            'codigo_sistema'       => ['required','string'],
            'fecha_instalacion'    => ['required','date'],
            'observaciones'        => ['nullable','string'],
            'caja_distribucion_id' => ['required','exists:cajas_distribucion,id'],
            'potencia_partida'     => ['required','numeric'],
            'potencia_llegada'     => ['required','numeric'],
            'foto_plano'           => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        ]);

        $caja = CajaDistribucion::findOrFail($request->caja_distribucion_id);

        // Guardar foto si existe
        $fotoPath = null;
        if ($request->hasFile('foto_plano')) {
            $fotoPath = $request->file('foto_plano')->store('fotos_planos', 'public');
        }

        DatosTecnico::create([
            'abonado_id'           => $request->abonado_id,
            'plan_id'              => $request->plan_id, // <- CORRECTO
            'odn'                  => $request->odn,

            'password'             => $request->password,
            'codigo_tecnico'       => $request->codigo_tecnico,
            'codigo_sistema'       => $request->codigo_sistema,
            'fecha_instalacion'    => $request->fecha_instalacion,
            'observaciones'        => $request->observaciones,
            'nodo_id'              => $caja->nodo_id,
            'caja_distribucion_id' => $caja->id,
            'potencia_partida'     => $request->potencia_partida,
            'potencia_llegada'     => $request->potencia_llegada,
            'foto_plano'           => $fotoPath,
        ]);

        $caja->increment('usuarios_conectados');

        return redirect()->route('abonados.index')->with('success', 'Registro creado correctamente.');
    }


    public function edit(DatosTecnico $datosTecnico)
    {
        $nodos = Nodo::orderBy('nombre')->get(['id','nombre']);
        $cajas = CajaDistribucion::orderBy('nombre')->get(['id','nombre']);
        $planes = Plan::orderBy('nombre')->get();  // <- AQUÍ VA

        $datosTecnico->load(['abonado','nodo','cajaDistribucion','plan']);

        return view('datos_tecnicos.edit', compact('datosTecnico', 'nodos', 'cajas', 'planes'));
    }

    public function update(Request $request, DatosTecnico $datosTecnico)
    {
        $request->validate([
            'abonado_id'           => ['required','integer','exists:abonados,id', 'unique:datos_tecnicos,abonado_id,'.$datosTecnico->id],
            'plan_id'              => ['required','exists:planes,id'], // <- CORRECTO
            'odn'                  => ['required','string'],

            'password'             => ['required','string'],
            'codigo_tecnico'       => ['required','string'],
            'codigo_sistema'       => ['required','string'],
            'fecha_instalacion'    => ['required','date'],
            'observaciones'        => ['nullable','string'],
            'caja_distribucion_id' => ['required','exists:cajas_distribucion,id'],
            'potencia_partida'     => ['required','numeric'],
            'potencia_llegada'     => ['required','numeric'],
            'foto_plano'           => ['nullable','image','mimes:jpg,jpeg,png','max:2048'],
        ]);

        $caja = CajaDistribucion::findOrFail($request->caja_distribucion_id);

        $fotoPath = $datosTecnico->foto_plano;
        if ($request->hasFile('foto_plano')) {
            $fotoPath = $request->file('foto_plano')->store('fotos_planos', 'public');
        }

        $datosTecnico->update([
            'abonado_id'           => $request->abonado_id,
            'plan_id'              => $request->plan_id, // <- CORRECTO
            'odn'                  => $request->odn,

            'password'             => $request->password,
            'codigo_tecnico'       => $request->codigo_tecnico,
            'codigo_sistema'       => $request->codigo_sistema,
            'fecha_instalacion'    => $request->fecha_instalacion,
            'observaciones'        => $request->observaciones,
            'nodo_id'              => $caja->nodo_id,
            'caja_distribucion_id' => $caja->id,
            'potencia_partida'     => $request->potencia_partida,
            'potencia_llegada'     => $request->potencia_llegada,
            'foto_plano'           => $fotoPath,
        ]);

        return redirect()->route('abonados.index')->with('success', 'Registro actualizado correctamente.');
    }

    public function destroy(DatosTecnico $datosTecnico)
    {
        $datosTecnico->delete();
        return redirect()->route('datos_tecnicos.index')->with('success', 'Registro eliminado correctamente.');
    }
}

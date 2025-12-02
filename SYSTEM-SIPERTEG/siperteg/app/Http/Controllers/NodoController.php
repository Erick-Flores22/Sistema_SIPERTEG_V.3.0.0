<?php

namespace App\Http\Controllers;

use App\Models\Nodo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class NodoController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $nodos = Nodo::orderBy('id', 'desc')->paginate(10);
        return view('nodos.index', compact('nodos'));
    }

    public function create()
    {
        return view('nodos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:0|max:255',
            'puerto_olt' => 'required|string|max:100',
            'puerto_edfa' => 'required|string|max:100',
            'potencia_partida' => 'required|numeric',
            'potencia_llegada' => 'required|numeric',
            'potencia_distribucion' => 'required|numeric',
            'cajas_conectadas' => 'required|integer|min:0',
            'plano_troncal' => 'nullable|image|max:2048',
            'foto_nodo' => 'nullable|image|max:2048',
            'observacion' => 'nullable|string',
        ]);

        if ($request->hasFile('plano_troncal')) {
            $validated['plano_troncal'] = $request->file('plano_troncal')->store('planos_troncales', 'public');
        }

        if ($request->hasFile('foto_nodo')) {
            $validated['foto_nodo'] = $request->file('foto_nodo')->store('fotos_nodos', 'public');
        }

        Nodo::create($validated);

        return redirect()->route('nodos.index')->with('success', 'Nodo creado correctamente.');
    }

    public function edit(Nodo $nodo)
    {
        return view('nodos.edit', compact('nodo'));
    }

    public function update(Request $request, Nodo $nodo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'zona' => 'required|string|max:255',
            'capacidad' => 'required|integer|min:0|max:255',
            'puerto_olt' => 'required|string|max:100',
            'puerto_edfa' => 'required|string|max:100',
            'potencia_partida' => 'required|numeric',
            'potencia_llegada' => 'required|numeric',
            'potencia_distribucion' => 'required|numeric',
            'cajas_conectadas' => 'required|integer|min:0',
            'plano_troncal' => 'nullable|image|max:2048',
            'foto_nodo' => 'nullable|image|max:2048',
            'observacion' => 'nullable|string',
        ]);

        if ($request->hasFile('plano_troncal')) {
            $validated['plano_troncal'] = $request->file('plano_troncal')->store('planos_troncales', 'public');
        }

        if ($request->hasFile('foto_nodo')) {
            $validated['foto_nodo'] = $request->file('foto_nodo')->store('fotos_nodos', 'public');
        }

        $nodo->update($validated);

        return redirect()->route('nodos.index')->with('success', 'Nodo actualizado correctamente.');
    }

    public function destroy(Nodo $nodo)
    {
        $nodo->delete();

        return redirect()->route('nodos.index')->with('success', 'Nodo eliminado correctamente.');
    }

    public function mapa(Nodo $nodo)
    {
        $cajas = $nodo->cajas; // Asegúrate de que esté definida la relación hasMany en el modelo Nodo
        return view('nodos.mapa', compact('nodo', 'cajas'));
    }

    public function show(Nodo $nodo)
    {
        return view('nodos.show', compact('nodo'));
    }

    public function showMapa($id)
    {
        $nodo = Nodo::with('cajas')->findOrFail($id);
        $cajas = $nodo->cajas;

        return view('nodos.mapa', compact('nodo', 'cajas'));
    }
}

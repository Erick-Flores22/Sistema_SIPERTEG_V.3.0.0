<?php

namespace App\Http\Controllers;

use App\Models\Defecto;
use Illuminate\Http\Request;

class DefectoController extends Controller
{
    public function index()
    {
        $defectos = Defecto::latest()->paginate(10);
        return view('defectos.index', compact('defectos'));
    }

    public function create()
    {
        $estados = Defecto::estados();
        return view('defectos.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            
            'detalle' => 'required|string',
            'estado' => 'required|in:PENDIENTE,EN REVISION,ASIGNADA,SOLUCIONADA,RECHAZADA',
            'observaciones' => 'nullable|string',
        ]);

        Defecto::create($request->all());

        return redirect()->route('defectos.index')->with('success', 'Defecto registrado correctamente.');
    }

    public function show(Defecto $defecto)
    {
        return view('defectos.show', compact('defecto'));
    }

    public function edit(Defecto $defecto)
    {
        $estados = Defecto::estados();
        return view('defectos.edit', compact('defecto', 'estados'));
    }

    public function update(Request $request, Defecto $defecto)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
           
            'detalle' => 'required|string',
            'estado' => 'required|in:PENDIENTE,EN REVISION,ASIGNADA,SOLUCIONADA,RECHAZADA',
            'observaciones' => 'nullable|string',
        ]);

        $defecto->update($request->all());

        return redirect()->route('defectos.index')->with('success', 'Defecto actualizado correctamente.');
    }

    public function destroy(Defecto $defecto)
    {
        $defecto->delete();
        return redirect()->route('defectos.index')->with('success', 'Defecto eliminado correctamente.');
    }
}

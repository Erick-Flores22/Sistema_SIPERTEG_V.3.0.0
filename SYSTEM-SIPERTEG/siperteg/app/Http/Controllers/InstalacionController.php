<?php

namespace App\Http\Controllers;

use App\Models\Instalacion;
use Illuminate\Http\Request;

class InstalacionController extends Controller
{
    public function index()
    {
        $instalaciones = Instalacion::latest()->paginate(10);
        return view('instalaciones.index', compact('instalaciones'));
    }

    public function create()
    {
        $estados = Instalacion::estados();
        return view('instalaciones.create', compact('estados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            
            'estado' => 'required|in:PENDIENTE,EN REVISION,ASIGNADA,RECHAZADA,COMPLETADA',
            'observaciones' => 'nullable|string',
        ]);

        Instalacion::create($request->all());

        return redirect()->route('instalaciones.index')->with('success', 'Instalación creada correctamente.');
    }

    public function show(Instalacion $instalacion)
    {
        return view('instalaciones.show', compact('instalacion'));
    }

    public function edit(Instalacion $instalacion)
    {
        $estados = Instalacion::estados();
        return view('instalaciones.edit', compact('instalacion', 'estados'));
    }

    public function update(Request $request, Instalacion $instalacion)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'celular' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
           
            'estado' => 'required|in:PENDIENTE,EN REVISION,ASIGNADA,RECHAZADA,COMPLETADA',
            'observaciones' => 'nullable|string',
        ]);

        $instalacion->update($request->all());

        return redirect()->route('instalaciones.index')->with('success', 'Instalación actualizada correctamente.');
    }

    public function destroy(Instalacion $instalacion)
    {
        $instalacion->delete();
        return redirect()->route('instalaciones.index')->with('success', 'Instalación eliminada correctamente.');
    }
}

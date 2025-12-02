<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $planes = Plan::orderBy('nombre')->paginate(10);
        return view('planes.index', compact('planes'));
    }

    public function create()
    {
        return view('planes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_mensual' => 'required|numeric|min:0',
            'velocidad_megas' => 'required|integer|min:1',
            'dispositivos_tv' => 'required|integer|min:0',
            'dispositivos_pc' => 'required|integer|min:0',
            'dispositivos_celular' => 'required|integer|min:0',
            'precio_instalacion' => 'required|numeric|min:0',
            'es_promocion' => 'boolean',
            'precio_promocion_instalacion' => 'nullable|numeric|min:0'
        ]);

        Plan::create($request->all());

        return redirect()->route('planes.index')->with('success', 'Plan creado correctamente.');
    }

    public function edit(Plan $plan)
    {
        return view('planes.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio_mensual' => 'required|numeric|min:0',
            'velocidad_megas' => 'required|integer|min:1',
            'dispositivos_tv' => 'required|integer|min:0',
            'dispositivos_pc' => 'required|integer|min:0',
            'dispositivos_celular' => 'required|integer|min:0',
            'precio_instalacion' => 'required|numeric|min:0',
            'es_promocion' => 'boolean',
            'precio_promocion_instalacion' => 'nullable|numeric|min:0'
        ]);

        $plan->update($request->all());

        return redirect()->route('planes.index')->with('success', 'Plan actualizado correctamente.');
    }
}

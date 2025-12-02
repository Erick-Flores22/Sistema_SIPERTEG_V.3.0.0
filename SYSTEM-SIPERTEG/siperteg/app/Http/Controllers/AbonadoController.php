<?php

namespace App\Http\Controllers;

use App\Models\Abonado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class AbonadoController extends Controller
{
   

    /**
     * Display a listing of abonados, with optional search and state filter.
     */
    public function index(Request $request)
    {
        $query = Abonado::query();

        if ($request->filled('search')) {
            $term = $request->search;
            $query->where(function($q) use ($term) {
                $q->where('nombre',   'like', "%{$term}%")
                  ->orWhere('apellido','like', "%{$term}%")
                  ->orWhere('ci',      'like', "%{$term}%");
            });
        }

        if (in_array($request->estado, ['activo', 'inactivo'])) {
            $query->where('estado', $request->estado);
        }

        $abonados = $query
            ->orderBy('id', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('abonados.index', compact('abonados'));
    }

    /**
     * Show the form for creating a new abonado.
     */
    public function create()
    {
        return view('abonados.create');
    }

    /**
     * Store a newly created abonado in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'ci'           => 'required|string|max:255|unique:abonados,ci',
            'telefono1'    => 'required|string|max:255',
            'telefono2'    => 'nullable|string|max:255',
            'zona'         => 'required|string|max:255',
            'calle'        => 'required|string|max:255',
            'numero_casa'  => 'required|string|max:255',
            'fecha_corte'  => 'nullable|date',
            'estado'       => 'nullable|in:activo,inactivo',
        ]);

        Abonado::create($data);

        return redirect()
            ->route('abonados.index')
            ->with('success', 'Abonado creado correctamente.');
    }

    /**
     * Show the form for editing the specified abonado.
     */
    public function edit(Abonado $abonado)
    {
        return view('abonados.edit', compact('abonado'));
    }

    /**
     * Update the specified abonado in storage.
     */
    public function update(Request $request, Abonado $abonado)
    {
        $data = $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'ci'           => "required|string|max:255|unique:abonados,ci,{$abonado->id}",
            'telefono1'    => 'required|string|max:255',
            'telefono2'    => 'nullable|string|max:255',
            'zona'         => 'required|string|max:255',
            'calle'        => 'required|string|max:255',
            'numero_casa'  => 'required|string|max:255',
            'fecha_corte'  => 'nullable|date',
            'estado'       => 'nullable|in:activo,inactivo',
        ]);

        $abonado->update($data);

        return redirect()
            ->route('abonados.index')
            ->with('success', 'Abonado actualizado correctamente.');
    }

    /**
     * Remove the specified abonado from storage.
     */
    public function destroy(Abonado $abonado)
    {
        $abonado->delete();

        return redirect()
            ->route('abonados.index')
            ->with('success', 'Abonado eliminado correctamente.');
    }

    /**
     * Display the historial tabs view for the specified abonado.
     */
    public function historial(Abonado $abonado)
    {
        $abonado->load(['datosTecnico','cobros','fallas']);
        return view('abonados.historial', compact('abonado'));
    }

    /**
     * Generate and download the historial PDF for the specified abonado.
     */
    public function historialPdf(Abonado $abonado)
    {
        $abonado->load(['datosTecnico','cobros','fallas']);

        // Usa el wrapper de dompdf registrado en el contenedor
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('abonados.historial_pdf', compact('abonado'));

        return $pdf->download("historial_{$abonado->id}.pdf");
    }
    public function search(Request $request)
{
    $term = $request->get('term', '');
    $abonados = Abonado::where('nombre', 'LIKE', "%$term%")
        ->orWhere('apellido', 'LIKE', "%$term%")
        ->orWhere('ci', 'LIKE', "%$term%")
        ->limit(20)
        ->get();

    return response()->json($abonados);
}
public function buscar(Request $request)
{
    $term = $request->get('q', '');

    $abonados = Abonado::where('nombre','like',"%$term%")
        ->orWhere('apellido','like',"%$term%")
        ->orWhere('ci','like',"%$term%")
        ->limit(20)
        ->get();

    return response()->json(
        $abonados->map(fn($a) => [
            'id'   => $a->id,
            'text' => "{$a->nombre} {$a->apellido} (CI: {$a->ci})"
        ])
    );
}


}

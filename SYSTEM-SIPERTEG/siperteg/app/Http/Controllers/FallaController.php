<?php

namespace App\Http\Controllers;

use App\Models\Falla;
use App\Models\Abonado;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class FallaController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /** Listado paginado de fallas con su abonado */
   public function index(Request $request)
{
    $query = Falla::with('abonado');

    if ($estado = $request->input('estado')) {
        $query->where('estado', $estado);
    }

    $fallas = $query->orderBy('id', 'desc')
                    ->paginate(10)
                    ->withQueryString();

    return view('fallas.index', compact('fallas'));
}


    /** Formulario para crear una nueva falla */
    public function create()
    {
        $abonados = Abonado::orderBy('nombre')->get();
        return view('fallas.create', compact('abonados'));
    }

    /** Almacena la nueva falla */
    public function store(Request $request)
    {
        $data = $request->validate([
            'abonado_id' => 'required|exists:abonados,id',
            'tipo_falla' => 'required|in:material,caja',
            'detalle'    => 'nullable|string|max:255',
            'estado'     => 'required|in:pendiente,resuelta',
        ]);

        Falla::create($data);

        return redirect()
            ->route('fallas.index')
            ->with('success','Falla registrada correctamente.');
    }

    /** Formulario de edición de una falla */
    public function edit(Falla $falla)
    {
        $abonados = Abonado::orderBy('nombre')->get();
        return view('fallas.edit', compact('falla','abonados'));
    }

    /** Actualiza los datos de la falla */
    public function update(Request $request, Falla $falla)
    {
        $data = $request->validate([
            'abonado_id' => 'required|exists:abonados,id',
            'tipo_falla' => 'required|in:material,caja',
            'detalle'    => 'nullable|string|max:255',
            'estado'     => 'required|in:pendiente,resuelta',
        ]);

        $falla->update($data);

        return redirect()
            ->route('fallas.index')
            ->with('success','Falla actualizada correctamente.');
    }

    /** Elimina una falla */
    public function destroy(Falla $falla)
    {
        $falla->delete();

        return redirect()
            ->route('fallas.index')
            ->with('success','Falla eliminada correctamente.');
    }
}

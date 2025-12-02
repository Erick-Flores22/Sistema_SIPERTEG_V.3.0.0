<?php
namespace App\Http\Controllers;

use App\Models\Cobro;
use App\Models\Periodo;
use Illuminate\Http\Request;

class CobroController extends Controller
{
    public function index(Periodo $periodo)
{
    $cobros = $periodo->cobros()->with('abonado')->get();
    return view('cobros.index', compact('periodo','cobros'));
}

public function create(Periodo $periodo)
{
    // ya no enviamos $abonados, se busca vía AJAX
    return view('cobros.create', compact('periodo'));
}

public function store(Request $request, Periodo $periodo)
{
    $request->validate([
        'abonado_id' => 'required|exists:abonados,id',
        'monto' => 'required|numeric|min:0',
        'plataforma' => 'nullable|string|max:255',
    ]);

    Cobro::updateOrCreate(
        ['abonado_id' => $request->abonado_id, 'periodo_id' => $periodo->id],
        [
            'monto' => $request->monto,
            'plataforma' => $request->plataforma,
            'estado_pago' => 'pagado',
            'fecha_pago' => now(),
        ]
    );

    return redirect()->route('cobros.index', $periodo)->with('success','Pago registrado');
}

}

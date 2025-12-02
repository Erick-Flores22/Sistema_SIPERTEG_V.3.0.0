<?php

namespace App\Http\Controllers;

use App\Models\Gestion;
use Carbon\Carbon;

class PeriodoController extends Controller
{
    public function index(Gestion $gestion)
    {
        $periodos = $gestion->periodos()->withCount([
            'cobros as pagados' => fn($q) => $q->where('estado_pago', 'pagado'),
            'cobros as pendientes' => fn($q) => $q->where('estado_pago', 'pendiente'),
        ])->get();

        // ✅ Establecemos el idioma en español
        Carbon::setLocale('es');

        // ✅ Agregamos el nombre del mes traducido a cada periodo
        foreach ($periodos as $p) {
            // Si tu modelo Periodo tiene un campo "mes" con número (1-12)
            if (is_numeric($p->mes)) {
                $p->mes_nombre = Carbon::createFromDate(null, $p->mes, 1)->translatedFormat('F');
            }
            // Si tu campo "mes" es una fecha tipo "2025-01-01"
            else {
                $p->mes_nombre = Carbon::parse($p->mes)->translatedFormat('F');
            }
        }

        return view('periodos.index', compact('gestion', 'periodos'));
    }
}

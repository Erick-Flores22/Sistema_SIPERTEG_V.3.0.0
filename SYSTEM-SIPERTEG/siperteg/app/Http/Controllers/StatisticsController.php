<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function index()
    {
        // =======================
        //  ABONADOS (ejemplo simple: activos vs inactivos)
        // =======================
        $abonadosData = DB::table('abonados')
            ->selectRaw("estado, COUNT(*) as total")
            ->groupBy('estado')
            ->pluck('total');
        $abonadosLabels = DB::table('abonados')
            ->selectRaw("estado")
            ->groupBy('estado')
            ->pluck('estado');

        // =======================
        //  COBROS agrupados por GESTION y PERIODO (NUMERO de cobros)
        // =======================
        $cobrosPorMes = DB::table('cobros')
            ->join('periodos', 'cobros.periodo_id', '=', 'periodos.id')
            ->join('gestiones', 'periodos.gestion_id', '=', 'gestiones.id')
            ->selectRaw('gestiones.anio, periodos.mes, COUNT(cobros.id) as total')
            ->groupBy('gestiones.anio','periodos.mes')
            ->orderBy('gestiones.anio')
            ->orderBy('periodos.mes')
            ->get();

        $cobrosLabels = $cobrosPorMes->map(fn($r) => $r->anio . '-' . str_pad($r->mes,2,'0',STR_PAD_LEFT));
        $cobrosData   = $cobrosPorMes->map(fn($r) => $r->total);

        // =======================
        //  FALLAS (pendientes vs resueltas)
        // =======================
        $fallasData = DB::table('fallas')
            ->selectRaw("estado, COUNT(*) as total")
            ->groupBy('estado')
            ->pluck('total');
        $fallasLabels = DB::table('fallas')
            ->selectRaw("estado")
            ->groupBy('estado')
            ->pluck('estado');

        // =======================
        //  INSTALACIONES (ejemplo: activas vs suspendidas)
        // =======================
        $instData = DB::table('instalaciones')
            ->selectRaw("estado, COUNT(*) as total")
            ->groupBy('estado')
            ->pluck('total');
        $instLabels = DB::table('instalaciones')
            ->selectRaw("estado")
            ->groupBy('estado')
            ->pluck('estado');

        // =======================
//  DEFECTOS agrupados por estado
// =======================
$defData = DB::table('defectos')
    ->selectRaw("estado, COUNT(*) as total")
    ->groupBy('estado')
    ->pluck('total');

$defLabels = DB::table('defectos')
    ->selectRaw("estado")
    ->groupBy('estado')
    ->pluck('estado');


        return view('estadisticas.index', [
            'abonadosLabels' => $abonadosLabels,
            'abonadosData'   => $abonadosData,

            'cobrosLabels'   => $cobrosLabels,
            'cobrosData'     => $cobrosData,

            'fallasLabels'   => $fallasLabels,
            'fallasData'     => $fallasData,

            'instLabels'     => $instLabels,
            'instData'       => $instData,

            'defLabels'      => $defLabels,
            'defData'        => $defData,
        ]);
    }
}

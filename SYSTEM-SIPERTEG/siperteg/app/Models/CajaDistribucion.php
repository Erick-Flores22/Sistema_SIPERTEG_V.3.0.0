<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CajaDistribucion extends Model
{
    // Forzamos el nombre correcto de la tabla:
    protected $table = 'cajas_distribucion';

    protected $fillable = [
    'nodo_id',
    'nombre',
    'zona',
    'capacidad',
    
    'potencia_partida',
    'potencia_llegada',
    'potencia_distribucion',
    'usuarios_conectados',
    'plano_subtroncal',
    'foto_caja',
    'observaciones',
];

    /**
     * Cada caja pertenece a un nodo.
     */
    public function nodo(): BelongsTo
    {
        return $this->belongsTo(Nodo::class);
    }
}

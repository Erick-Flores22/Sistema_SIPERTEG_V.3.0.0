<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosTecnico extends Model
{
    protected $table = 'datos_tecnicos';

   protected $fillable = [
    'abonado_id',
    'plan_id',
    'odn',
   
    'password',
    'codigo_tecnico',
    'codigo_sistema',
    'fecha_instalacion',
    'observaciones',
    'nodo_id',
    'caja_distribucion_id',
    'potencia_partida',
    'potencia_llegada',
    'foto_plano', // 🔹 nuevo
    
];
protected $casts = [
    'fecha_instalacion' => 'date',
];
    /**
     * Relación con Abonado
     */
    public function abonado()
    {
        return $this->belongsTo(Abonado::class, 'abonado_id');
    }

    /**
     * Relación con Nodo
     */
    public function nodo()
    {
        return $this->belongsTo(Nodo::class, 'nodo_id');
    }

    /**
     * Relación con Caja de Distribución
     */
    public function cajaDistribucion()
    {
        return $this->belongsTo(CajaDistribucion::class, 'caja_distribucion_id');
    }
    public function plan()
{
    return $this->belongsTo(Plan::class);
}

}

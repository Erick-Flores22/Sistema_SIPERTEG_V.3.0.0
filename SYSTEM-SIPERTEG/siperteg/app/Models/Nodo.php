<?php
// app/Models/Nodo.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\CajaDistribucion;
class Nodo extends Model
{
   protected $fillable = [
    'nombre',
    'zona',
    'capacidad',
    'puerto_olt',
    'puerto_edfa',
    'potencia_partida',
    'potencia_llegada',
    'potencia_distribucion',
    'cajas_conectadas',
    'plano_troncal',
    'foto_nodo',
    'observacion',
];


public function cajas()
{
    return $this->hasMany(CajaDistribucion::class, 'nodo_id');
}
}

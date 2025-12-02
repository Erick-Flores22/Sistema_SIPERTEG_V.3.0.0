<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalacion extends Model
{
    use HasFactory;

    protected $table = 'instalaciones';

    protected $fillable = [
        'nombre',
        'celular',
        'direccion',
       
        'estado',
        'observaciones',
    ];

    // Si quieres definir valores posibles del enum:
    public static function estados()
    {
        return [
            'PENDIENTE',
            'EN REVISION',
            'ASIGNADA',
            'RECHAZADA',
            'COMPLETADA',
        ];
    }
}

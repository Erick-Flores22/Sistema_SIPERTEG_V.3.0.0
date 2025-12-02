<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Defecto extends Model
{
    use HasFactory;

    protected $table = 'defectos';

    protected $fillable = [
        'nombre',
        'celular',
        'direccion',
        
        'detalle',
        'estado',
        'observaciones',
    ];

    public static function estados()
    {
        return [
            'PENDIENTE',
            'EN REVISION',
            'ASIGNADA',
            'SOLUCIONADA',
            
        ];
    }
}

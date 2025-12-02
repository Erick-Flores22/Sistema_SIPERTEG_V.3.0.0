<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abonado extends Model
{
    // Si tu tabla no sigue la convención plural, puedes especificarla:
    // protected $table = 'abonados';

    protected $fillable = [
        'nombre',
        'apellido',
        'ci',
        'telefono1',
        'telefono2',
        'zona',
        'calle',
        'numero_casa',
        'fecha_corte',
        'estado',
    ];

    protected $casts = [
        'fecha_corte' => 'date',
    ];
    public function datosTecnico()
    {
        return $this->hasOne(DatosTecnico::class);
    }

   public function cobros()
{
    return $this->hasMany(\App\Models\Cobro::class, 'abonado_id');
}

    public function fallas()
    {
        return $this->hasMany(Falla::class);
    }
}

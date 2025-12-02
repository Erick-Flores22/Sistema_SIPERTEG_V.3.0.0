<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
   protected $table = 'planes'; // <- ¡ESTO SOLUCIONA EL ERROR!

    protected $fillable = [
        'nombre',
        'precio_mensual',
        'velocidad_megas',
        'dispositivos_tv',
        'dispositivos_pc',
        'dispositivos_celular',
        'precio_instalacion',
        'es_promocion',
        'precio_promocion_instalacion',
    ];

    // Costo final de instalación (aplicando promoción si existe)
    public function getCostoInstalacionFinalAttribute()
    {
        return $this->es_promocion && $this->precio_promocion_instalacion !== null
            ? $this->precio_promocion_instalacion
            : $this->precio_instalacion;
    }
    public function datosTecnicos()
{
    return $this->hasMany(DatosTecnico::class);
}

}

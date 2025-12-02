<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $fillable = [
        'abonado_id','periodo_id','monto','plataforma','estado_pago','fecha_pago'
    ];
protected $casts = [
        'fecha_pago' => 'date',   // 👈 convierte automáticamente a Carbon
    ];
    public function abonado()
    {
        return $this->belongsTo(Abonado::class);
    }

    public function periodo()
    {
        return $this->belongsTo(Periodo::class);
    }
    public function gestion()
{
    return $this->belongsTo(Gestion::class);
}

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Abonado;

class Falla extends Model
{
    // La tabla por convención será "fallas"
    protected $fillable = [
        'abonado_id',
        'tipo_falla',
        'detalle',
        'estado',
    ];

    /**
     * Relación: cada falla pertenece a un abonado.
     */
    public function abonado(): BelongsTo
    {
        return $this->belongsTo(Abonado::class);
    }
}

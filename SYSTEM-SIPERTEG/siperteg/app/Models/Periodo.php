<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
    protected $fillable = ['gestion_id','mes'];

    public function gestion()
    {
        return $this->belongsTo(Gestion::class);
    }

    public function cobros()
    {
        return $this->hasMany(Cobro::class);
    }

    public function getMesNombreAttribute()
    {
        return \Carbon\Carbon::create()->month($this->mes)->translatedFormat('F');
    }
}

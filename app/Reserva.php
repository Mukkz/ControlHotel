<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'id', 'inicioReserva', 'fimReserva', 'hotel_id', 'hospede_id', 'quarto_id', 'consumo', 'efetuouReserva', 'status'
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function quarto()
    {
        return $this->belongsTo(Quarto::class);
    }

    public function hospede()
    {
        return $this->belongsTo(Hospede::class);
    }

    public function consumo()
    {
        return $this->hasMany(Consumo::class);
    }
}

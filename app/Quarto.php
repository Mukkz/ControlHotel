<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quarto extends Model
{
    protected $fillable = [
        'id', 'nomeQuarto', 'capacidade', 'status_quarto', 'hotel_id'
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }



    public function getNome($id)
    {
        return $this->nome;
    }
}

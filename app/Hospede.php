<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Hospede extends Model
{

    protected $fillable = [
        'id', 'nome', 'email', 'contato', 'dataNascimento', 'hotel_id'
    ];

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

}

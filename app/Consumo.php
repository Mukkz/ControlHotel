<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Consumo extends Model
{

    protected $fillable = [
        'id', 'item', 'valor', 'quantidade', 'reserva_id', 'hotel_id'
    ];


    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }
    
    
}

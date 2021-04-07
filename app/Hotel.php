<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Hotel extends Model
{
    protected $fillable = ['hotel'];

    public function getId()
    {
        return $this->id;
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function consumos()
    {
        return $this->hasMany(Consumo::class);
    }

    public function hospedes()
    {
        return $this->hasMany(Hospede::class);
    }

    public function quartos()
    {
        return $this->hasMany(Quarto::class);
    }
}

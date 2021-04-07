<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Requests;
use App\Notifications\ResetPassword;

;

use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'nome', 'hotel_id', 'email', 'password', 'telefone', 'quartos', 'admin',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getHotel()
    {
        $lastdata = DB::table('hotels')->where('id', $this->hotel_id)->select('hotel')->first();
        return $lastdata->hotel;
    }

    public function getHotelId()
    {
        $lastdata = DB::table('hotels')->where('id', $this->hotel_id)->select('id')->first();
        return $lastdata->id;
    }



    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }


    public function hotels()
    {
        return $this->belongsTo(Hotel::class);
    }

}

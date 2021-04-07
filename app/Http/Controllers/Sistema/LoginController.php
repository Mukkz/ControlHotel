<?php

namespace App\Http\Controllers\Sistema;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Reserva;
use Carbon\Carbon;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function entrar(Request $req)
    {

        $dados = $req->all();

        if (Auth::attempt(['email' => $dados['email'], 'password' => $dados['senha']])) {

            $hotel_id = auth()->user()->getHotelId();
            $checkin = Reserva::with(['hospede', 'quarto'])
                ->where([['reservas.hotel_id', $hotel_id],
                    ['reservas.status', '=' ,'aberto'],
                    ['reservas.inicioReserva', '=', Carbon::now()]
                ])
                ->get();

            $checkout = Reserva::with(['hospede', 'quarto'])
                ->where([['reservas.hotel_id', $hotel_id],
                    ['reservas.status', '=' ,'Iniciada'],
                    ['reservas.fimReserva', '=', Carbon::now()]
                ])
                ->get();

            return redirect()->route('sistema.home')
                ->with('checkin', $checkin)
                ->with('checkout', $checkout);

        } else {

            return redirect()
                ->route('login')
                ->with('message','Erro ao efetuar Login: Usuário e/ou senha incorreta');
        }
    }

    public function sair()
    {

        Auth::logout();
        return redirect()->route('login');

    }
}
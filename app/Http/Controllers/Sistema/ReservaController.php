<?php

namespace App\Http\Controllers\Sistema;

use Input;
use App\Hotel;
use App\Consumo;
use App\Reserva;
use App\Quarto;
use App\Hospede;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReservaController extends Controller
{

    public function mainReserva()
    {
        $hotel_id = auth()->user()->getHotelId();
        $reservas = Reserva::with(['hospede', 'quarto'])
            ->where('reservas.hotel_id', $hotel_id)
            ->where('reservas.status', 'aberto')
            ->orWhere('reservas.status', 'Iniciada')
            ->where('reservas.hotel_id', $hotel_id)
            ->paginate(20);
        $reservasAlteradas = Reserva::with(['hospede', 'quarto'])
            ->where('reservas.hotel_id', $hotel_id)
            ->where('reservas.status', '<>', 'aberto')
            ->Where('reservas.status', '<>', 'Iniciada')
            ->paginate(20);

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

        return view('sistema.reserva.mainReserva', ['reservas' => $reservas,
            'reservasAlteradas' => $reservasAlteradas, 'checkin'=>$checkin, 'checkout'=>$checkout]);
    }

    public function pesquisaReserva(Request $req)
    {
        $search = $req->get('valorPesquisadoReserva');
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


        $reservasAlteradas = Reserva::with(['hospede', 'quarto'])
            ->where('reservas.hotel_id', $hotel_id)
            ->where('reservas.status', '<>', 'aberto')
            ->paginate(20);


        $mensagens = [
            'valorPesquisadoReserva.date_format' => "Favor preencher o campo com a data corretamente, exemplo: 22/11/2018"
        ];


        $this->validate($req,
            [
                'valorPesquisadoReserva' => 'date_format:d/m/Y'

            ], $mensagens);


        if($search){
            $reservas = Reserva::with(['hospede', 'quarto'])
            ->where('reservas.hotel_id', $hotel_id)
            ->where('reservas.status', 'aberto')
            ->where('inicioReserva', '=', '%' . \DateTime::createFromFormat('d/m/Y', $search)->format('Y-m-d'). '%')
            ->orderBy('inicioReserva')
            ->paginate(20);
        } else{
            $reservas = Reserva::with(['hospede', 'quarto'])
                ->where('reservas.hotel_id', $hotel_id)
                ->where('reservas.status', 'aberto')
                ->paginate(20);
            return view('sistema.reserva.mainReserva', ['reservas' => $reservas, 'reservasAlteradas' => $reservasAlteradas,
                'checkin'=>$checkin, 'checkout'=>$checkout]);
        }
        return view('sistema.reserva.mainReserva', ['reservas' => $reservas, 'reservasAlteradas' => $reservasAlteradas,
            'checkout'=>$checkout, 'checkin'=>$checkin]);
    }

    public function pesquisaReservaAlterada(Request $req)
    {
        $hotel_id = auth()->user()->getHotelId();
        $search = $req->get('valorPesquisadoReservaAlterada');
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
        $reservas = Reserva::with(['hospede', 'quarto'])
            ->where('reservas.hotel_id', $hotel_id)
            ->where('reservas.status', 'aberto')
            ->paginate(20);


        $mensagens = [
            'valorPesquisadoReservaAlterada.date_format' => "Favor preencher o campo com a data corretamente, exemplo: 22/11/2018"
        ];


        $this->validate($req,
            [
                'valorPesquisadoReservaAlterada' => 'date_format:d/m/Y'

            ], $mensagens);

        if($search){
             $reservasAlteradas = Reserva::with(['hospede', 'quarto'])
            ->where('reservas.hotel_id', $hotel_id)
            ->where('reservas.status', '<>', 'aberto')
            ->where('inicioReserva', '=', '%' . \DateTime::createFromFormat('d/m/Y', $search)->format('Y-m-d'). '%')
            ->orderBy('inicioReserva')
            ->paginate(20);
            return view('sistema.reserva.mainReserva', ['reservas' => $reservas, 'reservasAlteradas' => $reservasAlteradas,
                'checkin'=>$checkin, 'checkout'=>$checkout]);
        }else{
            $reservasAlteradas = Reserva::with(['hospede', 'quarto'])
                ->where('reservas.hotel_id', $hotel_id)
                ->where('reservas.status', '<>', 'aberto')
                ->paginate(20);

            return view('sistema.reserva.mainReserva', ['reservas' => $reservas, 'reservasAlteradas' => $reservasAlteradas,
                'checkin'=>$checkin, 'checkout'=>$checkout]);
        }

    }

    public function mainNovaReserva()
    {
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

        return view('sistema.reserva.cadastraReserva', ['checkin'=>$checkin, 'checkout'=>$checkout]);
    }

    public function checkReserva(Request $req)
    {
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

        $t1 = Hotel::with(['quartos.reservas', 'hospedes'])
            ->where('id', $hotel_id)
            ->first();

        $hospedes = DB::table('hospedes')
            ->where('hotel_id', '=', $hotel_id)
            ->get();

        if ($t1) {
            $inicioReserva = $req->inicioReserva;
            $fimReserva = $req->fimReserva;
            $capacidade = $req->capacidade;

            if ($inicioReserva < Carbon::now()->toDateString()) {
                return view('sistema.reserva.cadastraReserva',
                    ['inicioReserva' => $inicioReserva, 'fimReserva' => $fimReserva,
                        'mensagem' => 'Favor verificar a data de início da reserva',
                        'checkin'=>$checkin, 'checkout'=>$checkout]);
            } else if ($fimReserva <= $inicioReserva) {
                return view('sistema.reserva.cadastraReserva',
                    ['inicioReserva' => $inicioReserva, 'fimReserva' => $fimReserva,
                        'mensagem' => 'Favor verificar a data final da reserva',
                        'checkin'=>$checkin, 'checkout'=>$checkout]);
            }
            foreach ($t1->quartos as $k => $quarto) {

                if ($quarto->capacidade != $capacidade) {
                    $t1->quartos->forget($k);
                }

                if ($quarto->status_quarto != 'Ativo') {
                    $t1->quartos->forget($k);
                }

                foreach ($quarto->reservas as $reserva)
                {
                    if ($inicioReserva == $reserva->fimReserva && $reserva->status == 'aberto')
                    {
                        $t1->quartos->forget($k);
                    }else if(($inicioReserva >= $reserva->inicioReserva && $fimReserva >= $reserva->fimReserva)&&
                        ($reserva->status == 'Cancelado' || $reserva->status == 'Fechada')
                        ||
                        ($inicioReserva >= $reserva->inicioReserva && $fimReserva <= $reserva->fimReserva) &&
                        ($reserva->status == 'Cancelado' || $reserva->status == 'Fechada'))
                    {

                    }
                    else if ($inicioReserva >= $reserva->inicioReserva && $inicioReserva < $reserva->fimReserva)
                    {
                        $t1->quartos->forget($k);
                    }
                    elseif ($fimReserva >= $reserva->inicioReserva && $fimReserva <= $reserva->fimReserva)
                    {
                        $t1->quartos->forget($k);
                    }
                    elseif ($inicioReserva <= $reserva->inicioReserva && $fimReserva >= $reserva->fimReserva)
                    {
                        $t1->quartos->forget($k);
                    }
                }
            }
            return view('sistema.reserva.cadastraReserva',
                ['hotel' => $t1, 'inicioReserva' => $inicioReserva, 'fimReserva' => $fimReserva,
                    'checkin'=>$checkin, 'checkout'=>$checkout, 'hospedes' => $hospedes]);
        }
    }

    public function realizaReserva(Request $req)
    {
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

        $teste2 = $req->input('hospedeId');

        if($teste2 <= 0){

            return redirect()->route('core.nova.reserva')
                ->with('message_erro', 'deu ruim.')
                ->with('checkin', $checkin)
                ->with('checkout', $checkout);

        }
            else{
            $reserva = new Reserva;
            $reserva->inicioReserva = Carbon::parse($req->input('inicioReserva'));
            $reserva->fimReserva = Carbon::parse($req->input('fimReserva'));
            $reserva->hotel_id = $req->input('hotel_id');
            $reserva->hospede_id = $req->input('hospedeId');
            $reserva->quarto_id = $req->input('quarto_id');
            $reserva->valorDiaria = $req->input('valorDiaria');
            $reserva->efetuouReserva = $req->input('efetuouReserva');
            $reserva->save();

            $diasReservados = Carbon::parse($req->input('fimReserva'))
            ->diffInDays(Carbon::parse($req->input('inicioReserva')));
            // dd($diasReservados);
            // die();

            $contador = $diasReservados;
            for($contador; $contador > 0 ; $contador--)
            {
                $consumo = new Consumo;
                $consumo->hotel_id = $req->input('hotel_id');
                $consumo->item = "Diária";
                $consumo->valor = $req->input('valorDiaria');
                $consumo->quantidade = 1;
                $consumo->reserva_id = Reserva::all()->last()->id;
                $consumo->save();
            }


            return redirect()->route('core.reserva')
                ->with('message', 'Reserva efetuada com sucesso.')
                ->with('checkin', $checkin)
                ->with('checkout', $checkout);
        }

    }

    public function cancelarReserva($id)
    {
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

        $reserva = Reserva::find($id);
        $reserva->status = 'Cancelado';
        $reserva->save();

        return redirect()
            ->route('core.reserva')
            ->with('message_cancelado', 'Reserva cancelada com sucesso')
            ->with('checkin', $checkin)
            ->with('checkout', $checkout);

    }

    public function iniciarReserva($id){
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

        $reserva = Reserva::find($id);
        $reserva->status="Iniciada";
        $reserva->save();

        return redirect()
            ->route('sistema.home')
            ->with('checkin', $checkin)
            ->with('checkout', $checkout);

    }
    public function fecharReserva($id){
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

        $reserva = Reserva::find($id);
        $reserva->status="Fechada";
        $reserva->save();

        return redirect()->route('sistema.home')
        ->with('checkin', $checkin)
        ->with('checkout', $checkout);;

    }
}



<?php

namespace App\Http\Controllers\Sistema;

    use App\Hospede;
    use App\Reserva;
    use Carbon\Carbon;
    use Illuminate\Http\Request;
    use App\Http\Controllers\Controller;
    use Illuminate\Support\Facades\DB;

class HospedeController extends Controller
{
    public function mainHospede()
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

        $hospedes = DB::table('hospedes')
            ->where('hotel_id', '=', $hotel_id)
            ->orderBy('nome')
            ->paginate(10);

        return view('sistema.hospede.mainHospede', ['hospedes' => $hospedes, 'checkin'=>$checkin,
            'checkout'=>$checkout]);
    }

    public function pesquisaHospede(Request $req)
    {
        $hotel_id = auth()->user()->getHotelId();
        $search = $req->get('valorPesquisado');
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

        $hospedes = DB::table('hospedes')
            ->where('nome', 'ilike', '%' . $search . '%')
            ->where('hotel_id', '=', $hotel_id)
            ->orderBy('nome')
            ->paginate(10);
        return view('sistema.hospede.mainHospede', ['hospedes' => $hospedes, 'checkin'=>$checkin,
            'checkout'=>$checkout]);
    }

    public function cadastrarHospede()
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

        return view('sistema.hospede.cadastraHospede', ['Menu' => 'Hospede', 'checkin'=>$checkin,
            'checkout'=>$checkout]);
    }

    public function salvarHospede(Request $req)
    {
        $mensagens = [
            'nome.min' => "O nome deve conter pelo menos 3 caracteres",
            'nome.max' => "O nome deve conter no máximo 200 caracteres",
            'nome.required' => "Favor preencher o campo nome corretamente",
            'email.email' => "O email deve ser preenchido corretamente",
            'contato.required' => "Favor preencher o campo de contato",
            'dataNascimento.required' => "Favor preencher o campo de data nascimento!",
            'dataNascimento.date_format' => "Favor preencher o campo de data de nascimento de maneira correta (Dia-Mês-Ano)"
        ];

        $this->validate($req,
            [
                'nome' => 'required|min:3|max:200',
                'email' => 'email',
                'contato' => 'required',
                'dataNascimento' => 'required|date_format:Y-m-d'

            ], $mensagens);

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


        $dados = $req->all();
        Hospede::create($dados);

        return redirect()->route('sistema.main.hospedes')
            ->with('message', 'Hóspede cadastrado com sucesso.')
            ->with('checkin', $checkin)
            ->with('checkout', $checkout);

    }

    public function editarHospede($id)
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

        $registro = Hospede::find($id);

        return view('sistema.hospede.editaHospede', compact('registro'), ['checkin'=>$checkin,
            'checkout'=>$checkout]);

    }

    public function atualizarHospede(Request $req, $id)
    {
        $mensagens = [
            'nome.min' => "O nome deve conter pelo menos 3 caracteres",
            'nome.max' => "O nome deve conter no máximo 200 caracteres",
            'nome.required' => "Favor preencher o campo nome corretamente",
            'cidade.min' => "A cidade deve conter pelo menos 3 caracteres",
            'cidade.max' => "A cidade deve conter no máximo 200 caracteres",
            'cidade.required' => "Favor preencher o campo cidade corretamente",
            'email.email' => "O email deve ser preenchido corretamente",
            'email.required' => "Favor preencher o campo de email",
            'contato.required' => "O campo telefone, deve ser preenchido",
            'documento.required' => "Favor preencher o campo documento",
            'documento.numeric' => "Favor preencher o campo documento, somente com números",
            'documento.digits_between' => "O campo documento deve conter entre 11 e 15 dígitos",
            'dataNascimento.required' => "Favor preencher o campo de data nascimento!",
            'dataNascimento.date_format' => "Favor preencher o campo de data de nascimento de maneira correta (Dia-Mês-Ano)"
        ];

        $this->validate($req,
            [
                'nome' => 'required|min:3|max:200',
                'email' => 'required|email',
                'contato' => 'required',
                'dataNascimento' => 'required'

            ], $mensagens);

        $dados = $req->all();
        Hospede::find($id)->update($dados);
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

        return redirect()->route('sistema.main.hospedes')
            ->with('message1', 'Hóspede atualizado com sucesso.')
            ->with('checkin', $checkin)
            ->with('checkout', $checkout);

    }


}

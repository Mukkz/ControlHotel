<?php
/**
 * Created by PhpStorm.
 * User: mukkz
 * Date: 03/10/18
 * Time: 22:25
 */

namespace App\Http\Controllers\Sistema;

use App\User;
use App\Reserva;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class PerfilController extends Controller
{

    public function index()
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

        return view('sistema.profile.mainProfile',['checkin'=>$checkin, 'checkout'=>$checkout]);
    }

    public function listar()
    {
        $hotel_id = auth()->user()->getHotelId();
        $atendentes = DB::table('users')
            ->where('hotel_id', '=', $hotel_id)
            ->where('admin', '=', 'não')
            ->orderBy('nome')
            ->paginate(10);;

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


        return view('sistema.profile.profile_lista', ['atendentes'=> $atendentes, 'checkin'=>$checkin,
            'checkout'=>$checkout]);

    }

    public function deletar($id)
    {
        $usuario= User::find($id);
        $usuario->delete();
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

        return redirect()
            ->route('sistema.main.lista.perfil')
            ->with('message_delete', 'Usuário excluído com sucesso')
            ->with('checkin', $checkin)
            ->with('checkout'. $checkout);
    }

    public function cadastrar()
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

        return view('sistema.profile.cadastraAtendente', ['checkin'=> $checkin, 'checkout'=> $checkout]);
    }

    public function registrar(Request $req)
    {
        $mensagens = [
            'nome.min' => "O nome deve conter pelo menos 3 caracteres",
            'nome.max' => "O nome deve conter no máximo 200 caracteres",
            'password.min' => "A senha deve conter no minimo 6 caracteres",
            'password.required' => "Favor inserir uma senha",
            'telefone.required' => "O campo telefone, deve ser preenchido",
            'email.unique' => "Este e-mail já foi utilizado"
        ];

        $this->validate($req,
            [
                'nome' => 'required|min:3|max:200',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|max:25',
                'telefone' => 'required'

            ], $mensagens);

        $d = $req->all();

        $dados = [
            'nome' => $d['nome'],
            'email' => $d['email'],
            'hotel_id' => $d['hotel_id'],
            'password' => bcrypt($d['password']),
            'telefone' => $d['telefone'],
            'quartos' => $d['quartos'],
            'admin' => $d['admin'],
        ];


        User::create($dados);

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


        return redirect()
            ->route('sistema.main.lista.perfil')
            ->with('message_ok', 'Atendente cadastrado com sucesso')
            ->with('checkin', $checkin)
            ->with('checkout'. $checkout);

    }

    public function alteraSenha(Request $request)
    {

        $request->user()->fill([
            'password' => Hash::make($request->newPassword)
        ])->save();

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

        return redirect()->route('sistema.main.perfil')
            ->with('message_ok', 'Senha alterada com sucesso.')
            ->with('checkin'. $checkin)
            ->with('checkout'. $checkout);
    }

    public function indexAlterarSenha()
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

        return view('sistema.profile.alteraSenha', ['checkin'=>$checkin, 'checkout'=>$checkout]);
    }
}
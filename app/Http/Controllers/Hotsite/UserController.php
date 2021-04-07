<?php

namespace App\Http\Controllers\Hotsite;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\Hotel;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function registrar(Request $req)
    {
        $mensagens = [
            'nome.min' => "O nome deve conter pelo menos 3 caracteres",
            'nome.max' => "O nome deve conter no máximo 200 caracteres",
            'hotel.min' => "O Hotel deve conter pelo menos 3 caracteres",
            'hotel.max' => "O Hotel deve conter pelo menos 200 caracteres",
            'password.min' => "A senha deve conter no minimo 6 caracteres",
            'password.required' => "Favor preencher a senha",
            'telefone.required' => "O campo telefone, deve ser preenchido",
            'email.unique' => "Este e-mail já foi utilizado"
        ];

        $this->validate($req,
            [

                'nome' => 'required|min:3|max:200',
                'hotel' => 'required|min:3|max:200',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:5|max:25',
                'telefone' => 'required'

            ], $mensagens);

        $d = $req->all();


        $dados2 = [
            'hotel' => $d['hotel']
        ];

        Hotel::create($dados2);

        $lastdata = DB::table('hotels')->select('id')->latest()->first();
//        var_dump($lastdata->id);die();
        $dados = [
            'nome' => $d['nome'],
            'email' => $d['email'],
            'hotel_id' => $lastdata->id,
            'password' => bcrypt($d['password']),
            'telefone' => $d['telefone'],
            'quartos' => $d['quartos'],
            'admin' => $d['admin'],
        ];


        User::create($dados);

        return redirect()
            ->route('login')
            ->with('message_ok', 'Login cadastrado com sucesso');

    }

}

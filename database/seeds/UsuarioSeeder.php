<?php

use App\Quarto;
use Illuminate\Database\Seeder;
use App\User;
use App\Hotel;
use App\Hospede;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados =[
            'nome' => "Samuel",
            'email'=> "teste@teste.com",
            'hotel_id'=> "1",
            'password' => bcrypt("teste123"),
            'telefone'=> "47999999999",
            'quartos' => "0",
            'admin' => "sim",

        ];

        $dados2 =[
            'hotel'=>'Hotel Penha',
        ];

        $dados3=[
            'nomeQuarto' => 'Quarto 101',
            'capacidade' => 'Duplo',
            'hotel_id' => "1",
            'status_quarto' => 'Ativo',
        ];

        $dados4=[
          'nome' => 'Tester',
          'email' => 'teste1@teste1.com',
          'contato'  => '47999999999',
          'dataNascimento'  => '03/11/1993',
          'hotel_id'  => '1'
        ];

        if(User::where('email', '=', $dados['email']) -> count()){

            $usuario = User::where('email', '=', $dados['email'])->first();
            $usuario-> update($dados);
            echo "Usuario alterado!";

        }else{

            Hotel::create($dados2);
            User::create($dados);
            Quarto::create($dados3);
            Hospede::create($dados4);

            echo "Hotel, usuário e quarto criado!";

        }
    }
}

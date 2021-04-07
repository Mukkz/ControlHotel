@extends('hotsite.padrao.head')

@section('titulo', 'Cadastro')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

<body>

@include('hotsite.padrao.header')

<div class="limiter"><br>
    <div class="container-login100" style="background-image: url('{{'../assets/images/bg-02.jpg'}}');">
    <div class="wrap-login100 p-t-30 p-b-50" style="text-align:center">
        <div style="background-color:white; border-radius: 10px;">
            <span style="font-size:25px;">
                CADASTRO
            </span>
        </div>
        <div style="background:white; padding:40px; padding-right:60px; padding-left:60px;margin:10px; border-radius: 10px;">
            <form method="post" action="{{route('hotsite.cadastro.registrar')}}">
              {{csrf_field()}}
                <div class="form-group">
                    <label for="nomeDoAdministrador">Nome do Administrador</label>
                    <input style="text-align:center" required type="text" class="form-control" id="nomeDoAdministrador" name="nome" value="{{old('nome')}}">
                </div>
                <div class="form-group">
                    <label for="nomeDoHotel">Nome do Hotel</label>
                    <input style="text-align:center" required type="text" class="form-control" id="nomeDoHotel" name="hotel" value="{{old('hotel')}}">
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input required style="text-align:center" type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input required type="password" style="text-align:center" class="form-control" id="senha" name="password" placeholder="*******">
                </div>
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input required style="text-align:center" type="text" class="form-control" id="telefone" name="telefone" 
                    value="{{old('telefone')}}">
                </div>
                <input type="hidden" name="quartos" value="0">
                <input type="hidden" name="admin" value="sim">

                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </form>
        </div>
        </div>
        @if(count($errors) != 0)
            <div id="erro" class="alerta" style="text-align: center; 
            position: fixed; top: 20%; left: 5%; width: 25%">
                <ul class="list-group">
                    @foreach($errors->all() as $erro)
                        <li class="list-group-item list-group-item-danger" >{{$erro}}</li><br>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
</div>



<script>

$(document).ready(function() {
	setTimeout(function () {
		$('.alerta').fadeOut('slow');
    }, 5000);});

    $(document).ready(function($){
        $("#telefone").mask("(99) 9 9999-9999");
    });

</script>
@include('hotsite.padrao.footer')

</body>

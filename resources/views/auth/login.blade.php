@extends('hotsite.padrao.head')
@section('titulo', 'Login')
<body>
@include('hotsite.padrao.header')
<div class="limiter">
    <div class="container-login100" style="background-image: url('{{'../assets/images/bg-02.jpg'}}');">
    <div class="wrap-login100 p-t-30 p-b-50" style="text-align:center">
        @if(Session::has('message'))
            <div class="alert alert-danger" style="text-align: center">
                {{ Session::get('message') }}
            </div>
        @elseif(Session::has('message_ok'))
            <div class="alert alert-success" style="text-align: center">
                {{ Session::get('message_ok') }}
            </div>
        @endif
        <div style="background-color:white; border-radius: 10px;">
            <span style="font-size:25px;">
                ENTRAR
            </span>
        </div>

        <div style="background:white; padding-top:30px;padding-bottom:10px; padding-right:70px; padding-left:70px;margin:10px; border-radius: 10px;">
            <form method="post" action="{{route('sistema.login.entrar')}}">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required style="text-align:center" type="text" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input required type="password" style="text-align:center" class="form-control" id="senha" name="senha">
                    </div>

                    <button type="submit" class="btn btn-primary">Entrar</button>
                    <a href="{{url('cadastro')}}" class="btn btn-secondary">Registrar</a>
                    </form>
                    <a href="{{route('password.request')}}" class="btn" style="font-family: Ubuntu-Regular, sans-serif;">
                        {{ __('Esqueceu sua senha?')}}
                    </a>
            </div>
        </div>
    </div>
</div>

@include('hotsite.padrao.footer')

</body>


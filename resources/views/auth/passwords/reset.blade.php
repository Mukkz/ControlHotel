@extends('hotsite.padrao.head')
@section('titulo', 'Resetar senha')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
@include('hotsite.padrao.header')
<div class="limiter" style=" background-image: url('{{'../../assets/images/bg-02.jpg'}}');"><br>
    <div class="container-login100">
        <div class="wrap-login100 p-t-30 p-b-50">
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    <strong>
                        <center>{{ $errors->first('email') }}</center>
                    </strong>
                </div>
            @endif
            @if ($errors->has('password'))
                <div class="alert alert-danger" role="alert">
                    <strong>
                        <center>{{ $errors->first('password') }}</center>
                    </strong>
                </div>
            @endif

            <span class="login100-form-title p-b-41" style="font-family: Ubuntu-Bold, sans-serif;">
                Recupere sua conta
            </span>

            <div style="text-align:center;background:white; padding-top:30px;padding-bottom:10px; padding-right:70px; padding-left:70px;margin:10px; border-radius: 10px;">
            <form method="post" action="{{ route('password.request') }}">
                {{csrf_field()}}
                <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required style="text-align:center" type="email" class="form-control" 
                        id="email" name="email" value="{{old('email')}}" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input required type="password" style="text-align:center" class="form-control"
                         id="senha" name="password">
                    </div>
                    <div class="form-group">
                        <label for="senha">Confirmar senha</label>
                        <input required type="password" style="text-align:center" class="form-control"
                         id="senha" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Resetar senha</button>
                    </form>
            </div>
        </div>
        </div>
    </div>
</div>


@include('hotsite.padrao.footer')

</body>

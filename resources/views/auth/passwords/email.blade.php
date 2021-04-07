@extends('hotsite.padrao.head')
@section('titulo', 'Cadastro')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
@include('hotsite.padrao.header')

<div class="limiter"><br>
    <div class="container-login100" style="background-image: url('{{'../assets/images/bg-02.jpg'}}');">
        <div class="wrap-login100 p-t-30 p-b-50">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    <strong>
                        <center>
                            {{ session('status') }}
                        </center>
                    </strong>
                </div>
            @endif
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    <strong>
                        <center>{{ $errors->first('email') }}</center>
                    </strong>
                </div>
            @endif

            <div style="background-color:white; border-radius: 10px; text-align:center">
            <span style="font-size:25px;">
                RECUPERAR SENHA
            </span>
        </div>

        <div style="text-align:center;background:white; padding-top:30px;padding-bottom:10px; padding-right:70px; padding-left:70px;margin:10px; border-radius: 10px;">
            <form method="post" action="{{ route('password.email') }}">
                {{csrf_field()}}
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input required style="text-align:center" type="email" class="form-control" 
                        id="email" name="email" value="{{old('email')}}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Enviar e-mail de recuperação</button>
                    </form>
            </div>
        </div>
    </div>
</div>


@include('hotsite.padrao.footer')

</body>

@extends('sistema.padraoSistema.head')
@section('titulo', 'Profile')
@section('content')
    <section class="content-header">
        <div>
            <h1>
                Perfil
            </h1>
        </div>
        @if(count($errors) != 0)
            @foreach($errors->all() as $erro)
                <div class="teste alert alert-danger alert-dismissible" role="alert"
                     style="text-align: center; position: absolute; top: 37%; left: 15%; width: 84%">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p>{{$erro}}</p>
                </div>
            @endforeach
        @endif
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Alterar senha</h3>
            </div>
            <form method="POST" role="form">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" class="form-control" name="newPassword" placeholder="************" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">Confirmar senha</label>
                        <input type="password" class="form-control" name="password-confirmation"
                               placeholder="************" required>
                    </div>
                    <div class="box-footer">
                        <button type="submit" formaction="{{route('sistema.main.altera.senha')}}" class="btn btn-success">
                            Confirmar alteração de senha
                        </button>
                        <a class="btn btn-dark" href="{{route('sistema.main.perfil')}}">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
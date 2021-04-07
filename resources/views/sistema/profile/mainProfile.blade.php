@extends('sistema.padraoSistema.head')
@section('titulo', 'Profile')
@section('content')
    <section class="content-header">
        <h1>
            Perfil
        </h1>
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
        @if(Session::has('message_ok'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Senha alterada com sucesso.
            </div>
        @endif
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Configurações</h3>
            </div>
            <form method="POST" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    <div class="form-group">
                        <label for="nomeProfile">Nome</label>
                        <input readonly="true" type="text" class="form-control" name="nome" value="{{auth()->user()->nome}}">
                    </div>
                    <div class="form-group">
                        <label for="emailProfile">Email</label>
                        <input readonly="true" type="email" class="form-control" name="email" value="{{auth()->user()->email}}">
                    </div>
                    <div class="form-group">
                        <label for="senhaProfile">Senha</label>
                        <input readonly="true" type="text" class="form-control" name="capa_senha" value="**********">
                        <input type="hidden" id="senhaProfile" name="senha" value="{{auth()->user()->password}}">
                        <br>
                        <a  href="{{route('sistema.main.alterar.senha')}}" class="btn btn-success">
                            Alterar Senha
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="adminProfile">Administrador</label>
                        <input readonly="true" type="text" class="form-control" name="admin" value="{{auth()->user()->admin}}">
                    </div>
                    <div class="box-footer">
                        <a class="btn btn-dark" href="">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

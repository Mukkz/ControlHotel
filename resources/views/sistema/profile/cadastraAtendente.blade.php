@extends('sistema.padraoSistema.head')
@section('titulo', 'Atendentes')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
@section('content')
    <section class="content-header">
        <div>
            <h1>
                Atendentes
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
                <h3 class="box-title">Cadastar novo Atendente</h3>
            </div>
            <form method="POST" role="form">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="nome">*Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome" value="{{old('nome')}}">
                    </div>
                    <div class="form-group">
                        <label for="email">*Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Insira o e-mail" value="{{old('email')}}">
                    </div>
                    <div class="form-group">
                        <label for="senha">*Senha</label>
                        <input type="password" class="form-control" name="password" placeholder="************">
                    </div>
                    <div class="form-group">
                        <label for="telefone">*Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(47) 9 9999 9999" value="{{old('telefone')}}">
                    </div>
                    <input type="hidden" name="hotel_id" value="{{auth()->user()->getHotelId()}}">
                    <input type="hidden" name="quartos" value="0">
                    <input type="hidden" name="admin" value="não">
                    <div class="box-footer">
                        <button type="submit" formaction="{{route('sistema.main.salva.perfil')}}" class="btn btn-primary">
                            Cadastrar
                        </button>
                        <a class="btn btn-dark" href="{{route('sistema.main.lista.perfil')}}">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
<script>    $(document).ready(function($){
        $("#telefone").mask("(99) 9 9999-9999");
    });</script>

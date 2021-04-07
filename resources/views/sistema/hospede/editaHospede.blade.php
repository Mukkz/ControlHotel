@extends('sistema.padraoSistema.head')
@section('titulo', 'Hóspedes')
@section('content')
    <section class="content-header">
        <div>
            <h1>
                Hóspede
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
                <h3 class="box-title">Editar dados Hóspede</h3>
            </div>
            <form method="POST" role="form">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="put">
                <div class="box-body">
                    <div class="form-group">
                        <label for="nomeHospede">*Nome</label>
                        <input type="text" class="form-control" name="nome" placeholder="Nome"
                               value="{{isset($registro->nome) ? $registro->nome : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="emailHospede">*Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Insira o e-mail"
                               value="{{isset($registro->email) ? $registro->email : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="contatoHospede">*Contato</label>
                        <input type="text" class="form-control" name="contato" placeholder="Telefone Contato"
                               value="{{isset($registro->contato) ? $registro->contato : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="dataNascimento">*Data Nascimento</label>
                        <input type="date" class="form-control" name="dataNascimento" placeholder="00/00/0000"
                               value="{{isset($registro->dataNascimento) ? $registro->dataNascimento : ''}}">
                    </div>
                    <div class="box-footer">
                        <button type="submit" formaction="{{route('sistema.main.hospedes.atualizar', $registro->id)}}"
                                class="btn btn-primary">
                            Salvar alteração
                        </button>
                        <a class="btn btn-dark" href="{{route('sistema.main.hospedes')}}">
                            Voltar
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection

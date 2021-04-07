@extends('sistema.padraoSistema.head')
@section('titulo', 'Quartos')
@section('content')
    <section class="content-header">
        <div>
            <h1>
                Quarto
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
                <h3 class="box-title">Cadastar novo Quarto</h3>
            </div>
            <form method="POST" role="form">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="nomeQuarto">Nome:</label>
                        <input type="text" class="form-control" name="nomeQuarto" placeholder="Nome"
                               value="{{isset($registro->nomeQuarto) ? $registro->nomeQuarto : ''}}">
                    </div>
                    <div class="form-group">
                        <label for="capacidade">Capacidade do quarto:</label><br>
                        <select name="capacidade">
                            <option {{$registro->capacidade == 'Individual' ? 'selected' : ''}} value="Individual">
                                Individual<br>
                            <option {{$registro->capacidade == 'Duplo' ? 'selected' : ''}} value="Duplo"> Duplo<br>
                            <option {{$registro->capacidade == 'Triplo' ? 'selected' : ''}} value="Triplo"> Triplo<br>
                            <option {{$registro->capacidade == 'Quadruplo' ? 'selected' : ''}} value="Quadruplo">
                                Quadruplo<br>
                            <option {{$registro->capacidade == 'Quintuplo' ? 'selected' : ''}} value="Quintuplo">
                                Quintuplo<br>
                            <option {{$registro->capacidade == 'Sextuplo' ? 'selected' : ''}} value="Sextuplo"> Sextuplo<br>
                            <option {{$registro->capacidade == '7+' ? 'selected' : ''}} value="7+"> 7+
                        </select>
                    </div>
                    <div class="box-footer">
                        <button type="submit" formaction="{{route('sistema.main.quartos.atualizar', $registro->id)}}"
                                class="btn btn-primary">Salvar alteração
                        </button>
                        <a class="btn btn-dark" href="{{route('sistema.lista.quartos')}}">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
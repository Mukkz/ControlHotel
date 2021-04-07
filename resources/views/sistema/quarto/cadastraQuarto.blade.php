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
                        <label for="nomeQuarto">*Nome</label>
                        <input type="text" class="form-control" name="nomeQuarto" placeholder="Nome do quarto" value="{{old('nomeQuarto')}}">
                    </div>
                    <div class="form-group">
                        <label for="capacidade">*Capacidade do quarto</label><br>
                        <select name="capacidade">
                            <option value="Individual"> Individual<br>
                            <option value="Duplo"> Duplo<br>
                            <option value="Triplo"> Triplo<br>
                            <option value="Quadruplo"> Quadruplo<br>
                            <option value="Quintuplo"> Quintuplo<br>
                            <option value="Sextuplo"> Sextuplo<br>
                            <option value="7+"> 7+
                        </select>
                        <input type="hidden" name="hotel_id" value="{{auth()->user()->getHotelId()}}">
                        <input type="hidden" name="status_reserva" value="Inativo">
                        <input type="hidden" name="status_quarto" value="Ativo">
                    </div>

                    <div class="box-footer">
                        <button type="submit" formaction="{{route('sistema.main.quarto.salvar')}}"
                                class="btn btn-primary">Cadastrar
                        </button>
                        <a class="btn btn-dark" href="{{route('sistema.lista.quartos')}}">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
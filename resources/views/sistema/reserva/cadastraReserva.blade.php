@extends('sistema.padraoSistema.head')
@section('titulo', 'Reservas')
@section('content')

    <link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
    <script src="http://demo.expertphp.in/js/jquery.js"></script>
    <script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


    <section class="content-header">
        <div>
            <h1>
                Reserva
            </h1>
        </div><br>
        @if(Session::has('message_erro'))
            <div class="container alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Hóspede não encontrado no sistema, favor verificar
            </div>
        @endif
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
                <h3 class="box-title">Realizar nova reserva </h3>
                {{--                <br>{{$teste}}--}}
            </div>
            <form method="POST" role="form">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group">
                        <label for="dataInicio">Data Início:</label>
                        <input required type="date" name="inicioReserva" value="{{@$inicioReserva}}">
                        <label for="dataFim">Data Fim:</label>
                        <input required type="date" name="fimReserva" value="{{@$fimReserva}}">
                    </div>
                    @if(isset($mensagem))
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i>{{$mensagem}}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="capacidade">Capacidade do quarto:</label><br>
                        <select name="capacidade">
                            <option value="Individual"> Individual<br>
                            <option value="Duplo"> Duplo<br>
                            <option value="Triplo"> Triplo<br>
                            <option value="Quadruplo"> Quadruplo<br>
                            <option value="Quintuplo"> Quintuplo<br>
                            <option value="Sextuplo"> Sextuplo<br>
                            <option value="7+"> 7+
                        </select>
                    </div>
                    <button type="submit" formaction="{{route('core.check.reserva')}}" class="btn btn-primary">Checar
                        quartos disponíveis
                    </button>
                    <a class="btn btn-default" href="{{route('core.reserva')}}">Voltar</a>
                    <br><br>
                    <hr>

                    @if(isset($hotel))
                        <div class="form-group">
                            <label for="hospede">Hóspede:</label>
                                @if($hospedes->count() > 0)
                                    <input type="text" autocomplete="off" class="form-control" name="hospede" id="nome"
                                           placeholder="Pesquisar por um hóspede cadastrado"
                                           value="{{old('nome')}}">
                                    <div id="listaNomes"></div>
                                    {{ csrf_field() }}
                                @else
                                    <div>Você deve ter pelo menos 1 hóspede cadastrado</div>
                                @endif
                        </div>
                        <div class="form-group">
                            @if($hospedes ->count() > 0)
                                @if($hotel->quartos->count()>0)
                                    <label for="quarto">Quarto:</label><br>
                                    <select name="quarto_id">
                                        @foreach($hotel->quartos as $t10)
                                            <option value="{{$t10->id}}">{{$t10->nomeQuarto}}<br>
                                        @endforeach
                                    </select>
                                    <br><br>
                                    <label for="valorDiaria">Valor da diária:</label><br>
                                    <input type="text"  name="valorDiaria" id="valorDiaria">
                                        <button type="submit" formaction="{{route('core.realiza.reserva')}}"
                                                class="btn btn-success">
                                            Reservar
                                        </button>
                                @else
                                    <tr role="row">
                                        <div class="callout callout-warning">
                                            <h4>Alerta!</h4>
                                            <p>Nenhum quarto disponível para esta data ou capacidade.</p>
                                        </div>
                                    </tr>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>

                <input type="hidden" name="hotel_id" value="{{auth()->user()->getHotelId()}}">
                <input type="hidden" name="efetuouReserva" value="{{auth()->user()->nome}}">
            </form>
        </div>
    </section>

    <script>
        $(document).ready(function () {

            $('#nome').keyup(function () {
                var query = $(this).val();
                if (query != '') {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete.fetch') }}",
                        method: "POST",
                        data: {query: query, _token: _token},
                        success: function (data) {
                            $('#listaNomes').fadeIn();
                            $('#listaNomes').html(data);
                        }
                    });
                }
            });

            $(document).on('click', 'li', function () {
                $('#nome').val($(this).text());
                $('#listaNomes').fadeOut();
            });

        });
    </script>

<script>   
    $(document).ready(function($){
        $("#valorDiaria").mask("000.00");
    });
</script>

@endsection
@extends('sistema.padraoSistema.head')
@section('titulo', 'Reserva')
@section('content')
    <section class="content-header">
        <div>
            <h1>
                Gerenciamento de Reservas
            </h1>
        </div>
        <div>
        <a href="{{route('core.nova.reserva')}}">
        <button type="button" class="btn btn-flat btn-warning active btn-sm"
                style=" width: 98%;margin-left: 10px; margin-right: 10px;font-size: 25px ">
            Realizar uma nova Reserva
        </button>
    </a>
        </div><br>
        @if(Session::has('container message_cancelado'))
            <div class="container alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Reserva cancelada com sucesso
            </div>
        @endif
        @if(Session::has('message'))
            <div class="container alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Reserva efetuada com sucesso
            </div>
        @endif
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Reservas abertas</h3>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="row">
                            <form action="{{route('core.pesquisa.reserva')}}" method="GET">
                                <div class="col-sm-3" style="margin-left: 2%">
                                    <div id="filtro" class="dataTables_filter">
                                        <label>Procurar:
                                            <input type="search" class="form-control input-sm"
                                                   placeholder="Procure pelo check in"
                                                   size="20%" name="valorPesquisadoReserva">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1" style="text-align: center;">
                                    <button class="btn btn-success" type="submit">Pesquisar</button>
                                </div>
                                <div class="col-sm-1" style="text-align: center;">
                                    <a class="btn btn-default" href="{{route('core.reserva')}}">
                                        Limpar pesquisa
                                    </a>
                                </div>
                                @if(count($errors) != 0)
                                    {{--{{dd($errors)}}--}}
                                    @foreach($errors->get('valorPesquisadoReserva') as $erro)
                                        <div class="col-sm-offset-6 alert alert-danger alert-dismissible" style="padding: 5px; width: 460px;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <p>{{$erro}}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                    <tr role="row">
                                        <th>Hospede</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Quarto</th>
                                        <th>Status</th>
                                        <th>Ação</th>
                                      </tr>
                                </thead>
                                <tbody>
                                @forelse($reservas as $reserva)
                                    <tr role="row">
                                        <td>
                                            {{$reserva->hospede->nome}}
                                        </td>
                                          <td>
                                            {{date('d/m/Y', strtotime($reserva->inicioReserva))}}
                                        </td>
                                        <td>
                                            {{date('d/m/Y', strtotime($reserva->fimReserva))}}
                                        </td>
                                        <td>
                                            {{$reserva->quarto->nomeQuarto}}
                                        </td>
                                        <td>
                                            {{$reserva->status}}
                                        </td>
                                        <td>
                                                {{--<a title="Edição reserva desabilitado" class="btn btn-flat btn-warning"--}}
                                                   {{--href="#">--}}
                                                    {{--<i class="fa fa-fw fa-edit"></i>--}}
                                                {{--</a>--}}
                                            <a onclick="return confirm('Quer realmente cancelar esta reserva?')" href="{{route('core.cancela.reserva', $reserva->id)}}"
                                               title="Cancelar Reserva" class="btn btn-flat btn-danger">
                                                <i class="fa fa-w fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row">
                                        <td colspan="7">
                                            Nenhuma reserva no momento.
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                {{$reservas -> links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--Canceladas--}}

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Reservas canceladas e fechadas</h3>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <div class="row">
                            <form action="{{route('core.pesquisa.reservaAlterada')}}">
                                <div class="col-sm-3" style="margin-left: 2%">
                                    <div id="filtro" class="dataTables_filter">
                                        <label>Procurar:
                                            <input type="search" class="form-control input-sm"
                                                   placeholder="Procure pelo check in"
                                                   size="20%" name="valorPesquisadoReservaAlterada">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-1" style="text-align: center; position: inherit">
                                    <button class="btn btn-success" type="submit">Pesquisar</button>
                                </div>
                                <div class="col-sm-1" style="text-align: center; position: inherit">
                                    <a class="btn btn-default" href="{{route('core.reserva')}}">
                                        Limpar pesquisa
                                    </a>
                                </div>
                                @if(count($errors) != 0)
                                    @foreach($errors->get('valorPesquisadoReservaAlterada') as $erro)
                                        <div class="col-sm-offset-6 alert alert-danger alert-dismissible" style="padding: 5px; width: 460px;">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <p>{{$erro}}</p>
                                        </div>
                                    @endforeach
                                @endif
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped dataTable">
                                <thead>
                                <tr role="row">
                                    <th>Hospede</th>
                                    <th>Check In</th>
                                    <th>Check Out</th>
                                    <th>Quarto</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($reservasAlteradas as $reservaAlterada)
                                    <tr role="row">
                                        <td>
                                            {{$reservaAlterada->hospede->nome}}
                                        </td>
                                        <td>
                                            {{date('d/m/Y', strtotime($reservaAlterada->inicioReserva))}}
                                        </td>
                                        <td>
                                            {{date('d/m/Y', strtotime($reservaAlterada->fimReserva))}}
                                        </td>
                                        <td>
                                            {{$reservaAlterada->quarto->nomeQuarto}}
                                        </td>
                                        <td>
                                            {{$reservaAlterada->status}}
                                        </td>
                                    </tr>
                                </tbody>
                            @empty
                                <tr role="row">
                                    <td colspan="7">
                                        Nenhuma reserva no momento.
                                    </td>
                                </tr>
                           @endforelse
                         </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                {{$reservasAlteradas-> links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>
@endsection

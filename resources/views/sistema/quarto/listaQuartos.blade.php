@extends('sistema.padraoSistema.head')
@section('titulo', 'Gerenciamento dos quartos')
@section('content')

    <br>
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" style=" width: 97%;margin-left: 20px; margin-right: 20px;
   font-size: 15px ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i>Quarto cadastrado com sucesso.
        </div>
    @elseif(Session::has('message_inative'))
        <div class="alert alert-warning alert-dismissible" style=" width: 97%;margin-left: 20px; margin-right: 20px;
   font-size: 15px ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i>Quarto inativado com sucesso.
        </div>
    @elseif(Session::has('message_active'))
        <div class="alert alert-success alert-dismissible" style=" width: 97%;margin-left: 20px; margin-right: 20px;
   font-size: 15px ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i>Quarto ativado com sucesso.
        </div>
    @elseif(Session::has('message5'))
        <div class="alert alert-success alert-dismissible" style=" width: 97%;margin-left: 20px; margin-right: 20px;
   font-size: 15px ">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa fa-check"></i>Quarto editado com sucesso.
        </div>
    @endif

    <section class="content-header">
        <h1>
            Gerenciamento dos quartos
        </h1>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Quartos cadastrados</h3>
            </div>
            <div class="box-body">
                <div class="dataTables_wrapper form-inline dt-bootstrap">
                    <div class="row">
                        <form action="{{route('sistema.main.quartos.pesquisar')}}" method="GET">
                            <div class="col-sm-3">
                                <div id="filtro" class="dataTables_filter">
                                    <label>Procurar:
                                        <input type="search" class="form-control input-sm"
                                               placeholder="Procure pelo nome"
                                               size="25%" name="valorPesquisado">
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <button class="btn btn-success" type="submit">Pesquisar</button>
                            </div>
                        </form>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="Hospedes" class="table table-bordered table-striped dataTable" role="grid">
                                <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Capacidade</th>
                                    <th>Status atual do quarto</th>
                                    <th>Ação</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($quartos as $quarto)
                                    <tr role="row" class="odd">
                                        <td>{{$quarto->nomeQuarto}}</td>
                                        <td>{{$quarto->capacidade}}</td>
                                        <td>{{$quarto->status_quarto}}</td>
                                        <td>
                                            @if(auth()->user()->admin == "sim")
                                            <label title="Editar quarto">
                                                <a class="btn btn-flat btn-warning"
                                                   href="{{route('sistema.main.quartos.editar', $quarto->id)}}">
                                                    <i class="fa fa-fw fa-edit"></i>
                                                </a>
                                            </label>
                                            @endif
                                            <label title="Ativar quarto">
                                                <a class="btn btn-flat btn-primary"
                                                   href="{{route('sistema.main.quarto.ativar', $quarto->id)}}">
                                                    <i class="fa fa-fw fa-check-circle"></i>
                                                </a>
                                            </label>
                                            <label title="Inativar quarto">
                                                <a class="btn btn-flat btn-danger"
                                                   onclick="return confirm('Você tem certeza que deseja inativar este quarto?')"
                                                   href="{{route('sistema.main.quarto.inativar', $quarto->id)}}">
                                                    <i class="fa fa-fw fa-times-circle"></i>
                                                </a>
                                            </label>
                                        </td>
                                    </tr>
                                @empty
                                    <tr role="row" class="odd">
                                        <td colspan="8" align="center"><b>Nenhum quarto cadastrado no sistema ainda</b>
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Capacidade</th>
                                        <th>Status atual do quarto</th>
                                        <th>Ação</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">
                                {{$quartos->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery 3 -->
    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
@endsection

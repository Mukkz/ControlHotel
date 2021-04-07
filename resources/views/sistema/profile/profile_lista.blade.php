@extends('sistema.padraoSistema.head')
@section('titulo', 'Profile')
@section('content')
    <section class="content-header">
        <div>
            <h1>
                Atendentes
            </h1>
        </div>
        @if(Session::has('message_ok'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Atendente cadastrado com sucesso.
            </div>
        @endif
        @if(Session::has('message_delete'))
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i>Usuário excluído com sucesso.
            </div>
        @endif
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Atendentes registrados</h3>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-12">
                    <table id="Atendentes" class="table table-bordered table-striped dataTable">
                        <thead>
                        <tr role="row">
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Contato</th>
                            <th>Ação</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($atendentes as $atendente)
                            <tr role="row" class="odd">
                                <td>{{$atendente->nome}}</td>
                                <td>{{$atendente->email}}</td>
                                <td>{{$atendente->telefone}}</td>
                                <td>
                                    <a class="btn btn-flat btn-danger"
                                       onclick="return confirm('Atenção!!!!!\n\nVocê tem certeza que quer excluir este usuário?\n\nEsta ação é irreversível!!!!!')"
                                       href="{{route('sistema.main.deleta.perfil', $atendente->id)}}">
                                        <i class="fa fa-fw fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr role="row" class="odd">
                                <td colspan="4" align="center"><b>Nenhum atendente cadastrado no sistema ainda</b></td>
                            </tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Contato</th>
                            <th>Ação</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

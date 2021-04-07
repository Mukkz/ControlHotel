@extends('sistema.padraoSistema.head')
@section('titulo', 'Dashboard')
@section('content')
    <br>
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>
    <section class="content">
        <h4>Hóspedes</h4>
        <div class="col-md-12">
            <div class="info-box bg-navy">
                <span class="info-box-icon"><i class="fa fa-group"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Hóspedes cadastrados no sistema</span>
                    <span class="info-box-number">{{$totalHospedes}}</span>
                </div>
            </div>
        </div>
        {{--<div class="col-md-6">--}}
            {{--<div class="info-box bg-navy">--}}
                {{--<span class="info-box-icon"><i class="fa fa-bar-chart"></i></span>--}}
                {{--<div class="info-box-content">--}}
                    {{--<span class="info-box-text">Média de idade dos hóspedes</span>--}}
                    {{--<span class="info-box-number">123123</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <h4>Quartos</h4>
        <div class="col-md-12">
            <div class="info-box bg-navy">
                <span class="info-box-icon"><i class="fa fa-bed"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Quartos cadastrados no sistema</span>
                    <span class="info-box-number">{{$totalQuartos}}</span>
                </div>
            </div>
        </div>

        <h4>Reservas</h4>
        <div class="col-md-4">
            <div class="info-box bg-blue col-md-3">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Reservas realizadas</span>
                    <span class="info-box-number">{{$totalReservasMes}}</span>

                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Dados do mês atual
                  </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box bg-green col-md-3">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Reservas concluídas</span>
                    <span class="info-box-number">{{$totalReservasConcluidasMes}}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Dados do mês atual
                  </span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="info-box bg-red">
                <span class="info-box-icon"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Reservas canceladas</span>
                    <span class="info-box-number">{{$totalReservasCanceladasMes}}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                    Dados do mês atual
                  </span>
                </div>
            </div>
        </div>
    </section>
    <!-- jQuery 3 -->
    <script src="{{asset('/assets/js/jquery.min.js')}}"></script>
@endsection

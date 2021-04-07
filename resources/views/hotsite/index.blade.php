@extends('hotsite.padrao.head')

@section('titulo', 'ControlTel')


<body>

@include('hotsite.padrao.header')

<div class="container-login100" style="background-image: url('{{'../assets/images/bg-02.jpg'}}');">
    <div>
        <h1 style="color: whitesmoke; font-family: Ubuntu-Bold, sans-serif; font-size: 40px; text-align: center;">
            Bem vindo ao seu sistema de gestão de reservas de quarto</h1>
        <h1 style=" color: white; font-family: Ubuntu-Regular, sans-serif; font-size: 50px; text-align: center;">C o n t
            r o l
            <span style="color: #5383d3; font-family: Ubuntu-Regular, sans-serif; font-size: 50px; text-align: center;">H o t e l</span>
        </h1>

        <br>
        <h2 style="color: white; font-family: Ubuntu-Regular, sans-serif; font-size: 30px; text-align: center;">
            Cadastre-se <a href="{{url('cadastro')}}" style="font-size: 30px; text-underline: white "><u>aqui</u></a>
            comece a utilizar!
        </h2>
    </div>
</div>

@include('hotsite.padrao.footer')

</body>

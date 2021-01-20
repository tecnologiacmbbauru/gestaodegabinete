@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 style="text-align:center;">Agenda</h2>
        <div id="alerta" class="alerta atencao col-md-11">
            <h3 >A sua Agenda não está sincronizada.</h3>
            <p >
                <br>
                Cadastre as <a href="{{route('chaveAgenda.index')}}" class="link-cad"><u>chaves do Google</u></a> para sincronizar sua Agenda.
                <br>
                Caso tenha dúvidas, acesse o Manual do Usuário.
            </p>                      
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container" style="text-align: center;">
        <h1 class="titulo">Downloads e Utilitários</h1>
        <div class="download-links">
            <h2>Arquivos Disponíveis:</h2>
        </div>
        <hr style="margin-bottom: 20px;">
        <details style="margin: 0 auto;">
            <summary style="cursor: pointer;">MODELO - Lista de presença</summary>
            <hr style="margin-top: 20px;">
            <iframe style="width:100%; height:500px" src="{{ asset('utils/Modelo_Agenda_de_Visitas.pdf') }}"></iframe>
        </details>
        <hr style="margin-top: 20px;">
    </div>
@endsection

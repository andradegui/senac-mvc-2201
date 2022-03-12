@extends('layouts.externo')
@section('title', 'Minha primeira view')
@section('sidebar')
@parent
<hr>
@endsection
@section('content')

@if($mostrar)
<div class="alert alert-danger" role="alert">
    ATENÇÃO: Não se esqueça de sextar
</div>
@else
<div></div>
@endif
<table class="table">
    <tr>
        <td>Quadro de Avisos de {{$nome}}</td>
    </tr>
    @foreach($avisos as $aviso)
    <tr>
        <td>Aviso #{{$aviso ['id']}} <br>{{$aviso ['aviso']}}</td>
    </tr>
    @endforeach
</table>
@endsection

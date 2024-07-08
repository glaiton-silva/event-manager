@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">{{ $event->name }}</h1>
    <div class="row">
        <div class="col-md-8">
            <ul class="list-group">
                <li class="list-group-item"><strong>Data do Evento:</strong> {{ $event->event_date->format('d/m/Y H:i') }}</li>
                <li class="list-group-item"><strong>Responsável:</strong> {{ $event->responsible }}</li>
                <li class="list-group-item"><strong>Cidade:</strong> {{ $event->city }}</li>
                <li class="list-group-item"><strong>Estado:</strong> {{ $event->state }}</li>
                <li class="list-group-item"><strong>Endereço:</strong> {{ $event->address }}</li>
                <li class="list-group-item"><strong>Número:</strong> {{ $event->number }}</li>
                <li class="list-group-item"><strong>Complemento:</strong> {{ $event->complement }}</li>
                <li class="list-group-item"><strong>Telefone:</strong> {{ $event->phone }}</li>
            </ul>
        </div>
        <div class="col-md-4">
            @if ($event->image)
                <p><strong>Imagem:</strong></p>
                <img src="{{ Storage::url($event->image) }}" alt="{{ $event->name }}" class="img-fluid rounded" style="max-height: 280px;">
            @endif
        </div>
    </div>
    <a href="{{ route('events.index') }}" class="btn btn-secondary mt-4">Voltar</a>
</div>
@endsection

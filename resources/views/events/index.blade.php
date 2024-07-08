@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">Eventos</h1>
        <a href="{{ route('events.create') }}" class="btn btn-primary btn-lg">Criar Novo Evento</a>
    </div>

    @if ($events->isEmpty())
        <div class="alert alert-warning text-center" role="alert">
            Não há eventos cadastrados.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($events as $event)
                <div class="col">
                    <div class="card h-100">
                        <div class="card-img-top-container">
                            <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="{{ $event->name }}">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->name }}</h5>
                            <p class="card-text"><strong>Data:</strong> {{ $event->event_date->format('d M Y, H:i') }}</p>
                            <p class="card-text"><strong>Cidade:</strong> {{ $event->city }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between align-items-center">
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-outline-primary me-2 flex-grow-1">Ver</a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-outline-warning me-2 flex-grow-1">Editar</a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger flex-grow-1">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $events->links() }}
        </div>
    @endif
</div>

<style>
    .card-img-top-container {
        height: 200px;
        overflow: hidden;
    }
    .card-img-top {
        height: 100%;
        object-fit: cover;
        width: 100%;
    }
    .btn-outline-primary, .btn-outline-warning, .btn-outline-danger {
        flex-grow: 1;
        text-align: center;
    }
</style>
@endsection

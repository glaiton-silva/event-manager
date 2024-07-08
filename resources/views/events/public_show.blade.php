<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Evento</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .event-image {
            max-height: 400px;
            object-fit: cover;
            width: 100%;
        }
        .banner {
            background-image: url('https://via.placeholder.com/1200x400/333333/ffffff?text=');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            text-align: center;
        }
        .banner h1 {
            font-size: 3em;
        }
        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home') }}">Eventos</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Início</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('events.index') }}">Painel Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Banner -->
    <div class="banner">
        <h1>Detalhes do Evento</h1>
        <p>Informações completas sobre o evento</p>
    </div>

    <!-- Conteúdo Principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    @if ($event->image)
                        <img src="{{ Storage::url($event->image) }}" class="card-img-top event-image" alt="{{ $event->name }}">
                    @endif
                    <div class="card-body">
                        <h2 class="card-title">{{ $event->name }}</h2>
                        <p class="card-text"><strong>Data do Evento:</strong> {{ $event->event_date->format('d M Y, H:i') }}</p>
                        <p class="card-text"><strong>Responsável:</strong> {{ $event->responsible }}</p>
                        <p class="card-text"><strong>Cidade:</strong> {{ $event->city }}</p>
                        <p class="card-text"><strong>Estado:</strong> {{ $event->state }}</p>
                        <p class="card-text"><strong>Endereço:</strong> {{ $event->address }}</p>
                        <p class="card-text"><strong>Número:</strong> {{ $event->number }}</p>
                        <p class="card-text"><strong>Complemento:</strong> {{ $event->complement }}</p>
                        <p class="card-text"><strong>Telefone:</strong> {{ $event->phone }}</p>
                        @if ($event->description)
                            <p class="card-text"><strong>Descrição:</strong> {{ $event->description }}</p>
                        @endif
                        <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="container p-4">
            <p class="text-center">© 2024 Dashboard de Eventos. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>

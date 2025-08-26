@extends('layouts.app')

@section('title', 'Locais - Laravel Maps App')

    @section('styles')
    <style>
        /* --- Variáveis de cores de praia --- */
        :root {
            --sea-blue: #8d0ab9ff;
            --sand-yellow: #7b2be4ff;
            --sun-orange: #a809d0ff;
            --card-bg: #60008dff;
            --primary-color: #5715f1ff; 
            --secondary-color: #24b9f0ff;
            --transition: all 0.3s ease;
        }

            /* --- Fundo do corpo do site --- */
        body {
            background: linear-gradient(to bottom, #fffdf5, var(--sand-yellow));
            color: #333;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            transition: var(--transition);
        }

        /* --- Fundo do Header --- */
        header, .navbar, .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: #000000ff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.27);
            transition: var(--transition);
        }

        /* --- Links do header --- */
        header a, .navbar a {
            color: #000000ff;
            transition: #ffff;
        }

        header a:hover, .navbar a:hover {
            color: #fff;
        }

        /* --- Ícones do header --- */
        header i, .navbar i {
            color: var(--sun-orange);
            transition: transform 0.3s ease;
        }

        header i:hover, .navbar i:hover {
            transform: rotate(15deg);
        }



        .card {
            background: var(--card-bg);
            border-radius: 16px;
            overflow: hidden;
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .location-card {
            background: linear-gradient(145deg, var(--sand-yellow), #fff9eeff);
        }

        /* --- Mapa --- */
        #map {
            color: white;
            width: 100%;
            height: 500px;
            border-radius: 15px;
            border: 2px solid var(--sea-blue);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        #map:hover {
            transform: scale(1.02);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        /* --- Cards de Local --- */
        .location-card {
            background: linear-gradient(145deg, var(--sand-yellow), #fff9eeff);
            border-radius: 12px;
            margin-bottom: 12px;
            padding: 15px;
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .location-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }


        /* --- Card Principal --- */
        .card {
            border: none;
            border-radius: 16px;
            background: var(--card-bg);
            overflow: hidden;
            transition: var(--transition);
            margin-bottom: 1.5rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            color: white;
            border-bottom:rgba(0, 0, 0, 0.66);
            padding: 1rem 1.5rem;
        }

        .card-title {
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            padding: 1.5rem;
        }

            /* --- Botões Primários (Adicionar Local / Header) --- */
    .btn-primary {
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border: none;
        color: #000000ff;
        transition: var(--transition);
    }

    .btn-primary:hover {
        background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
        color: #000000ff;
    }

    /* --- Botões Outline --- */
    .btn-outline-primary {
        border-color: var(--sea-blue);
        color: var(--sea-blue);
        background: transparent;
        transition: var(--transition);
    }

    .btn-outline-primary:hover {
        background: var(--sea-blue);
        color: #fff;
    }

    .btn-outline-warning {
        border-color: var(--sun-orange);
        color: var(--sun-orange);
        background: transparent;
        transition: var(--transition);
    }

    .btn-outline-warning:hover {
        background: var(--sun-orange);
        color: #fff;
    }

    .btn-outline-danger {
        border-color: #ff6f61;
        color: #ff6f61;
        background: transparent;
        transition: var(--transition);
    }

    .btn-outline-danger:hover {
        background: #ff6f61;
        color: #fff;
    }

    /* --- Botões dos Cards (tamanho pequeno) --- */
    .location-card .btn {
        border-radius: 8px;
        padding: 0.25rem 0.5rem;
        font-size: 0.85rem;
    }


        /* --- Lista de Locais --- */
        .list-group-item {
            border: none;
            padding-left: 0;
            padding-right: 0;
        }

        /* --- Cabeçalhos e ícones --- */
        h1 i, h5 i {
            color: var(--sun-orange);
            transition: transform 0.3s ease;
        }

        h1 i:hover, h5 i:hover {
            transform: rotate(15deg);
        }

        /* --- Badge de categoria --- */
        .badge {
            font-size: 0.8rem;
            padding: 0.35em 0.65em;
            border-radius: 10px;
            background: var(--primary-color);
            color: #fff;
        }

        /* --- Mensagem quando não há locais --- */
        .text-center i {
            color: var(--sea-blue);
            animation: bounce 2s infinite;
        }


        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }
    </style>

@section('content')
<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>
                <i class="fas fa-map-marker-alt me-2"></i>Locais Cadastrados
            </h1>
            <a href="{{ route('locations.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1 sea-blue"></i>Adicionar Local
            </a>
        </div>
    </div>
</div>

<div class="row">
    <!-- Mapa -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-map me-2"></i>Mapa Interativo
                </h5>
            </div>
            <div class="card-body">
                <div id="map"></div>
            </div>
        </div>
    </div>

    <!-- Lista de Locais -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Lista de Locais
                </h5>
            </div>
            <div class="card-body">
                @if($locations->count() > 0)
                <div class="list-group">
                    @foreach($locations as $location)
                    <div class="list-group-item location-card">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <h6 class="mb-1">{{ $location->name }}</h6>
                                @if($location->category)
                                <span class="badge bg-secondary mb-2">{{ $location->category }}</span>
                                @endif
                                @if($location->address)
                                <p class="mb-1 text-muted small">
                                    <i class="fas fa-map-pin me-1"></i>{{ $location->address }}
                                </p>
                                @endif
                                <p class="mb-1 text-muted small">
                                    <i class="fas fa-location-arrow me-1"></i>{{ $location->latitude }}, {{ $location->longitude }}
                                </p>
                            </div>
                            <div class="btn-group btn-group-sm">
                                <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-outline-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este local?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-center py-4">
                    <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Nenhum local cadastrado</h5>
                    <p class="text-muted">Clique em "Adicionar Local" para começar!</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection {{-- <--- FECHA A SEÇÃO CONTENT --}}

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar o mapa
    var map = L.map('map').setView([-23.5505, -46.6333], 10);

    // Adicionar camada do OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var markers = [];
    var locations = {!! json_encode($locations) !!};

    locations.forEach(function(location) {
        var marker = L.marker([location.latitude, location.longitude])
            .addTo(map)
            .bindPopup(
                '<div class="text-center">' +
                '<h6><strong>' + location.name + '</strong></h6>' +
                (location.category ? '<p class="badge bg-secondary">' + location.category + '</p>' : '') +
                (location.address ? '<p><i class="fas fa-map-pin"></i> ' + location.address + '</p>' : '') +
                (location.description ? '<p>' + location.description + '</p>' : '') +
                '<div class="mt-2">' +
                '<a href="/locations/' + location.id + '" class="btn btn-sm btn-primary">Ver Detalhes</a>' +
                '</div>' +
                '</div>'
            );

        markers.push(marker);
    });

    if (markers.length > 0) {
        var group = new L.featureGroup(markers);
        map.fitBounds(group.getBounds().pad(0.1));
    }
});
</script>
@endsection

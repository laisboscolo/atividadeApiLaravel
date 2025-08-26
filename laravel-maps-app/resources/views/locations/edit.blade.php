@extends('layouts.app')

@section('title', 'Editar ' . $location->name . ' - Laravel Maps App')

    @section('styles')
<style>
    /* --- Variáveis de cores de praia --- */
    :root {
        --sea-blue: #8bd7faff;
        --sand-yellow: #ffe493ff;
        --sun-orange: #f9b145ff;
        --card-bg: #fff8e1;
        --primary-color: #1c90cfff;
        --secondary-color: #1db8cdff;
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


/* --- Ajuste nos cards para harmonizar --- */
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
        color: black;
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
    color: #fff;
    transition: var(--transition);
}

.btn-primary:hover {
    background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
    color: #fff;
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
            <h1><i class="fas fa-edit me-2"></i>Editar Local</h1>
            <a href="{{ route('locations.show', $location->id) }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>Voltar
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-map me-2"></i>Atualizar Localização</h5>
            </div>
            <div class="card-body">
                <div id="map" style="height: 400px;"></div>
                <small class="text-muted mt-2 d-block">
                    <i class="fas fa-info-circle me-1"></i>
                    Clique no mapa para atualizar as coordenadas do local
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="fas fa-edit me-2"></i>Editar Informações</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('locations.update', $location->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nome do Local *</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $location->name) }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea name="description" id="description" rows="3"
                                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $location->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude *</label>
                                <input type="number" step="any" name="latitude" id="latitude"
                                       class="form-control @error('latitude') is-invalid @enderror"
                                       value="{{ old('latitude', $location->latitude) }}" required>
                                @error('latitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude *</label>
                                <input type="number" step="any" name="longitude" id="longitude"
                                       class="form-control @error('longitude') is-invalid @enderror"
                                       value="{{ old('longitude', $location->longitude) }}" required>
                                @error('longitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Endereço</label>
                        <input type="text" name="address" id="address"
                               class="form-control @error('address') is-invalid @enderror"
                               value="{{ old('address', $location->address) }}">
                        @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Categoria</label>
                        <select name="category" id="category"
                                class="form-select @error('category') is-invalid @enderror">
                            <option value="">Selecione uma categoria</option>
                            @foreach(['Restaurante','Hotel','Shopping','Parque','Museu','Teatro','Hospital','Escola','Outro'] as $cat)
                                <option value="{{ $cat }}" {{ old('category', $location->category) == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-save me-1"></i>Atualizar Local
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var lat = parseFloat('{{ $location->latitude }}');
    var lng = parseFloat('{{ $location->longitude }}');

    var map = L.map('map').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var marker = L.marker([lat, lng]).addTo(map);

    map.on('click', function(e) {
        var newLat = e.latlng.lat;
        var newLng = e.latlng.lng;
        document.getElementById('latitude').value = newLat.toFixed(8);
        document.getElementById('longitude').value = newLng.toFixed(8);

        marker.setLatLng([newLat, newLng])
              .bindPopup(`<div class="text-center">
                  <strong>Nova localização:</strong><br>
                  Lat: ${newLat.toFixed(8)}<br>
                  Lng: ${newLng.toFixed(8)}
              </div>`).openPopup();
    });
});
</script>
@endsection

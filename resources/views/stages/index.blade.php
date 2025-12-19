@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Liste des Stages</h1>
    <a href="{{ route('stages.create') }}" class="btn btn-primary">
        + Déposer un Sujet
    </a>
</div>

<div class="card shadow">
    <div class="card-body">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Sujet</th>
                    <th>Étudiant</th>
                    <th>Encadrant</th>
                    <th>Statut</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($stages as $stage)
                <tr>
                    <td class="fw-bold">{{ $stage->titre }}</td>
                    
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-2">
                                <div class="fw-bold">{{ $stage->etudiant->user->name ?? 'Inconnu' }}</div>
                                <div class="text-muted small">{{ $stage->etudiant->filiere ?? '' }}</div>
                            </div>
                        </div>
                    </td>
                    
                    <td>{{ $stage->encadrant->user->name ?? 'Non assigné' }}</td>
                    
                    <td>
                        @if($stage->statut == 'valide')
                            <span class="badge bg-success">Validé</span>
                        @elseif($stage->statut == 'refuse')
                            <span class="badge bg-danger">Refusé</span>
                        @else
                            <span class="badge bg-warning text-dark">En cours</span>
                        @endif
                    </td>
                    
                    <td class="text-end">
                        <a href="{{ route('stages.show', $stage->id) }}" class="btn btn-sm btn-info text-white">Voir</a>
                        <a href="{{ route('stages.edit', $stage->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        
                        <form action="{{ route('stages.destroy', $stage->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce stage ?');">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger">X</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center">Aucun stage trouvé.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
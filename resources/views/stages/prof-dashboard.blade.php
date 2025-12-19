@extends('layout')
@section('content')

<h2>Espace Professeur</h2>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card shadow border-left-primary">
            <div class="card-header bg-primary text-white">Étudiants que j'encadre</div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($stagesEncadres as $stage)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>{{ $stage->etudiant->user->name }}</strong><br>
                                <small>{{ $stage->titre }}</small>
                            </div>
                            <span class="badge bg-{{ $stage->statut == 'valide' ? 'success' : 'warning' }}">
                                {{ $stage->statut }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item">Aucun étudiant encadré.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow border-left-danger">
            <div class="card-header bg-danger text-white">Rapports à corriger</div>
            <div class="card-body">
                <ul class="list-group">
                    @forelse($stagesRapporteur as $stage)
                        <li class="list-group-item">
                            <strong>{{ $stage->etudiant->user->name }}</strong>
                            <a href="{{ route('stages.show', $stage->id) }}" class="btn btn-sm btn-outline-danger float-end">Voir le rapport</a>
                        </li>
                    @empty
                        <li class="list-group-item">Aucun rapport assigné.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
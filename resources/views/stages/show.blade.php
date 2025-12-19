@extends('layout')

@section('content')

<div class="container-fluid px-4 py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary fw-bold">Détails du Stage</h2>
        <a href="{{ route('stages.index') }}" class="btn btn-secondary text-white">
            <i class="fas fa-arrow-left me-2"></i> Retour
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-9 col-12">
            
            <div class="card shadow-sm border-0 mb-4 h-100">
                <div class="card-header bg-primary text-white py-3 px-4">
                    <h5 class="mb-0 text-capitalize">{{ $stage->titre }}</h5>
                </div>
                <div class="card-body p-4">
                    <h6 class="text-uppercase text-muted fw-bold small mb-2">Description</h6>
                    <p class="lead fs-6 mb-4">{{ $stage->description }}</p>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <strong class="me-2">Statut :</strong>
                            @if($stage->statut == 'valide')
                                <span class="badge bg-success rounded-pill px-3">Validé</span>
                            @elseif($stage->statut == 'refuse')
                                <span class="badge bg-danger rounded-pill px-3">Refusé</span>
                            @else
                                <span class="badge bg-warning text-dark rounded-pill px-3">En cours</span>
                            @endif
                        </div>
                        
                        @if($stage->rapport_path)
                            <a href="{{ asset('storage/'.$stage->rapport_path) }}" target="_blank" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-file-pdf me-1"></i> Voir le Rapport
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            @if($stage->note_finale || $stage->note_encadrant)
            <div class="card shadow-sm border-success mt-4">
                <div class="card-header bg-success text-white py-2 px-4">
                    <h6 class="mb-0">Résultats & Évaluation</h6>
                </div>
                <div class="card-body p-0">
                    <div class="row g-0 text-center py-3">
                        <div class="col border-end">
                            <small class="text-muted d-block text-uppercase" style="font-size:0.7rem;">Encadrant</small>
                            <strong class="fs-5">{{ $stage->note_encadrant ?? '--' }}</strong>
                        </div>
                        <div class="col border-end">
                            <small class="text-muted d-block text-uppercase" style="font-size:0.7rem;">Rapporteur</small>
                            <strong class="fs-5">{{ $stage->note_rapporteur ?? '--' }}</strong>
                        </div>
                        <div class="col border-end">
                            <small class="text-muted d-block text-uppercase" style="font-size:0.7rem;">Examinateur</small>
                            <strong class="fs-5">{{ $stage->note_examinateur ?? '--' }}</strong>
                        </div>
                        <div class="col bg-success bg-opacity-10">
                            <small class="text-success fw-bold d-block text-uppercase" style="font-size:0.7rem;">Moyenne</small>
                            <strong class="fs-4 text-success">{{ $stage->note_finale ?? '--' }} <span class="fs-6">/ 20</span></strong>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="col-lg-3 col-12">
            
            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light fw-bold border-bottom">
                    <i class="fas fa-user-graduate me-2"></i> Étudiant
                </div>
                <div class="card-body">
                    <h5 class="fw-bold mb-1">{{ $stage->etudiant->user->name }}</h5>
                    <p class="text-muted mb-1">Filière : {{ $stage->etudiant->filiere }}</p>
                    <small class="text-primary">{{ $stage->etudiant->user->email }}</small>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-3">
                <div class="card-header bg-light fw-bold border-bottom">
                    <i class="fas fa-users me-2"></i> Jury & Encadrement
                </div>
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-3 py-2">
                        <small class="text-muted d-block">Encadrant</small>
                        <strong>{{ $stage->encadrant->user->name }}</strong>
                    </div>
                    <div class="list-group-item px-3 py-2">
                        <small class="text-muted d-block">Rapporteur</small>
                        <span>{{ $stage->rapporteur ? $stage->rapporteur->user->name : 'Non assigné' }}</span>
                    </div>
                    <div class="list-group-item px-3 py-2">
                        <small class="text-muted d-block">Examinateur</small>
                        <span>{{ $stage->examinateur ? $stage->examinateur->user->name : 'Non assigné' }}</span>
                    </div>
                </div>
            </div>

            @if($stage->soutenance)
            <div class="card shadow-sm border-warning bg-warning bg-opacity-10">
                <div class="card-body">
                    <h6 class="text-warning fw-bold mb-3"><i class="fas fa-calendar-alt me-2"></i> Soutenance</h6>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2"><strong>Date :</strong> {{ $stage->soutenance->date_soutenance }}</li>
                        <li class="mb-2"><strong>Heure :</strong> {{ $stage->soutenance->heure_soutenance }}</li>
                        <li><strong>Salle :</strong> {{ $stage->soutenance->salle }}</li>
                    </ul>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>

@endsection
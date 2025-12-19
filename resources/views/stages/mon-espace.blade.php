@extends('layout')

@section('content')

<h2 class="mb-4 text-dark fw-bold">Mon Espace Étudiant</h2>

@if(!$stage)
    <div class="alert alert-info shadow-sm">
        <i class="fas fa-info-circle me-2"></i> Vous n'avez pas encore de sujet de PFE affecté.
    </div>
@else

    <div class="row g-4">
        <div class="col-md-8">
            <div class="card h-100">
                <div class="card-header bg-white fw-bold py-3 border-bottom">
                    <i class="fas fa-book-open me-2 text-primary"></i>Détails du Sujet
                </div>
                <div class="card-body">
                    <h3 class="card-title text-primary fw-bold mb-3">{{ $stage->titre }}</h3>
                    <p class="card-text text-muted">{{ $stage->description }}</p>
                    
                    <hr class="my-4">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Statut :</strong> 
                            @if($stage->statut == 'valide')
                                <span class="badge bg-success">Validé</span>
                            @elseif($stage->statut == 'refuse')
                                <span class="badge bg-danger">Refusé</span>
                            @else
                                <span class="badge bg-warning text-dark">En attente</span>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>Encadrant :</strong> 
                            <span class="text-dark fw-bold">
                                {{ $stage->encadrant->user->name ?? 'Non assigné' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            
            <div class="card mb-4">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="fas fa-calendar-alt me-2 text-warning"></i>Soutenance
                </div>
                <div class="card-body text-center">
                    @if($stage->soutenance)
                        <h2 class="text-primary fw-bold display-4">
                            {{ \Carbon\Carbon::parse($stage->soutenance->date_soutenance)->format('d') }}
                        </h2>
                        <h5 class="text-uppercase text-muted mb-3">
                            {{ \Carbon\Carbon::parse($stage->soutenance->date_soutenance)->translatedFormat('F Y') }}
                        </h5>
                        <div class="badge bg-light text-dark border p-2">
                            <i class="far fa-clock me-1"></i> {{ $stage->soutenance->heure_soutenance }} 
                            | Salle {{ $stage->soutenance->salle }}
                        </div>
                    @else
                        <p class="text-muted mb-0 py-3">Pas encore planifiée.</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-white fw-bold py-3">
                    <i class="fas fa-file-pdf me-2 text-danger"></i>Mon Rapport
                </div>
                <div class="card-body">
                    @if($stage->rapport_path)
                        <div class="alert alert-success d-flex align-items-center mb-0">
                            <i class="fas fa-check-circle fa-2x me-3"></i>
                            <div>
                                <strong>Rapport envoyé !</strong><br>
                                <a href="#" class="text-decoration-none small">Voir le fichier</a>
                            </div>
                        </div>
                    @else
                        <form action="{{ route('stages.upload', $stage->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label small text-muted">Fichier PDF (Max 10Mo)</label>
                                <input type="file" name="rapport" class="form-control" accept=".pdf" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-cloud-upload-alt me-2"></i>Envoyer
                            </button>
                        </form>
                    @endif
                </div>
            </div>

        </div>
    </div>
@endif

@endsection
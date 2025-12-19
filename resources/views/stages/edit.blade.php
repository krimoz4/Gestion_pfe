@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Modifier le stage</h4>
            </div>
            <div class="card-body">
                
                <form action="{{ route('stages.update', $stage->id) }}" method="POST">
                    @csrf
                    @method('PUT') <div class="mb-3">
                        <label class="form-label">Titre du sujet</label>
                        <input type="text" name="titre" class="form-control" value="{{ $stage->titre }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="4">{{ $stage->description }}</textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Étudiant</label>
                            <select name="etudiant_id" class="form-select">
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}" {{ $stage->etudiant_id == $etudiant->id ? 'selected' : '' }}>
                                        {{ $etudiant->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Encadrant</label>
                            <select name="encadrant_id" class="form-select">
                                @foreach($profs as $prof)
                                    <option value="{{ $prof->id }}" {{ $stage->encadrant_id == $prof->id ? 'selected' : '' }}>
                                        {{ $prof->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-info">Rapporteur</label>
                                 <select name="rapporteur_id" class="form-select">
                                      <option value="">-- Aucun rapporteur pour l'instant --</option>
        
                                        @foreach($profs as $prof)
                                           @if($stage->encadrant_id !== $prof->id) 
                                                <option value="{{ $prof->id }}" {{ $stage->rapporteur_id == $prof->id ? 'selected' : '' }}>
                                                     {{ $prof->user->name }} ({{ $prof->departement }})
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Examinateur</label>
                            <select name="examinateur_id" class="form-select">
                                <option value="">-- Aucun pour l'instant --</option>
                                      @foreach($profs as $prof)
                                         @if($stage->encadrant_id !== $prof->id)
                                    <option value="{{ $prof->id }}" {{ $stage->examinateur_id == $prof->id ? 'selected' : '' }}>
                                         {{ $prof->user->name }} ({{ $prof->departement }})
                                    </option>
                                        @endif
                                     @endforeach
        </select>
    </div>
</div>

                    <div class="mb-3">
                        <label class="form-label">Statut</label>
                        <select name="statut" class="form-select">
                            <option value="en_cours" {{ $stage->statut == 'en_cours' ? 'selected' : '' }}>En cours</option>
                            <option value="valide" {{ $stage->statut == 'valide' ? 'selected' : '' }}>Validé</option>
                            <option value="refuse" {{ $stage->statut == 'refuse' ? 'selected' : '' }}>Refusé</option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('stages.index') }}" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-warning">Mettre à jour</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
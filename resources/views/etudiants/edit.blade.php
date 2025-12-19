@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-warning text-dark">
                <h4 class="mb-0">Modifier l'Étudiant : {{ $etudiant->user->name }}</h4>
            </div>
            <div class="card-body">
                
                <form action="{{ route('etudiants.update', $etudiant->id) }}" method="POST">
                    @csrf
                    @method('PUT') <h5 class="text-muted mb-3">Informations Générales</h5>
                    <div class="mb-3">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="name" class="form-control" value="{{ $etudiant->user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $etudiant->user->email }}" required>
                    </div>

                    <hr>

                    <h5 class="text-muted mb-3">Dossier Scolaire</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">CNE</label>
                            <input type="text" name="cne" class="form-control" value="{{ $etudiant->cne }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Filière</label>
                            <input type="text" name="filiere" class="form-control" value="{{ $etudiant->filiere }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Niveau</label>
                            <select name="niveau" class="form-select">
                                <option value="4IIR" {{ $etudiant->niveau == '4IIR' ? 'selected' : '' }}>4IIR</option>
                                <option value="5IIR" {{ $etudiant->niveau == '5IIR' ? 'selected' : '' }}>5IIR</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
                        <button type="submit" class="btn btn-warning">Mettre à jour</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Déposer un nouveau sujet de stage</h4>
            </div>
            <div class="card-body p-5">
                
                <form action="{{ route('stages.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="form-label fw-bold">Titre du sujet</label>
                        <input type="text" name="titre" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Description détaillée</label>
                        <textarea name="description" class="form-control" rows="5"></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Étudiant concerné</label>
                            <select name="etudiant_id" class="form-select">
                                <option value="" selected disabled>Choisir un étudiant...</option>
                                @foreach($etudiants as $etudiant)
                                    <option value="{{ $etudiant->id }}">{{ $etudiant->user->name }} ({{ $etudiant->filiere }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Encadrant souhaité</label>
                            <select name="encadrant_id" class="form-select">
                                <option value="" selected disabled>Choisir un prof...</option>
                                @foreach($profs as $prof)
                                    <option value="{{ $prof->id }}">{{ $prof->user->name }} ({{ $prof->departement }})</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Enregistrer le Sujet</button>
                        <a href="{{ route('stages.index') }}" class="btn btn-link text-muted">Annuler</a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@endsection
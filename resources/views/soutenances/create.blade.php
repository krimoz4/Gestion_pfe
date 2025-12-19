@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Nouvelle Soutenance</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('soutenances.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-bold">Choisir un Stage (Validé)</label>
                        <select name="stage_id" class="form-select" required>
                            <option value="" disabled selected>-- Sélectionner --</option>
                            @foreach($stages as $stage)
                                <option value="{{ $stage->id }}">
                                    {{ $stage->etudiant->user->name }} - "{{ Str::limit($stage->titre, 40) }}"
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Seuls les stages validés sans date apparaissent ici.</small>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Date</label>
                            <input type="date" name="date_soutenance" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Heure</label>
                            <input type="time" name="heure_soutenance" class="form-control" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Salle / Lieu</label>
                        <input type="text" name="salle" class="form-control" placeholder="Ex: Salle B12 ou Amphithéâtre" required>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success">Enregistrer le Planning</button>
                        <a href="{{ route('soutenances.index') }}" class="btn btn-light">Annuler</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
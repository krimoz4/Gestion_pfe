@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-header bg-white py-3">
                <h4 class="mb-0 text-primary">Ajouter un Professeur</h4>
            </div>
            <div class="card-body p-4">
                
                <form action="{{ route('professeurs.store') }}" method="POST">
                    @csrf

                    <h5 class="text-muted mb-3">Informations de Connexion</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom Complet</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <hr>

                    <h5 class="text-muted mb-3">Informations Académiques</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Département</label>
                            <select name="departement" class="form-select">
                                <option value="Informatique">Informatique</option>
                                <option value="Industriel">Génie Industriel</option>
                                <option value="Reseaux">Réseaux & Télécoms</option>
                                <option value="Management">Management</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Spécialité</label>
                            <input type="text" name="specialite" class="form-control" placeholder="Ex: IA, Java..." required>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('professeurs.index') }}" class="btn btn-light">Annuler</a>
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@endsection
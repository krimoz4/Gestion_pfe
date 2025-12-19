@extends('layout')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h3 class="mb-0 text-primary">Ajouter un nouvel Étudiant</h3>
            </div>
            <div class="card-body">
                
                <form action="{{ route('etudiants.store') }}" method="POST">
                    @csrf

                    <h5 class="text-secondary mb-3"><i class="fas fa-user-lock"></i> Informations de connexion</h5>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Nom complet</label>
                            <input type="text" name="name" class="form-control" placeholder="Ex: Akram Ouddir" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="akram@emsi-edu.ma" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <hr>

                    <h5 class="text-secondary mb-3"><i class="fas fa-graduation-cap"></i> Dossier Scolaire</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label">CNE</label>
                            <input type="text" name="cne" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Filière</label>
                            <input type="text" name="filiere" class="form-control" placeholder="Ex: IIR" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Niveau</label>
                            <select name="niveau" class="form-select">
                                <option value="4IIR">4ème Année</option>
                                <option value="5IIR">5ème Année</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary me-md-2">Annuler</a>
                        <button type="submit" class="btn btn-primary px-4">Enregistrer l'étudiant</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

@endsection
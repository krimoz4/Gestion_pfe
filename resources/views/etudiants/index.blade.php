@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gestion des Étudiants</h1>
    <a href="{{ route('etudiants.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> Nouvel Étudiant
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-primary">Liste des Étudiants inscrits</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>CNE</th>
                        <th>Nom Complet</th>
                        <th>Email</th>
                        <th>Filière</th>
                        <th>Niveau</th>
                        <th class="text-center" style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($etudiants as $etudiant)
                    <tr>
                        <td class="fw-bold text-dark">{{ $etudiant->cne }}</td>
                        
                        <td>{{ $etudiant->user->name }}</td>
                        <td>{{ $etudiant->user->email }}</td>
                        
                        <td>{{ $etudiant->filiere }}</td>
                        
                        <td>
                            <span class="badge bg-info text-dark">{{ $etudiant->niveau }}</span>
                        </td>
                        
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="{{ route('etudiants.edit', $etudiant->id) }}" class="btn btn-sm btn-warning text-white" title="Modifier">
    <i class="fas fa-edit"></i>
</a>

                                <form action="{{ route('etudiants.destroy', $etudiant->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet étudiant ?');" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Supprimer">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            <i class="fas fa-user-graduate fa-2x mb-3"></i><br>
                            Aucun étudiant enregistré pour le moment.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
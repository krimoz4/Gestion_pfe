@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Gestion des Professeurs</h1>
    <a href="{{ route('professeurs.create') }}" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus"></i> Nouveau Professeur
    </a>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Liste des Enseignants</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Département</th>
                        <th>Spécialité</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($professeurs as $prof)
                    <tr>
                        <td class="fw-bold">{{ $prof->user->name }}</td>
                        <td>{{ $prof->user->email }}</td>
                        <td><span class="badge bg-secondary">{{ $prof->departement }}</span></td>
                        <td>{{ $prof->specialite }}</td>
                        <td class="text-center">
                            <form action="{{ route('professeurs.destroy', $prof->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?');" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">Aucun professeur enregistré.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
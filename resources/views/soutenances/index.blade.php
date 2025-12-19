@extends('layout')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-dark fw-bold"><i class="fas fa-calendar-alt text-primary"></i> Planning des Soutenances</h2>
    
    @if(Auth::user()->role === 'admin')
        <a href="{{ route('soutenances.create') }}" class="btn btn-primary shadow">
            <i class="fas fa-plus"></i> Planifier une date
        </a>
    @endif
</div>

<div class="card shadow border-0">
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0 align-middle">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Date & Heure</th>
                    <th>Salle</th>
                    <th>Étudiant</th>
                    <th>Sujet</th>
                    <th>Jury</th>
                    @if(Auth::user()->role === 'admin')
                        <th class="text-end">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($soutenances as $sout)
                <tr>
                    <td>
                        <div class="fw-bold">{{ \Carbon\Carbon::parse($sout->date_soutenance)->format('d/m/Y') }}</div>
                        <div class="text-muted small"><i class="far fa-clock"></i> {{ $sout->heure_soutenance }}</div>
                    </td>
                    
                    <td><span class="badge bg-warning text-dark">{{ $sout->salle }}</span></td>
                    
                    <td>
                        <div class="fw-bold">{{ $sout->stage->etudiant->user->name }}</div>
                        <small class="text-muted">{{ $sout->stage->etudiant->filiere }}</small>
                    </td>
                    
                    <td>{{ Str::limit($sout->stage->titre, 30) }}</td>

                    <td>
                        <small class="d-block">Enc: {{ $sout->stage->encadrant->user->name }}</small>
                        @if($sout->stage->rapporteur)
                            <small class="d-block text-info">Rap: {{ $sout->stage->rapporteur->user->name }}</small>
                        @endif
                    </td>

                    @if(Auth::user()->role === 'admin')
                    <td class="text-end">
                        <form action="{{ route('soutenances.destroy', $sout->id) }}" method="POST" onsubmit="return confirm('Annuler cette soutenance ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">Aucune soutenance programmée pour le moment.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
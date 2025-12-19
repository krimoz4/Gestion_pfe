@extends('layout')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3>Fiche d'évaluation : {{ $stage->titre }}</h3>
        </div>
        <div class="card-body">
            
            <form action="{{ route('stages.storeNote', $stage->id) }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header fw-bold">Note Encadrant</div>
                            <div class="card-body">
                                <label>Prof. {{ $stage->encadrant->user->name }}</label>
                                <input type="number" step="0.25" name="note_encadrant" class="form-control" 
                                    value="{{ $stage->note_encadrant }}"
                                    {{ (auth()->user()->role == 'admin' || auth()->user()->id == $stage->encadrant->user_id) ? '' : 'disabled' }}>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header fw-bold">Note Rapporteur</div>
                            <div class="card-body">
                                <label>
                                    {{ $stage->rapporteur ? 'Prof. '.$stage->rapporteur->user->name : 'Non assigné' }}
                                </label>
                                <input type="number" step="0.25" name="note_rapporteur" class="form-control" 
                                    value="{{ $stage->note_rapporteur }}"
                                    {{ (auth()->user()->role == 'admin' || (auth()->user()->professeur && auth()->user()->professeur->id == $stage->rapporteur_id)) ? '' : 'disabled' }}>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-light mb-3">
                            <div class="card-header fw-bold">Note Examinateur</div>
                            <div class="card-body">
                                <label>
                                    {{ $stage->examinateur ? 'Prof. '.$stage->examinateur->user->name : 'Non assigné' }}
                                </label>
                                <input type="number" step="0.25" name="note_examinateur" class="form-control" 
                                    value="{{ $stage->note_examinateur }}"
                                    {{ (auth()->user()->role == 'admin' || (auth()->user()->professeur && auth()->user()->professeur->id == $stage->examinateur_id)) ? '' : 'disabled' }}>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-3 text-center">
                    <h5>Note Finale Actuelle : 
                        <strong>{{ $stage->note_finale ?? '--' }} / 20</strong>
                    </h5>
                    <small>La note finale sera recalculée à l'enregistrement.</small>
                </div>

                <button type="submit" class="btn btn-success w-100 btn-lg">Enregistrer les notes</button>
            </form>

        </div>
    </div>
</div>
@endsection
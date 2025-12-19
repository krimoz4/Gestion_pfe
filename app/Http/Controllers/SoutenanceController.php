<?php

namespace App\Http\Controllers;

use App\Models\Soutenance;
use App\Models\Stage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SoutenanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $soutenances = Soutenance::with(['stage.etudiant.user', 'stage.encadrant.user'])->get();
        }

        elseif ($user->role === 'prof') {
            $profId = $user->professeur->id;
            $soutenances = Soutenance::whereHas('stage', function($query) use ($profId) {
                $query->where('encadrant_id', $profId)
                      ->orWhere('rapporteur_id', $profId)
                      ->orWhere('examinateur_id', $profId);
            })->with(['stage.etudiant.user'])->get();
        } 
    
        else {
            return redirect()->route('etudiant.dashboard');
        }

        return view('soutenances.index', compact('soutenances'));
    }

    public function create()
    {
        $stages = Stage::where('statut', 'valide')
                       ->doesntHave('soutenance')
                       ->with('etudiant.user')
                       ->get();

        return view('soutenances.create', compact('stages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'stage_id' => 'required|unique:soutenances,stage_id',
            'date_soutenance' => 'required|date|after:today',
            'heure_soutenance' => 'required',
            'salle' => 'required|string|max:50',
        ]);

        Soutenance::create($request->all());

        return redirect()->route('soutenances.index')->with('success', 'Soutenance planifiée avec succès !');
    }

    public function destroy($id)
    {
        Soutenance::findOrFail($id)->delete();
        return back()->with('success', 'Soutenance annulée.');
    }
}
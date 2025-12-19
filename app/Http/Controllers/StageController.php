<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Etudiant; 
use App\Models\Professeur; 
use Illuminate\Http\Request;

class StageController extends Controller
{

    public function index()
    {
        $stages = Stage::with('etudiant.user', 'encadrant.user')->get();

        return view('stages.index', compact('stages')); 
    }

    public function create()
    {

        $etudiants = Etudiant::with('user')->get();
        $profs = Professeur::with('user')->get();
        
        return view('stages.create', compact('etudiants', 'profs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required',
            'description' => 'required',
            'etudiant_id' => 'required',
            'encadrant_id' => 'required',
        ]);

        Stage::create($request->all());

        return redirect()->route('stages.index')->with('success', 'Stage créé avec succès');
    }
    public function monEspace()
    {
        $etudiant = \App\Models\Etudiant::where('user_id', auth()->id())->first();

        $stage = \App\Models\Stage::where('etudiant_id', $etudiant->id)
                    ->with(['encadrant.user', 'rapporteur.user'])
                    ->first();

        return view('stages.mon-espace', compact('stage', 'etudiant'));
    }

    public function profDashboard()
    {
        $user = auth()->user();
        if ($user->role === 'prof') {
            $profId = $user->professeur->id;

            $stagesEncadres = Stage::where('encadrant_id', $profId)->with('etudiant.user')->get();
            
            $stagesRapporteur = Stage::where('rapporteur_id', $profId)->with('etudiant.user')->get();

            return view('stages.prof-dashboard', compact('stagesEncadres', 'stagesRapporteur'));
        }
        $stages = Stage::with(['etudiant.user', 'encadrant.user'])->get();
        return view('stages.index', compact('stages'));
    }
    public function uploadRapport(Request $request, $id)
{
    $request->validate(['rapport' => 'required|mimes:pdf|max:10000']);
    
    $stage = Stage::findOrFail($id);
    $path = $request->file('rapport')->store('rapports', 'public');

    $stage->rapport_path = $path;
    $stage->statut = 'depose';
    $stage->save();

    return back()->with('success', 'Rapport envoyé avec succès !');
}

   public function edit($id)
{
    $stage = Stage::findOrFail($id);
    $etudiants = \App\Models\Etudiant::with('user')->get();
    $profs = \App\Models\Professeur::with('user')->get();
    
    return view('stages.edit', compact('stage', 'etudiants', 'profs'));
}
    
    public function update(Request $request, $id)
{
    $request->validate([
        'titre' => 'required',
        'description' => 'required',
        'encadrant_id' => 'required|exists:professeurs,id',
        'rapporteur_id' => 'nullable|exists:professeurs,id|different:encadrant_id',
        'examinateur_id' => 'nullable|exists:professeurs,id|different:encadrant_id|different:rapporteur_id',
        'statut' => 'required'
    ]);

    $stage = Stage::findOrFail($id);

    $stage->update($request->all());

    return redirect()->route('stages.index')
                     ->with('success', 'Jury assigné avec succès !');
}

    public function notation($id)
{
    $stage = Stage::with(['etudiant.user', 'entreprise'])->findOrFail($id);
    return view('stages.notation', compact('stage'));
}

public function storeNote(Request $request, $id)
{
    $stage = Stage::findOrFail($id);

    if($request->has('note_encadrant')) $stage->note_encadrant = $request->note_encadrant;
    if($request->has('note_rapporteur')) $stage->note_rapporteur = $request->note_rapporteur;
    if($request->has('note_examinateur')) $stage->note_examinateur = $request->note_examinateur;

    if($stage->note_encadrant && $stage->note_rapporteur && $stage->note_examinateur) {
        $moyenne = ($stage->note_encadrant * 0.4) + 
                   ($stage->note_rapporteur * 0.3) + 
                   ($stage->note_examinateur * 0.3);
        
        $stage->note_finale = round($moyenne, 2);
    }

    $stage->save();

    return back()->with('success', 'Notes enregistrées et moyenne mise à jour !');
}

    public function show($id)
    {
        $stage = Stage::with([
            'etudiant.user', 
            'encadrant.user', 
            'rapporteur.user', 
            'examinateur.user', 
            'soutenance'
        ])->findOrFail($id);

        return view('stages.show', compact('stage'));
    }

}

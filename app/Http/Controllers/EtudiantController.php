<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class EtudiantController extends Controller
{
    public function index()
{
    $etudiants = Etudiant::with('user')->get();
    return view('etudiants.index', compact('etudiants'));
}

    public function create()
    {
        return view('etudiants.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'cne' => 'required|unique:etudiants',
            'filiere' => 'required',
            'niveau' => 'required'
        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'etudiant'
        ]);

  
        Etudiant::create([
            'user_id' => $user->id, 
            'cne' => $request->cne,
            'filiere' => $request->filiere,
            'niveau' => $request->niveau
        ]);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès');
    }
    public function destroy($id)
{
    $etudiant = Etudiant::findOrFail($id);
    $etudiant->user->delete();

    return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès');
}

    public function edit($id)
    {
        $etudiant = Etudiant::with('user')->findOrFail($id);
        return view('etudiants.edit', compact('etudiant'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email', 
            'cne' => 'required|string',
            'filiere' => 'required|string',
            'niveau' => 'required|string'
        ]);

        $etudiant = Etudiant::findOrFail($id);


        $etudiant->user->update([
            'name' => $request->name,
            'email' => $request->email,

        ]);

        $etudiant->update([
            'cne' => $request->cne,
            'filiere' => $request->filiere,
            'niveau' => $request->niveau
        ]);

        return redirect()->route('etudiants.index')
                         ->with('success', 'Informations modifiées avec succès !');
    }
}


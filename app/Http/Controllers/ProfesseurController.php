<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Professeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = Professeur::with('user')->get();
        return view('professeurs.index', compact('professeurs'));
    }


    public function create()
    {
        return view('professeurs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'departement' => 'required',
            'specialite' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'prof'
        ]);

        Professeur::create([
            'user_id' => $user->id,
            'departement' => $request->departement,
            'specialite' => $request->specialite
        ]);

        return redirect()->route('professeurs.index')
                         ->with('success', 'Professeur ajouté avec succès');
    }

    public function destroy($id)
    {
        $prof = Professeur::findOrFail($id);
        $prof->user->delete();

        return redirect()->route('professeurs.index')
                         ->with('success', 'Professeur supprimé');
    }
}
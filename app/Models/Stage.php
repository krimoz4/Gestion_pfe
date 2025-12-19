<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    // 1. On autorise les nouveaux champs (si ce n'est pas déjà fait)
    protected $fillable = [
        'titre', 
        'description', 
        'statut', 
        'rapport_path',
        'etudiant_id', 
        'encadrant_id', 
        'entreprise_id',
        'rapporteur_id',
        'examinateur_id',
        'note_encadrant',
        'note_rapporteur',
        'note_examinateur',
        'note_finale'
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function encadrant()
    {
        return $this->belongsTo(Professeur::class, 'encadrant_id');
    }

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function soutenance()
    {
        return $this->hasOne(Soutenance::class);
    }

    public function rapporteur()
    {
        return $this->belongsTo(Professeur::class, 'rapporteur_id');
    }

    public function examinateur()
    {
        return $this->belongsTo(Professeur::class, 'examinateur_id');
    }

    
}
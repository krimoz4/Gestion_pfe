<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soutenance extends Model
{
    use HasFactory;

    // 1. Autoriser le remplissage de ces champs
    protected $fillable = [
        'stage_id',
        'date_soutenance',
        'heure_soutenance',
        'salle',
        'president_id',
        'examinateur_id'
    ];

    // --- RELATIONS ---

    // 2. Lien vers le Stage
    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    // 3. Lien vers le Président (C'est un Professeur)
    public function president()
    {
        return $this->belongsTo(Professeur::class, 'president_id');
    }

    // 4. Lien vers l'Examinateur (C'est aussi un Professeur)
    public function examinateur()
    {
        return $this->belongsTo(Professeur::class, 'examinateur_id');
    }
}
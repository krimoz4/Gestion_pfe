<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soutenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'stage_id',
        'date_soutenance',
        'heure_soutenance',
        'salle',
        'president_id',
        'examinateur_id'
    ];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function president()
    {
        return $this->belongsTo(Professeur::class, 'president_id');
    }

    public function examinateur()
    {
        return $this->belongsTo(Professeur::class, 'examinateur_id');
    }
}
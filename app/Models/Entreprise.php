<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    protected $fillable = ['nom', 'adresse', 'ville', 'telephone', 'email_contact'];

    public function stages()
    {
        return $this->hasMany(Stage::class);
    }
}

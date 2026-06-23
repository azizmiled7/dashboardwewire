<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    // 🔓 Champs autorisés pour les opérations en masse
    protected $fillable = [
        'nom',
        'numero_serie',
        'type',
        'etat',
        'date_acquisition',
    ];

    // 🕒 Formatage des dates si nécessaire (optionnel)
    protected $casts = [
        'date_acquisition' => 'date',
    ];
}


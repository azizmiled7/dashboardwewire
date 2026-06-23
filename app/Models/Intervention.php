<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
    protected $fillable = ['materiel_id', 'user_id', 'description', 'statut', 'priorite', 'technicien_id'];

    public function materiel()
    {
        return $this->belongsTo(Materiel::class);
    }

    public function technicien()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}


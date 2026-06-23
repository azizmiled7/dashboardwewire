<?php

namespace App\Http\Controllers;

use App\Models\Materiel;
use Illuminate\Http\Request;

class MaterielController extends Controller
{
    // 📋 Affiche la liste des matériels
    public function index()
    {
        $materiels = Materiel::orderBy('created_at', 'desc')->get();
        return view('list-mate', compact('materiels'));
    }

    // 🆕 Affiche le formulaire d'ajout
    public function create()
    {
        return view('add-mate');
    }

    // 💾 Enregistre un nouveau matériel
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255|unique:materiels,numero_serie',
            'type' => 'required|string|max:255',
            'etat' => 'required|in:Neuf,Bon,Endommagé,En réparation',
            'date_acquisition' => 'required|date',
        ]);

        Materiel::create([
            'nom' => $request->nom,
            'numero_serie' => $request->numero_serie,
            'type' => $request->type,
            'etat' => $request->etat,
            'date_acquisition' => $request->date_acquisition,
        ]);

        return redirect()->route('materiels.index')->with('success', 'Matériel ajouté avec succès.');
    }

    // 👁 Affiche les détails d'un matériel
    public function show(Materiel $materiel)
    {
        return view('materiels.show', compact('materiel'));
    }

    // ✏️ Affiche le formulaire de modification
    public function edit(Materiel $materiel)
    {
        return view('edit-mate', compact('materiel'));
    }

    // 🔄 Met à jour les données du matériel
    public function update(Request $request, Materiel $materiel)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'numero_serie' => 'required|string|max:255|unique:materiels,numero_serie,' . $materiel->id,
            'type' => 'required|string|max:255',
            'etat' => 'required|in:Neuf,Bon,Endommagé,En réparation',
            'date_acquisition' => 'required|date',
        ]);

        $materiel->update([
            'nom' => $request->nom,
            'numero_serie' => $request->numero_serie,
            'type' => $request->type,
            'etat' => $request->etat,
            'date_acquisition' => $request->date_acquisition,
        ]);

        return redirect()->route('materiels.index')->with('success', 'Matériel mis à jour avec succès.');
    }

    // 🗑 Supprime un matériel
    public function destroy(Materiel $materiel)
    {
        $materiel->delete();
        return redirect()->route('materiels.index')->with('success', 'Matériel supprimé avec succès.');
    }
}


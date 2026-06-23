<?php

namespace App\Http\Controllers;
use App\Models\Intervention;
use Illuminate\Http\Request;
use App\Models\Materiel;
use App\Models\User;
class InterventionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $interventions = Intervention::with(['technicien', 'materiel'])->get();
    $techniciens = User::where('role', 'technicien')->get(); // ⬅️ Ajoute cette ligne

    return view('admin-inter', compact('interventions', 'techniciens')); // ⬅️ Et passe $techniciens à ta vue
}



public function create()
{
    $materiels = Materiel::all();
    return view('create', compact('materiels'));
}



public function store(Request $request)
{
    $request->validate([
        'materiel_id' => 'required|exists:materiels,id',
        'description' => 'required|string|max:1000',
        'priorite'    => 'required|in:A - Urgente,B - Moyenne,C - Faible',
    ]);

    Intervention::create([
        'materiel_id' => $request->materiel_id,
        'user_id'     => auth()->id(),
        'description' => $request->description,
        'statut'      => 'Déclarée',
        'priorite'    => $request->priorite,
    ]);

    return redirect()->route('interventions.index')->with('success', 'Intervention déclarée avec succès.');
}



public function affecter(Request $request, $id)
{
    $intervention = Intervention::findOrFail($id);
    $intervention->technicien_id = $request->technicien_id;
    $intervention->save();

    // Tu peux aussi envoyer une notification ici

    return redirect()->back()->with('success', 'Technicien affecté avec succès.');
}


public function show(Intervention $intervention)
{
    return view('interventions.show', compact('intervention'));
}

public function affectationAdmin()
{
    $interventions = Intervention::with(['technicien', 'materiel'])->get();
    $techniciens = User::where('role', 'technicien')->get();
    return view('affectation', compact('interventions', 'techniciens'));
}
}

<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Intervention;
class UserController extends Controller
{
    // 🔍 Liste des techniciens
    public function indexTechniciens()
    {
$data = User::where('role', 'technicien')->get();
        return view('list-tech', compact('data'));
    }

    // 🧾 Formulaire d'ajout
    public function createTechnicien()
    {
        return view('add-tech');
    }

    // ➕ Enregistrement du technicien
    public function storeTechnicien(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'technicien',
        ]);

        return redirect()->route('users.techniciens.index')->with('success', 'Technicien ajouté avec succès');
    }

    // ✏️ Édition du technicien
    public function editTechnicien($id)
    {
        $user = User::findOrFail($id);
        return view('edit-tech', compact('user'));
    }

    // 🔄 Mise à jour
    public function updateTechnicien(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email'));

        return redirect()->route('users.techniciens.index')->with('success', 'Technicien modifié avec succès');
    }

    // ❌ Suppression
    public function destroyTechnicien($id)
    {
        User::destroy($id);
        return redirect()->route('users.techniciens.index')->with('success', 'Technicien supprimé');
    }

   public function affectationTechnicien()
{
    $interventions = Intervention::where('technicien_id', auth()->id())->get();
    return view('affectation', compact('interventions'));
}

}

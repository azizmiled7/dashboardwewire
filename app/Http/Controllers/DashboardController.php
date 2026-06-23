<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materiel;
use App\Models\Intervention;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        // Stats Techniciens
        $totalTechniciens = User::where('role', 'technicien')->count();

        // Stats Matériels
        $totalMateriels     = Materiel::count();
        $materielsNeuf      = Materiel::where('etat', 'Neuf')->count();
        $materielsBon       = Materiel::where('etat', 'Bon')->count();
        $materielsEndommage = Materiel::where('etat', 'Endommagé')->count();
        $materielsReparation= Materiel::where('etat', 'En réparation')->count();

        // Stats Interventions
        $totalInterventions   = Intervention::count();
        $interventionsDeclarees = Intervention::where('statut', 'Déclarée')->count();
        $interventionsEnCours   = Intervention::where('statut', 'En cours')->count();
        $interventionsResolues  = Intervention::where('statut', 'Résolue')->count();

        // Stats Priorités
        $prioriteUrgente = Intervention::where('priorite', 'A - Urgente')->count();
        $prioriteMoyenne = Intervention::where('priorite', 'B - Moyenne')->count();
        $prioriteFaible  = Intervention::where('priorite', 'C - Faible')->count();

        // 5 dernières interventions
        $recentInterventions = Intervention::with(['technicien', 'materiel'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Interventions par mois (12 derniers mois) pour graphique
        $interventionsParMois = Intervention::select(
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('YEAR(created_at) as annee'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', now()->year)
            ->groupBy('annee', 'mois')
            ->orderBy('mois')
            ->get()
            ->keyBy('mois');

        $chartLabels = [];
        $chartData   = [];
        $moisNoms = ['', 'Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun',
                     'Jul', 'Aoû', 'Sep', 'Oct', 'Nov', 'Déc'];
        for ($m = 1; $m <= 12; $m++) {
            $chartLabels[] = $moisNoms[$m];
            $chartData[]   = $interventionsParMois->has($m) ? $interventionsParMois[$m]->total : 0;
        }

        return view('dashboardadmin', compact(
            'totalTechniciens',
            'totalMateriels',
            'materielsNeuf',
            'materielsBon',
            'materielsEndommage',
            'materielsReparation',
            'totalInterventions',
            'interventionsDeclarees',
            'interventionsEnCours',
            'interventionsResolues',
            'prioriteUrgente',
            'prioriteMoyenne',
            'prioriteFaible',
            'recentInterventions',
            'chartLabels',
            'chartData'
        ));
    }

    public function technicien()
    {
        $user = auth()->user();

        // Interventions du technicien connecté
        $mesInterventions     = Intervention::where('technicien_id', $user->id)->count();
        $mesEnCours           = Intervention::where('technicien_id', $user->id)->where('statut', 'En cours')->count();
        $mesResolues          = Intervention::where('technicien_id', $user->id)->where('statut', 'Résolue')->count();
        $mesDeclarees         = Intervention::where('user_id', $user->id)->where('statut', 'Déclarée')->count();

        // 5 dernières interventions affectées à ce technicien
        $recentInterventions = Intervention::with(['materiel'])
            ->where('technicien_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Répartition par priorité pour ce technicien
        $prioriteUrgente = Intervention::where('technicien_id', $user->id)->where('priorite', 'A - Urgente')->count();
        $prioriteMoyenne = Intervention::where('technicien_id', $user->id)->where('priorite', 'B - Moyenne')->count();
        $prioriteFaible  = Intervention::where('technicien_id', $user->id)->where('priorite', 'C - Faible')->count();

        return view('dashboardtech', compact(
            'mesInterventions',
            'mesEnCours',
            'mesResolues',
            'mesDeclarees',
            'recentInterventions',
            'prioriteUrgente',
            'prioriteMoyenne',
            'prioriteFaible'
        ));
    }
}

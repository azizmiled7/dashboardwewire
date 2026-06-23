@extends('theme')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18" style="color:rgb(90,84,84)">MON TABLEAU DE BORD</h4>
                <small class="text-muted">Bienvenue, {{ auth()->user()->name }}</small>
            </div>
        </div>
    </div>

    {{-- ===== Stats du technicien ===== --}}
    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Mes Interventions</p>
                            <h4 class="mb-0">{{ $mesInterventions }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title"><i class="bx bx-wrench font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">En Cours</p>
                            <h4 class="mb-0">{{ $mesEnCours }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                <span class="avatar-title"><i class="bx bx-time font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Résolues</p>
                            <h4 class="mb-0">{{ $mesResolues }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                <span class="avatar-title"><i class="bx bx-check-circle font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Déclarées par moi</p>
                            <h4 class="mb-0">{{ $mesDeclarees }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                <span class="avatar-title"><i class="bx bx-bell font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== Graphique donut priorités + tableau ===== --}}
    <div class="row">

        {{-- Donut chart priorités --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Répartition par priorité</h4>
                    <div id="chart-priorite" style="height:260px;"></div>
                    <div class="d-flex justify-content-center gap-3 mt-2">
                        <span style="background:#f46a6a;color:#fff;padding:3px 10px;border-radius:4px;font-size:12px;">Urgente : {{ $prioriteUrgente }}</span>
                        <span style="background:#f1b44c;color:#fff;padding:3px 10px;border-radius:4px;font-size:12px;">Moyenne : {{ $prioriteMoyenne }}</span>
                        <span style="background:#34c38f;color:#fff;padding:3px 10px;border-radius:4px;font-size:12px;">Faible : {{ $prioriteFaible }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Dernières interventions affectées --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Mes dernières interventions affectées</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Matériel</th>
                                    <th>Description</th>
                                    <th>Priorité</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentInterventions as $i)
                                <tr>
                                    <td>{{ $i->materiel->nom ?? '—' }}</td>
                                    <td>{{ Str::limit($i->description, 40) }}</td>
                                    <td>
                                        @php
                                            $pbg = match($i->priorite ?? 'C - Faible') {
                                                'A - Urgente' => '#f46a6a',
                                                'B - Moyenne' => '#f1b44c',
                                                default       => '#34c38f',
                                            };
                                        @endphp
                                        <span style="background:{{ $pbg }};color:#fff;padding:3px 9px;border-radius:4px;font-size:11px;font-weight:600;">
                                            {{ $i->priorite ?? 'C - Faible' }}
                                        </span>
                                    </td>
                                    <td>
                                        @php
                                            $sbg = match($i->statut) {
                                                'En cours' => '#5b73e8',
                                                'Résolue'  => '#34c38f',
                                                default    => '#74788d',
                                            };
                                        @endphp
                                        <span style="background:{{ $sbg }};color:#fff;padding:3px 9px;border-radius:4px;font-size:11px;font-weight:600;">
                                            {{ $i->statut }}
                                        </span>
                                    </td>
                                    <td>{{ $i->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-3">Aucune intervention affectée pour le moment.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3">
                        <a href="{{ route('interventions.create') }}" class="btn btn-sm btn-warning">
                            <i class="bx bx-plus me-1"></i> Déclarer une intervention
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection

@section('script')
<script>
    var options = {
        series: [{{ $prioriteUrgente }}, {{ $prioriteMoyenne }}, {{ $prioriteFaible }}],
        chart: { type: 'donut', height: 260 },
        labels: ['Urgente', 'Moyenne', 'Faible'],
        colors: ['#f46a6a', '#f1b44c', '#34c38f'],
        legend: { position: 'bottom' },
        dataLabels: { enabled: true },
        plotOptions: {
            pie: { donut: { size: '60%' } }
        }
    };
    var chart = new ApexCharts(document.querySelector("#chart-priorite"), options);
    chart.render();
</script>
@endsection

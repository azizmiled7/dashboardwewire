@extends('theme')

@section('content')
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18" style="color:rgb(90,84,84)">DASHBOARD ADMIN</h4>
                <small class="text-muted">Bienvenue, {{ auth()->user()->name }}</small>
            </div>
        </div>
    </div>

    {{-- ===== ROW 1 : Stats principales ===== --}}
    <div class="row">

        {{-- Techniciens --}}
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Total Techniciens</p>
                            <h4 class="mb-0">{{ $totalTechniciens }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title"><i class="bx bx-group font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Matériels --}}
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Total Matériels</p>
                            <h4 class="mb-0">{{ $totalMateriels }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                <span class="avatar-title"><i class="bx bx-box font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Total Interventions --}}
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Total Interventions</p>
                            <h4 class="mb-0">{{ $totalInterventions }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                <span class="avatar-title"><i class="bx bx-wrench font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Interventions Résolues --}}
        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Interventions Résolues</p>
                            <h4 class="mb-0">{{ $interventionsResolues }}</h4>
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

    </div>

    {{-- ===== ROW 2 : État des matériels ===== --}}
    <div class="row">

        <div class="col-xl-3 col-md-6">
            <div class="card mini-stats-wid">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-muted fw-medium mb-2">Matériels Neuf</p>
                            <h4 class="mb-0">{{ $materielsNeuf }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                <span class="avatar-title"><i class="bx bx-gift font-size-24"></i></span>
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
                            <p class="text-muted fw-medium mb-2">Matériels Bon État</p>
                            <h4 class="mb-0">{{ $materielsBon }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                <span class="avatar-title"><i class="bx bx-star font-size-24"></i></span>
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
                            <p class="text-muted fw-medium mb-2">Matériels Endommagés</p>
                            <h4 class="mb-0">{{ $materielsEndommage }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-danger">
                                <span class="avatar-title"><i class="bx bx-bug font-size-24"></i></span>
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
                            <p class="text-muted fw-medium mb-2">En Réparation</p>
                            <h4 class="mb-0">{{ $materielsReparation }}</h4>
                        </div>
                        <div class="flex-shrink-0 align-self-center">
                            <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                <span class="avatar-title"><i class="bx bx-task font-size-24"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ===== ROW 3 : Graphique + Statuts interventions ===== --}}
    <div class="row">

        {{-- Graphique interventions par mois --}}
        <div class="col-xl-8">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Interventions par mois ({{ now()->year }})</h4>
                    <div id="chart-interventions" style="height:280px;"></div>
                </div>
            </div>
        </div>

        {{-- Statuts + Priorités --}}
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Statut des interventions</h4>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Déclarées</span>
                            <span class="fw-bold">{{ $interventionsDeclarees }}</span>
                        </div>
                        <div class="progress" style="height:6px;">
                            @php $pct = $totalInterventions > 0 ? round($interventionsDeclarees / $totalInterventions * 100) : 0; @endphp
                            <div class="progress-bar bg-secondary" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">En cours</span>
                            <span class="fw-bold">{{ $interventionsEnCours }}</span>
                        </div>
                        <div class="progress" style="height:6px;">
                            @php $pct = $totalInterventions > 0 ? round($interventionsEnCours / $totalInterventions * 100) : 0; @endphp
                            <div class="progress-bar bg-primary" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Résolues</span>
                            <span class="fw-bold">{{ $interventionsResolues }}</span>
                        </div>
                        <div class="progress" style="height:6px;">
                            @php $pct = $totalInterventions > 0 ? round($interventionsResolues / $totalInterventions * 100) : 0; @endphp
                            <div class="progress-bar bg-success" style="width:{{ $pct }}%"></div>
                        </div>
                    </div>

                    <h4 class="card-title mb-3">Priorités</h4>

                    <div class="d-flex gap-2 flex-wrap">
                        <span class="badge rounded-pill px-3 py-2" style="background:#f46a6a;font-size:12px;">
                            🔴 Urgente : {{ $prioriteUrgente }}
                        </span>
                        <span class="badge rounded-pill px-3 py-2" style="background:#f1b44c;font-size:12px;">
                            🟡 Moyenne : {{ $prioriteMoyenne }}
                        </span>
                        <span class="badge rounded-pill px-3 py-2" style="background:#34c38f;font-size:12px;">
                            🟢 Faible : {{ $prioriteFaible }}
                        </span>
                    </div>

                </div>
            </div>
        </div>

    </div>

    {{-- ===== ROW 4 : Dernières interventions ===== --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Dernières Interventions</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Technicien</th>
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
                                    <td>{{ $i->technicien->name ?? '—' }}</td>
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
                                    <td colspan="6" class="text-center text-muted py-3">Aucune intervention pour le moment.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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
        series: [{
            name: 'Interventions',
            data: {!! json_encode($chartData) !!}
        }],
        chart: {
            type: 'bar',
            height: 280,
            toolbar: { show: false }
        },
        plotOptions: {
            bar: { borderRadius: 4, columnWidth: '45%' }
        },
        colors: ['#5b73e8'],
        dataLabels: { enabled: false },
        xaxis: {
            categories: {!! json_encode($chartLabels) !!}
        },
        yaxis: {
            labels: { formatter: val => Math.round(val) },
            min: 0
        },
        grid: { borderColor: '#f1f1f1' },
        tooltip: { y: { formatter: val => val + ' intervention(s)' } }
    };

    var chart = new ApexCharts(document.querySelector("#chart-interventions"), options);
    chart.render();
</script>
@endsection

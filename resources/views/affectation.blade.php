@extends('theme')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18" style="color: rgb(90,84,84)">Liste des Interventions</h4>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Technicien</th>
                                    <th>Matériel</th>
                                    <th>Description</th>
                                    <th>Statut</th>
                                    <th>Priorité</th>
                                    <th>Affectation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($interventions as $i)
                                    <tr>
                                        <td>{{ $i->technicien->name ?? '—' }}</td>
                                        <td>{{ $i->materiel->nom ?? '—' }}</td>
                                        <td>{{ $i->description }}</td>

                                        {{-- Badge Statut --}}
                                        <td>
                                            @php
                                                $statutBg = match($i->statut) {
                                                    'En cours'  => '#5b73e8',
                                                    'Résolue'   => '#34c38f',
                                                    default     => '#74788d',
                                                };
                                            @endphp
                                            <span style="
                                                background:{{ $statutBg }};
                                                color:#fff;
                                                padding:4px 10px;
                                                border-radius:4px;
                                                font-size:12px;
                                                font-weight:600;
                                                white-space:nowrap;
                                            ">
                                                {{ $i->statut }}
                                            </span>
                                        </td>

                                        {{-- Badge Priorité --}}
                                        <td>
                                            @php
                                                $prioriteBg = match($i->priorite ?? 'C - Faible') {
                                                    'A - Urgente' => '#f46a6a',
                                                    'B - Moyenne' => '#f1b44c',
                                                    default       => '#34c38f',
                                                };
                                            @endphp
                                            <span style="
                                                background:{{ $prioriteBg }};
                                                color:#fff;
                                                padding:4px 10px;
                                                border-radius:4px;
                                                font-size:12px;
                                                font-weight:600;
                                                white-space:nowrap;
                                            ">
                                                {{ $i->priorite ?? 'C - Faible' }}
                                            </span>
                                        </td>

                                        {{-- Select + Bouton Affecter --}}
                                        <td>
                                            @if(auth()->user()->role === 'admin')
                                            <form action="{{ route('admin.affecter', $i->id) }}" method="POST" class="d-flex align-items-center gap-2">
                                                @csrf
                                                <select name="technicien_id" class="form-select form-select-sm" style="min-width:130px;" required>
                                                    <option value="" disabled {{ !$i->technicien_id ? 'selected' : '' }}>Choisir...</option>
                                                    @foreach($techniciens as $t)
                                                        <option value="{{ $t->id }}" {{ $i->technicien_id == $t->id ? 'selected' : '' }}>
                                                            {{ $t->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit"
                                                    class="btn btn-sm"
                                                    style="background:#5b73e8;color:#fff;white-space:nowrap;border:none;">
                                                    Affecter
                                                </button>
                                            </form>
                                            @else
                                                <span class="text-muted">{{ $i->technicien->name ?? '—' }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">Aucune intervention trouvée.</td>
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

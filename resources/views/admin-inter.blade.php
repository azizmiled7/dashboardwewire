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
                                        <td>
                                            @php
                                                $statutClass = match($i->statut) {
                                                    'En cours'  => 'background:#5b73e8;color:#fff;',
                                                    'Résolue'   => 'background:#34c38f;color:#fff;',
                                                    default     => 'background:#74788d;color:#fff;',
                                                };
                                            @endphp
                                            <span style="padding:3px 10px;border-radius:4px;font-size:12px;font-weight:600;{{ $statutClass }}">
                                                {{ $i->statut }}
                                            </span>
                                        </td>
                                        <td>
                                            @php
                                                $prioriteClass = match($i->priorite ?? 'C - Faible') {
                                                    'A - Urgente' => 'background:#f46a6a;color:#fff;',
                                                    'B - Moyenne' => 'background:#f1b44c;color:#fff;',
                                                    default       => 'background:#34c38f;color:#fff;',
                                                };
                                            @endphp
                                            <span style="padding:3px 10px;border-radius:4px;font-size:12px;font-weight:600;{{ $prioriteClass }}">
                                                {{ $i->priorite ?? 'C - Faible' }}
                                            </span>
                                        </td>
                                        <td>
                                            @if(auth()->user()->role === 'admin')
                                            <form action="{{ route('admin.affecter', $i->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                                @csrf
                                                <select name="technicien_id" class="form-select form-select-sm" style="min-width:130px;" required>
                                                    <option value="" disabled selected>Choisir...</option>
                                                    @foreach($techniciens as $t)
                                                        <option value="{{ $t->id }}" {{ $i->technicien_id == $t->id ? 'selected' : '' }}>
                                                            {{ $t->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="btn btn-primary btn-sm" style="white-space:nowrap;">Affecter</button>
                                            </form>
                                            @else
                                                {{ $i->technicien->name ?? '—' }}
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

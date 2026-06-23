@extends('theme')

@section('content')
    <h4 class="mb-sm-3 font-size-18">Mes Interventions</h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>Matériel</th>
                                <th>Description</th>
                                <th>Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($interventions as $i)
                                @if ($i->user_id === auth()->id())
                                    <tr>
                                        <td>{{ $i->materiel->nom }}</td>
                                        <td>{{ $i->description }}</td>
                                        <td>
                                            <span class="badge 
                                                @if($i->statut === 'En attente') bg-warning 
                                                @elseif($i->statut === 'Validée') bg-success 
                                                @else bg-secondary @endif">
                                                {{ $i->statut }}
                                            </span>
                                        </td>
                                    </tr>
                                @endif
                            @empty
                                <tr>
                                    <td colspan="3">Aucune intervention enregistrée</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

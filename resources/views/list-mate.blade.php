@extends('theme')

@section('content')
    <h4 class="mb-sm-3 font-size-18">Liste des matériels</h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- ✅ Message de succès --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- 📋 Vérification de la présence des matériels --}}
                    @if (isset($materiels) && $materiels->count())
                        <table id="datatable-materiels" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Numéro de Série</th>
                                    <th>Type</th>
                                    <th>État</th>
                                    <th>Date d'Acquisition</th>
                                                                                    @if (auth()->user()->role === 'admin')

                                    <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($materiels as $materiel)
                                    <tr>
                                        <td>{{ $materiel->nom }}</td>
                                        <td>{{ $materiel->numero_serie }}</td>
                                        <td>{{ $materiel->type }}</td>
                                        <td>{{ $materiel->etat }}</td>
                                        <td>{{ \Carbon\Carbon::parse($materiel->date_acquisition)->format('d/m/Y') }}</td>
                                                                                        @if (auth()->user()->role === 'admin')

                                        <td>

                                            <a href="{{ route('materiels.edit', $materiel->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                            <form action="{{ route('materiels.destroy', $materiel->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- ✅ Lien vers le formulaire d’ajout --}}
                        <a href="{{ route('materiels.create') }}" class="btn btn-success mt-3">Ajouter un Matériel</a>
                    @else
                        {{-- 🔍 Aucune donnée --}}
                        <div class="alert alert-info">Aucun matériel enregistré.</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection

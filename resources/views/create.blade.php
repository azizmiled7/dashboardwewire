@extends('theme')

@section('content')
    <h4 class="mb-sm-3 font-size-18">Déclarer une Intervention</h4>

    <form method="POST" action="{{ route('interventions.store') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- Sélection du matériel --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Matériel concerné</label>
                            <div class="col-md-10">
                                <select name="materiel_id" class="form-control" required>
    @foreach($materiels as $materiel)
        <option value="{{ $materiel->id }}">{{ $materiel->nom }}</option>
    @endforeach
</select>
                            </div>
                        </div>

                        {{-- Description du problème --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea name="description" class="form-control" placeholder="Décrivez le problème rencontré..." required></textarea>
                            </div>
                        </div>

                        {{-- Priorité --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Priorité</label>
                            <div class="col-md-10">
                                <select name="priorite" class="form-control" required>
                                    <option value="A - Urgente">A - Urgente</option>
                                    <option value="B - Moyenne">B - Moyenne</option>
                                    <option value="C - Faible" selected>C - Faible</option>
                                </select>
                            </div>
                        </div>

                        {{-- Bouton d'envoi --}}
                        <button type="submit" class="btn btn-warning">Déclarer l'intervention</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

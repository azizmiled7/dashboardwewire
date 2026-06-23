@extends('theme') {{-- Ou votre layout principal comme 'layouts.app' --}}

@section('content')
<div class="container mx-auto px-4 py-8">
    <h4 class="mb-sm-3 font-size-18">Ajouter un Nouveau Matériel</h4>

    {{-- Afficher les erreurs de validation --}}
    @if ($errors->any())
        <div class="alert alert-danger" role="alert"> {{-- Utilisation d'une classe Bootstrap/Tailwind standard --}}
            <strong class="font-bold">Erreur(s) de validation :</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('materiels.store') }}"> {{-- CHANGÉ: Pointe vers la route de store des matériels --}}
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="nom-input" class="col-md-2 col-form-label">Nom du Matériel</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="nom" {{-- name="nom" pour le matériel --}}
                                    placeholder="Nom du matériel" id="nom-input" value="{{ old('nom') }}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="numero_serie-input" class="col-md-2 col-form-label">Numéro de Série</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="numero_serie" {{-- name="numero_serie" pour le matériel --}}
                                    placeholder="Numéro de série" id="numero_serie-input" value="{{ old('numero_serie') }}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="type-input" class="col-md-2 col-form-label">Type</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="type" {{-- name="type" pour le matériel --}}
                                    placeholder="Type (ex: Laptop, Écran, Souris)" id="type-input" value="{{ old('type') }}" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="etat-input" class="col-md-2 col-form-label">État</label>
                            <div class="col-md-10">
                                <select class="form-select" name="etat" id="etat-input" required> {{-- Sélection d'état --}}
                                    <option value="">Sélectionner l'état</option>
                                    <option value="Neuf" {{ old('etat') == 'Neuf' ? 'selected' : '' }}>Neuf</option>
                                    <option value="Bon" {{ old('etat') == 'Bon' ? 'selected' : '' }}>Bon état</option>
                                    <option value="Endommagé" {{ old('etat') == 'Endommagé' ? 'selected' : '' }}>Endommagé</option>
                                    <option value="En réparation" {{ old('etat') == 'En réparation' ? 'selected' : '' }}>En réparation</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="date_acquisition-input" class="col-md-2 col-form-label">Date d'Acquisition</label>
                            <div class="col-md-10">
                                <input class="form-control" type="date" name="date_acquisition" {{-- Type date pour la date --}}
                                    id="date_acquisition-input" value="{{ old('date_acquisition') }}" required>
                            </div>
                        </div>
                        
                        {{-- CHAMP POUR LE TECHNICIEN ATTRIBUÉ (si vous avez la clé étrangère) --}}
                        

                        <button type="submit" class="btn btn-primary">Ajouter le Matériel</button> {{-- Texte du bouton --}}
                        <a href="{{ route('materiels.index') }}" class="btn btn-secondary ms-2">Annuler</a> {{-- CHANGÉ: Retourne à la liste des matériels --}}
                    </div>
                </div>
            </div> 
        </div> {{-- Fermeture de la première div.row --}}
    </form>
</div>
@endsection
@extends('theme')

@section('content')
    <h4 class="mb-4">Modifier le matériel</h4>

    <div class="card">
        <div class="card-body">
            {{-- 🔍 Message de validation --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✏️ Formulaire pleine largeur --}}
            <form method="POST" action="{{ route('materiels.update', $materiel->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="nom">Nom :</label>
                    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom', $materiel->nom) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="numero_serie">Numéro de Série :</label>
                    <input type="text" name="numero_serie" id="numero_serie" class="form-control" value="{{ old('numero_serie', $materiel->numero_serie) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="type">Type :</label>
                    <input type="text" name="type" id="type" class="form-control" value="{{ old('type', $materiel->type) }}" required>
                </div>

                <div class="form-group mb-3">
                    <label for="etat">État :</label>
                    <select name="etat" id="etat" class="form-control" required>
                        @foreach (['Neuf', 'Bon', 'Endommagé', 'En réparation'] as $etat)
                            <option value="{{ $etat }}" {{ old('etat', $materiel->etat) === $etat ? 'selected' : '' }}>{{ $etat }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-4">
                    <label for="date_acquisition">Date d'Acquisition :</label>
                    <input type="date" name="date_acquisition" id="date_acquisition" class="form-control" value="{{ old('date_acquisition', $materiel->date_acquisition) }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="{{ route('materiels.index') }}" class="btn btn-secondary">Annuler</a>
            </form>
        </div>
    </div>
@endsection

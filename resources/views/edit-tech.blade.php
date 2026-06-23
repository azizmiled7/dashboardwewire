@extends('theme')

@section('content')
    <h4 class="mb-4">Modifier le technicien</h4>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    {{-- Message de validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Formulaire de modification --}}
                    <form method="POST" action="{{ route('users.techniciens.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="name">Nom :</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email :</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <a href="{{ route('users.techniciens.index') }}" class="btn btn-secondary">Annuler</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

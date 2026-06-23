@extends('theme')

@section('content')
    <h4 class="mb-sm-3 font-size-18">Ajouter un Technicien</h4>

    <form method="POST" action="{{ route('users.techniciens.store') }}">
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        {{-- Nom --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Nom</label>
                            <div class="col-md-10">
                                <input class="form-control" type="text" name="name" placeholder="Nom du technicien" required>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Email</label>
                            <div class="col-md-10">
                                <input class="form-control" type="email" name="email" placeholder="Email" required>
                            </div>
                        </div>

                        {{-- Mot de passe --}}
                        <div class="mb-3 row">
                            <label class="col-md-2 col-form-label">Mot de passe</label>
                            <div class="col-md-10">
                                <input class="form-control" type="password" name="password" placeholder="Mot de passe" required>
                            </div>
                        </div>

                        {{-- Bouton --}}
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

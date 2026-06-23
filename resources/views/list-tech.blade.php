@extends('theme')

@section('content')
    <h4 class="mb-sm-3 font-size-18">Liste des techniciens</h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    {{-- Message de succès --}}
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    {{-- Vérification que des techniciens existent --}}
                    @if (isset($data) && $data->count())
                        <table id="datatable-buttons" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Nom</th>
                                    <th>Email</th>
                                                @if (auth()->user()->role === 'admin')
                                    <th>Actions</th>
                                                @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                                @if (auth()->user()->role === 'admin')        {{-- Bouton Modifier --}}
<a href="{{ route('users.techniciens.edit', $user->id) }}" class="btn btn-primary btn-sm">Modifier</a>

                                            {{-- Bouton Supprimer --}}
<form action="{{ route('users.techniciens.destroy', $user->id) }}" method="POST" style="display:inline-block;">
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

                        {{-- Pagination --}}
            @if (auth()->user()->role === 'admin')
                        {{-- Lien vers formulaire d'ajout --}}
                        <a href="{{ route('users.techniciens.create') }}" class="btn btn-success mt-3">Ajouter un Technicien</a>
                    @else
                    @endif

                </div>
                                    @endif

            </div>
        </div>
    </div>
@endsection

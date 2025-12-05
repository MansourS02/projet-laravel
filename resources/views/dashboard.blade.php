@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1>Liste des Produits</h1>
        <a href="{{ route('produits.create') }}" class="btn btn-primary mb-3">Ajouter un Produit</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr>
                        <td>{{ $produit->id }}</td>
                        <td>{{ $produit->name }}</td>
                        <td>{{ $produit->details }}</td>
                        <td>{{ $produit->price }} FCFA</td>
                        <td>
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">Éditer</a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
         <form method="POST" action="{{ route('logout') }}" style="display:inline-block;" >
         @csrf
            <button type="submit"  class="btn btn-primary mb-3">Se déconnecter</button>
        </form>
        {{ $produits->links() }}
    </div>
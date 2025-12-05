<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produit;

class ProduitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $produits = Produit::latest()->paginate(5);
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        return view('produits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'nullable|string',
            'categorie' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('image')->store('produits', 'public');

        $validated['image'] = $imagePath;

        Produit::create($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit ajouté avec succès.');
    }

    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        return view('produits.edit', compact('produit'));
    }

    public function update(Request $request, Produit $produit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'details' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('produits', 'public');
        }

        $produit->update($validated);

        return redirect()->route('produits.index')
            ->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Produit $produit)
    {
        $produit->delete();

        return redirect()->route('produits.index')
            ->with('success', 'Produit supprimé avec succès.');
    }
}

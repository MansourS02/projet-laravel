@extends('layouts.app')
@section('content')
<style>
    body {
        background: white;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .form-container {
        max-width: 800px;
        margin: 60px auto;
        padding: 0 20px;
    }

    .breadcrumb {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        padding: 15px 25px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .breadcrumb a {
        color: #667eea;
        text-decoration: none;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .breadcrumb a:hover {
        color: #764ba2;
    }

    .form-card {
        background: white;
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        animation: fadeInUp 0.6s ease;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .form-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 10px;
    }

    .form-subtitle {
        color: #666;
        font-size: 1rem;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 10px;
        color: #333;
        font-weight: 600;
        font-size: 15px;
    }

    .form-input,
    .form-select,
    .form-textarea {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        outline: none;
        font-family: inherit;
    }

    .form-input:focus,
    .form-select:focus,
    .form-textarea:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 120px;
    }

    .file-input-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
        width: 100%;
    }

    .file-input-wrapper input[type=file] {
        position: absolute;
        left: -9999px;
    }

    .file-input-label {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 40px 20px;
        border: 3px dashed #e0e0e0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .file-input-label:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .file-input-label.has-file {
        border-color: #11998e;
        background: rgba(17, 153, 142, 0.05);
    }

    .file-name {
        margin-top: 10px;
        color: #11998e;
        font-weight: 600;
        font-size: 14px;
    }

    .current-image {
        margin-top: 15px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 12px;
    }

    .current-image p {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .image-preview {
        border-radius: 12px;
        overflow: hidden;
        max-width: 300px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .image-preview img {
        width: 100%;
        height: auto;
        display: block;
    }

    .form-actions {
        display: flex;
        gap: 15px;
        margin-top: 40px;
    }

    .btn {
        padding: 15px 35px;
        border-radius: 12px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        font-size: 16px;
        flex: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #FFB75E 0%, #ED8F03 100%);
        color: white;
        box-shadow: 0 5px 20px rgba(255, 183, 94, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 183, 94, 0.6);
    }

    .btn-secondary {
        background: white;
        color: #667eea;
        border: 2px solid #667eea;
    }

    .btn-secondary:hover {
        background: #667eea;
        color: white;
        transform: translateY(-3px);
    }

    .category-icons {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-top: 10px;
    }

    .category-option {
        display: none;
    }

    .category-label {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding: 20px;
        border: 2px solid #e0e0e0;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .category-label:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
    }

    .category-option:checked + .category-label {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .category-icon {
        font-size: 2rem;
    }

    .category-name {
        font-weight: 600;
        font-size: 14px;
    }

    @media (max-width: 768px) {
        .form-card {
            padding: 30px 25px;
        }

        .form-title {
            font-size: 2rem;
        }

        .form-actions {
            flex-direction: column;
        }

        .category-icons {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="form-container">
    <div class="breadcrumb">
        <a href="{{ route('produits.index') }}"> Produits</a>
        <span>›</span>
        <span>Modifier produit</span>
    </div>

    <div class="form-card">
        <div class="form-header">
            <h1 class="form-title"> Modifier le Produit</h1>
            <p class="form-subtitle">Modifiez les informations du produit</p>
        </div>

        <form action="{{ route('produits.update', $produit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name" class="form-label"> Nom du produit</label>
                <input 
                    type="text" 
                    class="form-input" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $produit->name) }}"
                    placeholder="Ex: iPhone 15 Pro Max"
                    required
                >
            </div>

            <div class="form-group">
                <label for="details" class="form-label"> Description</label>
                <textarea 
                    class="form-textarea" 
                    id="details" 
                    name="details" 
                    placeholder="Décrivez les caractéristiques du produit..."
                    required
                >{{ old('details', $produit->details) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label"> Catégorie</label>
                <div class="category-icons">
                    <div>
                        <input type="radio" class="category-option" id="cat-electro" name="categorie" value="Électronique" {{ old('categorie', $produit->categorie) == 'Électronique' ? 'checked' : '' }} required>
                        <label for="cat-electro" class="category-label">
                            <span class="category-icon"></span>
                            <span class="category-name">Électronique</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="category-option" id="cat-vetements" name="categorie" value="Vêtements" {{ old('categorie', $produit->categorie) == 'Vêtements' ? 'checked' : '' }}>
                        <label for="cat-vetements" class="category-label">
                            <span class="category-icon"></span>
                            <span class="category-name">Vêtements</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="category-option" id="cat-accessoires" name="categorie" value="Accessoires" {{ old('categorie', $produit->categorie) == 'Accessoires' ? 'checked' : '' }}>
                        <label for="cat-accessoires" class="category-label">
                            <span class="category-icon"></span>
                            <span class="category-name">Accessoires</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="category-option" id="cat-chaussures" name="categorie" value="Chaussures" {{ old('categorie', $produit->categorie) == 'Chaussures' ? 'checked' : '' }}>
                        <label for="cat-chaussures" class="category-label">
                            <span class="category-icon"></span>
                            <span class="category-name">Chaussures</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="category-option" id="cat-meubles" name="categorie" value="Meubles" {{ old('categorie', $produit->categorie) == 'Meubles' ? 'checked' : '' }}>
                        <label for="cat-meubles" class="category-label">
                            <span class="category-icon"></span>
                            <span class="category-name">Meubles</span>
                        </label>
                    </div>
                    <div>
                        <input type="radio" class="category-option" id="cat-vaisselier" name="categorie" value="Vaisselier" {{ old('categorie', $produit->categorie) == 'Vaisselier' ? 'checked' : '' }}>
                        <label for="cat-vaisselier" class="category-label">
                            <span class="category-icon"></span>
                            <span class="category-name">Vaisselier</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="price" class="form-label"> Prix (FCFA)</label>
                <input 
                    type="number" 
                    class="form-input" 
                    id="price" 
                    name="price" 
                    step="0.01" 
                    value="{{ old('price', $produit->price) }}"
                    placeholder="Ex: 500000"
                    required
                >
            </div>

            <div class="form-group">
                <label class="form-label"> Image du produit</label>
                
                @if($produit->image)
                    <div class="current-image">
                        <p> Image actuelle :</p>
                        <div class="image-preview">
                            <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->name }}">
                        </div>
                    </div>
                @endif

                <div class="file-input-wrapper" style="margin-top: 15px;">
                    <input 
                        type="file" 
                        id="image" 
                        name="image" 
                        accept="image/*"
                        onchange="previewImage(event)"
                    >
                    <label for="image" class="file-input-label" id="fileLabel">
                        <span style="font-size: 2rem;">📁</span>
                        <span>Cliquez pour changer l'image (optionnel)</span>
                    </label>
                </div>
                <div id="fileName" class="file-name" style="display: none;"></div>
                <div id="imagePreview" class="image-preview" style="display: none; margin-top: 15px;">
                    <img id="preview" src="" alt="Aperçu">
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">
                    ✓ Mettre à jour
                </button>
                <a href="{{ route('produits.index') }}" class="btn btn-secondary">
                    ✕ Annuler
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const fileLabel = document.getElementById('fileLabel');
    const fileName = document.getElementById('fileName');
    const imagePreview = document.getElementById('imagePreview');
    const preview = document.getElementById('preview');

    if (file) {
        // Update label
        fileLabel.classList.add('has-file');
        fileLabel.innerHTML = '<span style="font-size: 2rem;">✓</span><span>Nouvelle image sélectionnée</span>';
        
        // Show file name
        fileName.textContent = '📄 ' + file.name;
        fileName.style.display = 'block';

        // Show preview
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            imagePreview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
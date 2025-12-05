@extends('layouts.app')
@section('content')
<style>
    body {
        background: #f5f7fa;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .detail-container {
        max-width: 1200px;
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

    .product-detail-card {
        background: white;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 0;
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

    .image-section {
        position: relative;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 50px;
        min-height: 600px;
    }

    .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        transition: transform 0.5s ease;
    }

    .product-image:hover {
        transform: scale(1.05);
    }

    .image-badge {
        position: absolute;
        top: 30px;
        right: 30px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 700;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    .info-section {
        padding: 60px 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-title {
        font-size: 3rem;
        font-weight: 800;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .product-price {
        font-size: 2.5rem;
        font-weight: 700;
        color: #11998e;
        margin-bottom: 30px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .price-label {
        font-size: 1rem;
        color: #666;
        font-weight: 400;
    }

    .info-block {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 20%);
        padding: 30px;
        border-radius: 20px;
        margin-bottom: 30px;
    }

    .info-block h4 {
        color: #333;
        font-size: 1.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-block p {
        color: #555;
        line-height: 1.8;
        font-size: 1.1rem;
    }

    .action-buttons {
        display: flex;
        gap: 15px;
        margin-top: 40px;
    }

    .btn {
        padding: 15px 35px;
        border-radius: 50px;
        border: none;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        font-size: 16px;
        flex: 1;
        justify-content: center;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.6);
    }

    .btn-warning {
        background: linear-gradient(135deg, #FFB75E 0%, #ED8F03 100%);
        color: white;
        box-shadow: 0 5px 20px rgba(255, 183, 94, 0.4);
    }

    .btn-warning:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 183, 94, 0.6);
    }

    .feature-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
    }

    .tag {
        background: rgba(102, 126, 234, 0.1);
        color: #667eea;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .product-detail-card {
            grid-template-columns: 1fr;
        }

        .image-section {
            min-height: 400px;
            padding: 30px;
        }

        .info-section {
            padding: 40px 30px;
        }

        .product-title {
            font-size: 2.2rem;
        }

        .product-price {
            font-size: 2rem;
        }

        .action-buttons {
            flex-direction: column;
        }
    }

    @media (max-width: 576px) {
        .detail-container {
            margin: 30px auto;
        }

        .product-title {
            font-size: 1.8rem;
        }

        .product-price {
            font-size: 1.6rem;
        }

        .info-section {
            padding: 30px 20px;
        }
    }
</style>

<div class="detail-container">
    <div class="breadcrumb">
        <a href="{{ route('produits.index') }}"> Accueil</a>
        <span>›</span>
        <span>{{ $produit->name }}</span>
    </div>

    <div class="product-detail-card">
        <div class="image-section">
            {{-- <div class="image-badge">⭐ Produit Premium</div> --}}
            <img src="{{ asset('storage/'.$produit->image) }}" alt="{{ $produit->name }}" class="product-image">
        </div>

        <div class="info-section">
            <h1 class="product-title">{{ $produit->name }}</h1>
            
            <div class="product-price">
                <span class="price-label">Prix:</span>
                {{ number_format($produit->price, 0, ',', ' ') }} FCFA
            </div>

            <div class="info-block">
                <h4> Description du produit</h4>
                <p>{{ $produit->details }}</p>
            </div>

            <div class="feature-tags">
                <span class="tag">✓ Haute qualité</span>
                <span class="tag">✓ Livraison rapide</span>
                <span class="tag">✓ Garantie incluse</span>
            </div>

            <div class="action-buttons">
                <a href="{{ route('produits.index') }}" class="btn btn-primary">
                    ← Retour à la liste
                </a>
                <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning">
                     Modifier
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
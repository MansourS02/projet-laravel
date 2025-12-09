@extends('layouts.app')
@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #f5f7fa;
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .topbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 15px 30px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .topbar-left {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .page-content {
        margin-top: 100px;
        padding: 0 20px 40px;
    }

    .header-section {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
    }

    .header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-section h1 {
        font-size: 2.5rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 700;
    }

    .product-counter {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 25px;
        border-radius: 50px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .search-filter-container {
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 20px;
        align-items: center;
    }

    .search-bar {
        position: relative;
    }

    .search-bar input {
        width: 100%;
        padding: 15px 50px 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        font-size: 16px;
        transition: all 0.3s ease;
        outline: none;
    }

    .search-bar input:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .search-bar::after {
        content: "🔍";
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 20px;
    }

    .category-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 2px solid #f0f0f0;
    }

    .category-btn {
        padding: 10px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 50px;
        background: white;
        color: #666;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .category-btn:hover {
        border-color: #667eea;
        background: rgba(102, 126, 234, 0.05);
        color: #667eea;
    }

    .category-btn.active {
        border-color: #667eea;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    }

    .btn {
        padding: 12px 25px;
        border-radius: 50px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
    }

    .btn-danger {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 87, 108, 0.4);
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 87, 108, 0.6);
    }

    .alert {
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 20px;
        animation: slideIn 0.5s ease;
    }

    .alert-success {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        border: none;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #productGrid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        margin-top: 30px;
    }

    .card {
        background: white;
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        cursor: pointer;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
    }

    .product-img-container {
        position: relative;
        width: 100%;
        height: 250px;
        overflow: hidden;
    }

    .product-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .card:hover .product-img {
        transform: scale(1.1);
    }

    .product-img-container::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(0,0,0,0.3), transparent);
    }

    .category-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.95);
        padding: 6px 15px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        color: #667eea;
        z-index: 1;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-body {
        padding: 25px;
    }

    .card-body h3 {
        font-size: 1.4rem;
        margin-bottom: 10px;
        color: #333;
        font-weight: 700;
    }

    .card-body p {
        color: #666;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .price {
        font-size: 1.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 15px 0;
    }

    .card-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #f0f0f0;
    }

    .btn-sm {
        padding: 8px 16px;
        font-size: 13px;
        border-radius: 20px;
    }

    .btn-view {
        background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
        color: white;
        flex: 1;
    }

    .btn-edit {
        background: linear-gradient(135deg, #FFB75E 0%, #ED8F03 100%);
        color: white;
        flex: 1;
    }

    .btn-delete {
        background: red;
        color: white;
        flex: 1;
    }

    .btn-view:hover, .btn-edit:hover, .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 40px;
        gap: 10px;
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: #999;
    }

    .no-results-icon {
        font-size: 4rem;
        margin-bottom: 20px;
    }

    .no-results h3 {
        font-size: 1.5rem;
        color: #666;
        margin-bottom: 10px;
    }

    /* Responsive */
    @media (max-width: 968px) {
        .search-filter-container {
            grid-template-columns: 1fr;
        }

        .category-filter {
            justify-content: center;
        }
    }

    @media (max-width: 768px) {
        #productGrid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .header-section h1 {
            font-size: 2rem;
        }

        .topbar {
            flex-direction: column;
            padding: 15px;
            gap: 15px;
        }

        .topbar-left, .topbar-right {
            width: 100%;
            justify-content: center;
        }

        .page-content {
            margin-top: 160px;
        }

        .header-top {
            flex-direction: column;
            align-items: flex-start;
        }
    }
</style>

<div class="topbar">
    <div class="topbar-left">
        <a href="{{ route('produits.create') }}" class="btn btn-primary">
             Ajouter un Produit
        </a>
    </div>
    <div class="topbar-right">
        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
            @csrf
            <button type="submit" class="btn btn-danger">
                 Se déconnecter
            </button>
        </form>
    </div>
</div>

<div class="page-content">
    <div class="container">
        <div class="header-section">
            <div class="header-top">
                <h1> Liste Produits</h1>
                <div class="product-counter">
                    <span id="productCount">{{ $produits->total() }}</span> produit(s)
                </div>
            </div>
            
            <div class="search-filter-container">
                <div class="search-bar">
                    <input 
                        type="text" 
                        id="searchInput" 
                        onkeyup="filterProducts()" 
                        placeholder="Recherchez un produit..."
                    >
                </div>
            </div>

            <div class="category-filter">
                <button class="category-btn active" onclick="filterByCategory('all')" data-category="all">
                     Toutes les catégories
                </button>
                <button class="category-btn" onclick="filterByCategory('Électronique')" data-category="Électronique">
                     Électronique
                </button>
                <button class="category-btn" onclick="filterByCategory('Vêtements')" data-category="Vêtements">
                     Vêtements
                </button>
                <button class="category-btn" onclick="filterByCategory('Accessoires')" data-category="Accessoires">
                     Accessoires
                </button>
                <button class="category-btn" onclick="filterByCategory('Chaussures')" data-category="Chaussures">
                     Chaussures
                </button>
                <button class="category-btn" onclick="filterByCategory('Meubles')" data-category="Meubles">
                     Meubles
                </button>
                <button class="category-btn" onclick="filterByCategory('Vaisselier')" data-category="Vaisselier">
                     Vaisselier
                </button>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                 {{ session('success') }}
            </div>
        @endif

        <section id="productGrid">
            @foreach($produits as $produit)
                <div class="card" data-category="{{ $produit->categorie }}">
                    <a href="{{ route('produits.show', $produit->id) }}" style="text-decoration: none; color: inherit;">
                        <div class="product-img-container">
                            <span class="category-badge">{{ $produit->categorie }}</span>
                            <img src="{{ asset('storage/'.$produit->image) }}" class="product-img" alt="{{ $produit->name }}">
                        </div>
                    </a>
                    <div class="card-body">
                        <h3>{{ $produit->name }}</h3>
                        <p>{{ Str::limit($produit->details, 80) }}</p>
                        <p class="price">{{ number_format($produit->price, 0, ',', ' ') }} FCFA</p>
                        
                        <div class="card-actions">
                            <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-view btn-sm">
                                 Voir
                            </a>
                            <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-edit btn-sm">
                                 Modifier
                            </a>
                            <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="flex: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')" style="width: 100%;">
                                     Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div> 
            @endforeach
        </section>

        <div id="noResults" class="no-results" style="display: none;">
            <div class="no-results-icon"></div>
            <h3>Aucun produit trouvé</h3>
            <p>Essayez de modifier vos critères de recherche</p>
        </div>
         
        <div class="pagination">
            {{ $produits->links() }}
        </div>
    </div>
</div>

<script>
let selectedCategory = 'all';

function filterByCategory(category) {
    selectedCategory = category;
    
    // Update active button
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Filter products
    filterProducts();
}

function filterProducts() {
    let searchInput = document.getElementById("searchInput").value.toLowerCase();
    let cards = document.querySelectorAll("#productGrid .card");
    let visibleCount = 0;

    cards.forEach(card => {
        let name = card.querySelector("h3").textContent.toLowerCase();
        let category = card.getAttribute('data-category');
        
        let matchesSearch = name.includes(searchInput);
        let matchesCategory = selectedCategory === 'all' || category === selectedCategory;
        
        if (matchesSearch && matchesCategory) {
            card.style.display = "block";
            card.style.animation = "slideIn 0.3s ease";
            visibleCount++;
        } else {
            card.style.display = "none";
        }
    });

    // Update counter
    document.getElementById('productCount').textContent = visibleCount;

    // Show/hide no results message
    document.getElementById('noResults').style.display = visibleCount === 0 ? 'block' : 'none';
    document.getElementById('productGrid').style.display = visibleCount === 0 ? 'none' : 'grid';
}
</script>
@endsection
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Products — {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f8;
            color: #1f2937;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .admin-header {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: -0.02em;
        }

        .product-card {
            border: 0;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            height: 100%;
        }

        .product-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            background-color: #eef1f4;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .product-image-placeholder {
            height: 180px;
            background-color: #eef1f4;
            color: #9ca3af;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem 0.75rem 0 0;
        }

        .btn {
            border-radius: 0.5rem;
            padding: 0.55rem 1.15rem;
            font-weight: 500;
        }

        .empty-state {
            background: #fff;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            padding: 2.5rem 1rem;
        }
    </style>
</head>
<body>
    <header class="admin-header py-3 mb-4">
        <div class="container">
            <span class="fw-semibold">{{ config('app.name', 'Laravel') }} Admin</span>
        </div>
    </header>

    <main class="container pb-5">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="page-title mb-2">Products</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($products->isEmpty())
            <div class="empty-state text-center">
                <p class="text-muted mb-3">No products found.</p>
                <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
            </div>
        @else
            <div class="row g-4">
                @foreach ($products as $product)
                    <div class="col-12 col-sm-6 col-lg-4">
                        <div class="card product-card">
                            @if ($product->image)
                                <img
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->name }}"
                                    class="product-image"
                                >
                            @else
                                <div class="product-image-placeholder">No image</div>
                            @endif
                            <div class="card-body">
                                <h2 class="h5 mb-1">{{ $product->name }}</h2>
                                <p class="text-muted small mb-2">{{ $product->category?->name ?? 'Uncategorized' }}</p>
                                <p class="fw-semibold mb-2">${{ number_format($product->price, 2) }}</p>
                                <p class="small mb-2">Stock: {{ $product->stock }}</p>
                                <p class="text-muted small mb-3">{{ $product->description }}</p>

                                <div class="d-flex flex-wrap gap-2">
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                    <form method="POST" action="{{ route('products.destroy', $product) }}" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</body>
</html>

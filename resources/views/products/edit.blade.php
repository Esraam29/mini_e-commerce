<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Product — {{ config('app.name', 'Laravel') }}</title>
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

        .form-card {
            border: 0;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .form-card .card-header {
            background: #fff;
            border-bottom: 1px solid #eef0f3;
            border-radius: 0.75rem 0.75rem 0 0;
            padding: 1.25rem 1.5rem;
        }

        .form-card .card-body {
            padding: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border-radius: 0.5rem;
            padding: 0.7rem 0.9rem;
        }

        .current-image {
            width: 160px;
            height: 160px;
            object-fit: cover;
            border-radius: 0.5rem;
            background-color: #eef1f4;
        }

        .btn {
            border-radius: 0.5rem;
            padding: 0.55rem 1.15rem;
            font-weight: 500;
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
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
            <h1 class="page-title mb-0">Edit Product</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
                </ol>
            </nav>
        </div>

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8">
                <div class="card form-card">
                    <div class="card-header">
                        <h2 class="h5 mb-0">Product details</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-control" placeholder="Enter product name">
                            </div>

                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select id="category_id" name="category_id" class="form-select">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id) == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" id="price" name="price" value="{{ old('price', $product->price) }}" class="form-control" placeholder="0.00" step="0.01" min="0">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" id="stock" name="stock" value="{{ old('stock', $product->stock) }}" class="form-control" placeholder="0" min="0">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <p class="form-label">Current image</p>
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="current-image mb-3 d-block">
                                @else
                                    <p class="text-muted small">No image uploaded.</p>
                                @endif

                                <label for="image" class="form-label">Upload a new image</label>
                                <input type="file" id="image" name="image" class="form-control" accept="image/*">
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <button type="submit" class="btn btn-primary">Update Product</button>
                                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Back to Products</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

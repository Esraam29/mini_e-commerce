<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Add New Category — {{ config('app.name', 'Laravel') }}</title>
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

        .breadcrumb {
            margin-bottom: 0;
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

        .form-control {
            border-radius: 0.5rem;
            padding: 0.7rem 0.9rem;
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
            <h1 class="page-title mb-0">Add New Category</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Add Category</li>
                </ol>
            </nav>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 col-xl-6">
                <div class="card form-card">
                    <div class="card-header">
                        <h2 class="h5 mb-0">Category details</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('categories.store') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label">Category Name</label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter category name"
                                    required
                                    autofocus
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-2">
                                <button type="submit" class="btn btn-primary">Add Category</button>
                                <a href="{{ route('categories.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>

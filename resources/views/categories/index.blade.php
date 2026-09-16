<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Categories — {{ config('app.name', 'Laravel') }}</title>
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

        .table-card {
            border: 0;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }

        .table-card .card-body {
            padding: 1.5rem;
        }

        .table thead th {
            font-weight: 600;
            color: #4b5563;
            border-bottom-width: 1px;
            white-space: nowrap;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .btn {
            border-radius: 0.5rem;
            padding: 0.55rem 1.15rem;
            font-weight: 500;
        }

        .btn-sm {
            padding: 0.35rem 0.75rem;
        }

        .empty-state {
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
                <h1 class="page-title mb-2">Categories</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Categories</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="card table-card">
            <div class="card-body">
                @if ($categories->isEmpty())
                    <div class="empty-state text-center">
                        <p class="text-muted mb-3">No categories found.</p>
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add Category</a>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                     <td>{{ $loop->iteration }}</td>
                                        <td>{{ $category->name }}</td>
                                        <td>{{ $category->created_at?->format('h:i A, d M Y') }}</td>
                                        <td>{{ $category->updated_at?->format('h:i A, d M Y') }}</td>
                                        <td>
                                            <div class="d-flex flex-wrap gap-2">
                                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form
                                                    method="POST"
                                                    action="{{ route('categories.destroy', $category) }}"
                                                    onsubmit="return confirm('Are you sure you want to delete this category?');"
                                                >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </main>
</body>
</html>

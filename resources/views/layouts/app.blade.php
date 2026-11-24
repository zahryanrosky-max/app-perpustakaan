<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Perpustakaan Digital Kampus')</title>
    <style>
        body { font-family: sans-serif; margin: 0; background: #f8fafc; color: #1e293b; }
        nav { background: #1e3a8a; color: #fff; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; }
        nav .brand { font-weight: bold; font-size: 18px; }
        nav ul { list-style: none; margin: 0; padding: 0; display: flex; gap: 18px; }
        nav ul li a, nav > a { color: #cbd5e1; text-decoration: none; font-size: 15px; }
        nav ul li a:hover, nav ul li a.active, nav > a:hover, nav > a.active { color: #fff; font-weight: bold; }
        nav .navbar-user { display: flex; align-items: center; gap: 12px; color: #cbd5e1; font-size: 14px; }
        nav .btn-logout { background: none; border: 1px solid #cbd5e1; color: #cbd5e1; padding: 4px 10px; border-radius: 4px; cursor: pointer; font-size: 14px; }
        nav .btn-logout:hover { background: #1e40af; color: #fff; }
        .container { max-width: 1000px; margin: 28px auto; padding: 0 20px; }
        table { width: 100%; border-collapse: collapse; background: #fff; margin-top: 16px; }
        th, td { border: 1px solid #e2e8f0; padding: 10px 12px; text-align: left; }
        th { background: #f1f5f9; }
        .btn { display: inline-block; padding: 8px 14px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; font-size: 14px; }
        .btn:hover { background: #1d4ed8; }
        .btn-danger { background: #dc2626; }
        .btn-warning { background: #d97706; }
        .alert-success { background: #d1fae5; color: #065f46; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px; }
        .alert-error { background: #fee2e2; color: #b91c1c; padding: 12px 16px; border-radius: 4px; margin-bottom: 16px; }
        .stats-grid { display: flex; gap: 20px; flex-wrap: wrap; margin-top: 20px; }
        .stat-card { flex: 1; min-width: 160px; background: #f8fafc; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px; text-align: center; }
        .stat-card .value { font-size: 32px; font-weight: bold; color: #1e3a8a; }
        .stat-card .label { margin-top: 6px; color: #6b7280; font-size: 14px; }
        .pagination { margin-top: 16px; display: flex; gap: 12px; align-items: center; flex-wrap: wrap; }
        .pagination a { color: #2563eb; text-decoration: none; }
        .pagination a:hover { text-decoration: underline; }
        .pagination .pagination-current { font-weight: bold; color: #1e3a8a; }
        .pagination .pagination-disabled { color: #9ca3af; }
    </style>
</head>
<body>
    @include('partials.navbar')

    <div class="container">
        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        @yield('content')
    </div>
</body>
</html>
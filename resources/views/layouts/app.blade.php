<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1366, initial-scale=1">

    <title>Sarimelati HR Analytics</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #F5F6FA;
            color: #1F2937;
        }

        .app-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #9B0D23;
            color: white;
            padding: 24px 18px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
        }

        .brand {
            margin-bottom: 32px;
        }

        .brand-title {
            font-size: 20px;
            font-weight: bold;
            line-height: 1.3;
        }

        .brand-subtitle {
            font-size: 12px;
            opacity: 0.85;
            margin-top: 6px;
        }

        .menu-label {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
            margin: 22px 0 10px;
        }

        .sidebar a,
        .logout-button {
            display: block;
            width: 100%;
            color: white;
            text-decoration: none;
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 6px;
            font-size: 14px;
            background: transparent;
            border: none;
            text-align: left;
            cursor: pointer;
        }

        .sidebar a:hover,
        .logout-button:hover {
            background: rgba(255,255,255,0.14);
        }

        .sidebar a.active {
            background: #C8102E;
            font-weight: bold;
        }

        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            min-height: 100vh;
        }

        .topbar {
            height: 72px;
            background: white;
            border-bottom: 1px solid #E5E7EB;
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar-title {
            font-size: 22px;
            font-weight: bold;
            color: #1F2937;
        }

        .topbar-user {
            font-size: 14px;
            color: #6B7280;
        }

        .content {
            padding: 28px 32px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .stat-title {
            font-size: 13px;
            color: #6B7280;
            margin-bottom: 10px;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #C8102E;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .table-card {
            background: white;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.06);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #F9FAFB;
        }

        th, td {
            padding: 13px 14px;
            border-bottom: 1px solid #E5E7EB;
            font-size: 14px;
            text-align: left;
        }

        th {
            color: #374151;
            font-weight: bold;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: bold;
        }

        .badge-success {
            background: #DCFCE7;
            color: #166534;
        }

        .badge-danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        .btn-red {
            background: #C8102E;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn-red:hover {
            background: #9B0D23;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .page-title {
            font-size: 24px;
            font-weight: bold;
        }

        .pagination-wrapper {
            margin-top: 18px;
        }
    </style>
</head>
<body>
    <div class="app-wrapper">
        <aside class="sidebar">
            <div class="brand">
                <div class="brand-title">Sarimelati<br>HR Analytics</div>
                <div class="brand-subtitle">HRIS & Predictive Analytics</div>
            </div>

            <div class="menu-label">Menu Utama</div>

            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('employees.index') }}" class="{{ request()->routeIs('employees.*') ? 'active' : '' }}">
                Data Karyawan
            </a>

            <a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                Data Absensi
            </a>

            <a href="{{ route('performances.index') }}" class="{{ request()->routeIs('performances.*') ? 'active' : '' }}">
                Data KPI
            </a>

            <a href="{{ route('predictions.index') }}" class="{{ request()->routeIs('predictions.*') ? 'active' : '' }}">
                Prediksi Turnover
            </a>

            <a href="#" onclick="alert('Menu Laporan akan dibuat setelah dashboard dan data selesai')">
                Laporan
            </a>

            <a href="{{ route('import.index') }}" class="{{ request()->routeIs('import.*') ? 'active' : '' }}">
                Import Excel
            </a>

            <div class="menu-label">Akun</div>

            <a href="{{ route('profile.edit') }}">
                Profile
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-button">
                    Logout
                </button>
            </form>
        </aside>

        <main class="main-content">
            <div class="topbar">
                <div class="topbar-title">
                    Dashboard Internal
                </div>

                <div class="topbar-user">
                    {{ Auth::user()->name }} | {{ Auth::user()->role }}
                </div>
            </div>

            <div class="content">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>
</html>
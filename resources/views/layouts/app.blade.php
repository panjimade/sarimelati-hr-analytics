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

        .chart-box {
            position: relative;
            width: 100%;
        }

        .chart-small {
            height: 450px;
        }

        .chart-medium {
            height: 350px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        /* ===== Final UI Polishing ===== */

        body {
            overflow-x: hidden;
        }

        .sidebar {
            box-shadow: 4px 0 18px rgba(0,0,0,0.10);
        }

        .brand-title {
            letter-spacing: 0.2px;
        }

        .sidebar a,
        .logout-button {
            transition: 0.2s ease;
        }

        .sidebar a:hover,
        .logout-button:hover {
            transform: translateX(3px);
        }

        .sidebar a.active {
            box-shadow: 0 8px 18px rgba(200,16,46,0.35);
        }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar-title {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .topbar-title small {
            font-size: 12px;
            font-weight: normal;
            color: #6B7280;
        }

        .topbar-user {
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            padding: 9px 14px;
            border-radius: 999px;
            color: #374151;
            font-weight: 600;
        }

        .content {
            max-width: 1440px;
        }

        .card,
        .table-card {
            border: 1px solid #EEF0F3;
        }

        .card:hover,
        .table-card:hover {
            box-shadow: 0 10px 28px rgba(0,0,0,0.08);
        }

        .stat-title {
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
        }

        .stat-value {
            line-height: 1;
        }

        .page-header {
            background: white;
            padding: 22px;
            border-radius: 16px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.05);
            border: 1px solid #EEF0F3;
        }

        .page-title {
            color: #111827;
        }

        .table-card {
            overflow-x: auto;
        }

        table {
            min-width: 900px;
        }

        thead th {
            white-space: nowrap;
        }

        tbody tr:hover {
            background: #FFF7F7;
        }

        td {
            vertical-align: middle;
        }

        .badge {
            white-space: nowrap;
        }

        .btn-red {
            font-weight: 700;
            transition: 0.2s ease;
            box-shadow: 0 6px 14px rgba(200,16,46,0.20);
        }

        .btn-red:hover {
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6B7280;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-secondary:hover {
            background: #4B5563;
        }

        .btn-success {
            background: #166534;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-success:hover {
            background: #14532D;
        }

        .btn-danger {
            background: #991B1B;
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
            font-weight: 700;
        }

        .btn-danger:hover {
            background: #7F1D1D;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #D1D5DB;
            border-radius: 10px;
            margin-top: 8px;
            outline: none;
        }

        .form-control:focus {
            border-color: #C8102E;
            box-shadow: 0 0 0 3px rgba(200,16,46,0.12);
        }

        .form-label {
            font-weight: bold;
            display: block;
        }

        .alert-success {
            background: #DCFCE7;
            color: #166534;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #BBF7D0;
        }

        .alert-error {
            background: #FEE2E2;
            color: #991B1B;
            padding: 14px;
            border-radius: 12px;
            margin-bottom: 20px;
            border: 1px solid #FECACA;
        }

        .empty-state {
            text-align: center;
            padding: 34px;
            color: #6B7280;
        }

        .empty-state-title {
            font-size: 18px;
            font-weight: bold;
            color: #374151;
            margin-bottom: 8px;
        }

        .pagination-wrapper nav {
            margin-top: 18px;
        }

        .chart-box {
            position: relative;
            width: 100%;
        }

        .chart-small {
            height: 180px;
        }

        .chart-medium {
            height: 220px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 100% !important;
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

            @if(in_array(Auth::user()->role, ['admin', 'supervisor']))
                <a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                    Data Absensi
                </a>

                <a href="{{ route('performances.index') }}" class="{{ request()->routeIs('performances.*') ? 'active' : '' }}">
                    Data KPI
                </a>
            @endif

            @if(in_array(Auth::user()->role, ['admin', 'hrd_manager']))
                <a href="{{ route('predictions.index') }}" class="{{ request()->routeIs('predictions.*') ? 'active' : '' }}">
                    Prediksi Turnover
                </a>

                <a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active' : '' }}">
                    Laporan
                </a>
            @endif

            @if(Auth::user()->role == 'admin')
                <div class="menu-label">Admin Tools</div>

                <a href="{{ route('users.index') }}" class="{{ request()->routeIs('users.*') ? 'active' : '' }}">
                    Manajemen User
                </a>

                <a href="{{ route('import.index') }}" class="{{ request()->routeIs('import.*') ? 'active' : '' }}">
                    Import Excel
                </a>
            @endif

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
                    Sarimelati HR Analytics
                    <small>Human Resource Information System & Predictive Analytics</small>
                </div>

                <div class="topbar-user">
                    {{ Auth::user()->name }} |
                    @if(Auth::user()->role == 'admin')
                        Admin
                    @elseif(Auth::user()->role == 'supervisor')
                        Supervisor
                    @else
                        HRD/Manager
                    @endif
                </div>
            </div>

            <div class="content">
                {{ $slot }}

                <div style="text-align: center; color: #9CA3AF; font-size: 12px; margin-top: 32px; padding: 18px;">
                    © {{ date('Y') }} Sarimelati HR Analytics — HRIS & Predictive Analytics System
                </div>
            </div>
        </main>
    </div>
</body>
</html>
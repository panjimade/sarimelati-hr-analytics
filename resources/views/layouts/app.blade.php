<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=1366, initial-scale=1">

    <title>Sarimelati HR Analytics</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* =========================================================
           Sarimelati HR Analytics - Main Layout Styles
           ========================================================= */

        :root {
            --sidebar-width: 260px;
            --red-primary: #A70E25;
            --red-secondary: #C8102E;
            --red-dark: #9B0D23;
            --green-primary: #166534;
            --green-dark: #14532D;
            --gray-bg: #F5F6FA;
            --gray-soft: #F9FAFB;
            --gray-border: #E5E7EB;
            --gray-text: #6B7280;
            --text-main: #1F2937;
            --text-dark: #111827;
            --white: #FFFFFF;
            --shadow-sm: 0 6px 18px rgba(0, 0, 0, 0.06);
            --shadow-md: 0 10px 28px rgba(0, 0, 0, 0.08);
            --radius-md: 10px;
            --radius-lg: 16px;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            min-height: 100%;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--gray-bg);
            color: var(--text-main);
            overflow-x: hidden;
        }

        body {
            line-height: 1.5;
        }

        a {
            color: inherit;
        }

        button,
        input,
        select,
        textarea {
            font-family: inherit;
        }

        /* =========================================================
           Layout
           ========================================================= */

        .app-wrapper {
            display: flex;
            min-height: 100vh;
            background: var(--gray-bg);
        }

        .main-content {
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            margin-left: var(--sidebar-width);
            background: var(--gray-bg);
        }

        .content {
            width: 100%;
            max-width: none;
            padding: 28px 32px;
        }

        /* =========================================================
           Sidebar
           ========================================================= */

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            min-height: 100vh;
            padding: 28px 22px 60px;
            overflow-y: auto;
            overflow-x: hidden;
            color: var(--white);
            background: var(--red-primary);
            box-shadow: 4px 0 18px rgba(0, 0, 0, 0.10);
        }

        .brand {
            margin-bottom: 32px;
        }

        .brand-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1.3;
            letter-spacing: 0.2px;
        }

        .brand-subtitle {
            margin-top: 6px;
            font-size: 12px;
            opacity: 0.85;
        }

        .menu-label {
            margin: 22px 0 10px;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
        }

        .sidebar a,
        .logout-button {
            display: block;
            width: 100%;
            margin-bottom: 6px;
            padding: 12px 14px;
            border: none;
            border-radius: var(--radius-md);
            background: transparent;
            color: var(--white);
            font-size: 14px;
            text-align: left;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .sidebar a:hover,
        .logout-button:hover {
            background: rgba(255, 255, 255, 0.14);
            transform: translateX(3px);
        }

        .sidebar a.active {
            background: var(--red-secondary);
            font-weight: 700;
            box-shadow: 0 8px 18px rgba(200, 16, 46, 0.35);
        }

        .sidebar form {
            margin-bottom: 24px;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.08);
        }

        .sidebar::-webkit-scrollbar-thumb {
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.35);
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.55);
        }

        /* =========================================================
           Topbar
           ========================================================= */

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            width: 100%;
            height: 72px;
            padding: 0 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--white);
            border-bottom: 1px solid var(--gray-border);
        }

        .topbar-title {
            display: flex;
            flex-direction: column;
            gap: 4px;
            font-size: 22px;
            font-weight: 700;
            color: var(--text-main);
        }

        .topbar-title small {
            font-size: 12px;
            font-weight: 400;
            color: var(--gray-text);
        }

        .topbar-user {
            padding: 9px 14px;
            border: 1px solid var(--gray-border);
            border-radius: 999px;
            background: var(--gray-soft);
            color: #374151;
            font-size: 14px;
            font-weight: 600;
        }

        /* =========================================================
           Page Header
           ========================================================= */

        .page-header {
            width: 100%;
            margin-bottom: 22px;
            padding: 22px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            border: 1px solid #EEF0F3;
            border-radius: var(--radius-lg);
            background: var(--white);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.05);
        }

        .page-header-with-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }

        .page-title {
            color: var(--text-dark);
            font-size: 24px;
            font-weight: 700;
        }

        .page-subtitle {
            margin-top: 6px;
            color: var(--gray-text);
            font-size: 15px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .header-actions .btn-red,
        .header-actions .btn-success,
        .header-actions .btn-secondary,
        .header-actions .btn-danger {
            white-space: nowrap;
        }

        /* =========================================================
           Cards & Dashboard
           ========================================================= */

        .card,
        .table-card {
            width: 100%;
            border: 1px solid #EEF0F3;
            border-radius: var(--radius-lg);
            background: var(--white);
            box-shadow: var(--shadow-sm);
        }

        .card {
            padding: 22px;
        }

        .card:hover,
        .table-card:hover {
            box-shadow: var(--shadow-md);
        }

        .stats-grid {
            width: 100%;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 24px;
        }

        .stat-title {
            margin-bottom: 10px;
            color: var(--gray-text);
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            color: var(--red-secondary);
            font-size: 28px;
            font-weight: 700;
            line-height: 1;
        }

        .section-title {
            margin-bottom: 18px;
            font-size: 18px;
            font-weight: 700;
        }

        .chart-grid {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 22px;
        }

        .chart-box {
            position: relative;
            width: 100%;
        }

        .chart-small,
        .chart-medium {
            height: 300px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 100% !important;
        }

        /* =========================================================
           Tables
           ========================================================= */

        .table-card {
            padding: 22px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            min-width: 900px;
            border-collapse: collapse;
        }

        thead {
            background: var(--gray-soft);
        }

        thead th {
            white-space: nowrap;
        }

        th,
        td {
            padding: 13px 14px;
            border-bottom: 1px solid var(--gray-border);
            font-size: 14px;
            text-align: left;
            vertical-align: middle;
        }

        th {
            color: #374151;
            font-weight: 700;
        }

        tbody tr:hover {
            background: #FFF7F7;
        }

        .sort-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #374151;
            font-weight: 700;
            text-decoration: none;
        }

        .sort-link:hover {
            color: var(--red-secondary);
        }

        .sort-arrow {
            color: var(--red-secondary);
            font-size: 12px;
        }

        .pagination-wrapper {
            margin-top: 18px;
        }

        .pagination-wrapper nav {
            margin-top: 18px;
        }

        /* =========================================================
           Badges
           ========================================================= */

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            white-space: nowrap;
        }

        .badge-success {
            background: #DCFCE7;
            color: #166534;
        }

        .badge-danger {
            background: #FEE2E2;
            color: #991B1B;
        }

        .badge-warning {
            background: #FEF3C7;
            color: #92400E;
        }

        .badge-info {
            background: #DBEAFE;
            color: #1E40AF;
        }

        /* =========================================================
           Buttons
           ========================================================= */

        .btn-red,
        .btn-secondary,
        .btn-success,
        .btn-danger {
            display: inline-block;
            padding: 10px 14px;
            border: none;
            border-radius: var(--radius-md);
            color: var(--white);
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: 0.2s ease;
        }

        .btn-red {
            background: var(--red-secondary);
            box-shadow: 0 6px 14px rgba(200, 16, 46, 0.20);
        }

        .btn-red:hover {
            background: var(--red-dark);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #6B7280;
        }

        .btn-secondary:hover {
            background: #4B5563;
            transform: translateY(-1px);
        }

        .btn-success {
            background: var(--green-primary);
        }

        .btn-success:hover {
            background: var(--green-dark);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: #991B1B;
        }

        .btn-danger:hover {
            background: #7F1D1D;
            transform: translateY(-1px);
        }

        /* =========================================================
           Forms & Alerts
           ========================================================= */

        .form-label {
            display: block;
            font-weight: 700;
        }

        .form-control {
            width: 100%;
            margin-top: 8px;
            padding: 12px;
            border: 1px solid #D1D5DB;
            border-radius: var(--radius-md);
            outline: none;
        }

        .form-control:focus {
            border-color: var(--red-secondary);
            box-shadow: 0 0 0 3px rgba(200, 16, 46, 0.12);
        }

        .alert-success,
        .alert-error {
            margin-bottom: 20px;
            padding: 14px;
            border-radius: 12px;
        }

        .alert-success {
            border: 1px solid #BBF7D0;
            background: #DCFCE7;
            color: #166534;
        }

        .alert-error {
            border: 1px solid #FECACA;
            background: #FEE2E2;
            color: #991B1B;
        }

        .empty-state {
            padding: 34px;
            color: var(--gray-text);
            text-align: center;
        }

        .empty-state-title {
            margin-bottom: 8px;
            color: #374151;
            font-size: 18px;
            font-weight: 700;
        }

        /* =========================================================
           Responsive Adjustments
           ========================================================= */

        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .chart-grid {
                grid-template-columns: 1fr;
            }
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
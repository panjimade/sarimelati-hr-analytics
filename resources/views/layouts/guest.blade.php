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

        .login-wrapper {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            background: #F5F6FA;
        }

        .login-brand {
            background: linear-gradient(135deg, #9B0D23, #C8102E);
            color: white;
            padding: 70px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .login-brand::before {
            content: "";
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            top: -120px;
            right: -100px;
        }

        .login-brand::after {
            content: "";
            position: absolute;
            width: 280px;
            height: 280px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
            bottom: -80px;
            left: -60px;
        }

        .brand-content {
            position: relative;
            z-index: 2;
            max-width: 560px;
        }

        .brand-badge {
            display: inline-block;
            background: rgba(255,255,255,0.16);
            padding: 9px 16px;
            border-radius: 999px;
            font-size: 13px;
            margin-bottom: 24px;
            letter-spacing: 0.4px;
        }

        .brand-title {
            font-size: 46px;
            line-height: 1.12;
            font-weight: 800;
            margin-bottom: 18px;
        }

        .brand-desc {
            font-size: 17px;
            line-height: 1.7;
            color: rgba(255,255,255,0.88);
            margin-bottom: 32px;
        }

        .feature-list {
            display: grid;
            gap: 14px;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 15px;
            color: rgba(255,255,255,0.92);
        }

        .feature-icon {
            width: 28px;
            height: 28px;
            border-radius: 8px;
            background: rgba(255,255,255,0.18);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .login-form-area {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
        }

        .login-card {
            width: 100%;
            max-width: 430px;
            background: white;
            border-radius: 22px;
            padding: 36px;
            box-shadow: 0 18px 45px rgba(0,0,0,0.10);
        }

        .login-logo {
            width: 62px;
            height: 62px;
            border-radius: 18px;
            background: #C8102E;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 18px;
        }

        .login-title {
            font-size: 26px;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 6px;
        }

        .login-subtitle {
            color: #6B7280;
            font-size: 14px;
            margin-bottom: 28px;
            line-height: 1.5;
        }

        .input-label {
            font-size: 14px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
            display: block;
        }

        .input-field {
            width: 100%;
            padding: 13px 14px;
            border: 1px solid #D1D5DB;
            border-radius: 12px;
            font-size: 14px;
            outline: none;
        }

        .input-field:focus {
            border-color: #C8102E;
            box-shadow: 0 0 0 3px rgba(200,16,46,0.12);
        }

        .form-group {
            margin-bottom: 18px;
        }

        .login-button {
            width: 100%;
            background: #C8102E;
            color: white;
            border: none;
            padding: 13px 16px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            font-size: 15px;
            margin-top: 6px;
        }

        .login-button:hover {
            background: #9B0D23;
        }

        .remember-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 12px 0 20px;
            font-size: 13px;
            color: #6B7280;
        }

        .forgot-link {
            color: #C8102E;
            text-decoration: none;
            font-weight: 600;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .demo-account {
            margin-top: 24px;
            padding: 14px;
            border-radius: 14px;
            background: #F9FAFB;
            border: 1px solid #E5E7EB;
            font-size: 13px;
            color: #4B5563;
            line-height: 1.7;
        }

        .demo-account strong {
            color: #1F2937;
        }

        .error-box {
            background: #FEE2E2;
            color: #991B1B;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 18px;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <section class="login-brand">
            <div class="brand-content">
                <div class="brand-badge">
                    HRIS & Predictive Analytics
                </div>

                <div class="brand-title">
                    Sarimelati<br>HR Analytics
                </div>

                <div class="brand-desc">
                    Sistem internal untuk monitoring kinerja karyawan, pengelolaan absensi, penilaian KPI, laporan HR, dan prediksi risiko turnover berbasis Random Forest.
                </div>

                <div class="feature-list">
                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        Dashboard monitoring karyawan secara terpusat
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        Analisis absensi, KPI, dan performa karyawan
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        Prediksi risiko resign menggunakan machine learning
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">✓</div>
                        Export laporan HR dalam format PDF dan Excel
                    </div>
                </div>
            </div>
        </section>

        <section class="login-form-area">
            <div class="login-card">
                {{ $slot }}
            </div>
        </section>
    </div>
</body>
</html>
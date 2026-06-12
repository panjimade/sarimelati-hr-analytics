<x-app-layout>
    <div class="card" style="max-width: 720px; margin: 80px auto; text-align: center;">
        <div style="font-size: 64px; font-weight: bold; color: #C8102E; margin-bottom: 12px;">
            403
        </div>

        <div style="font-size: 26px; font-weight: bold; margin-bottom: 10px;">
            Akses Ditolak
        </div>

        <p style="color: #6B7280; line-height: 1.7; margin-bottom: 26px;">
            Anda tidak memiliki hak akses untuk membuka halaman ini.
            Silakan kembali ke dashboard atau hubungi Admin Sistem.
        </p>

        <a href="{{ route('dashboard') }}" class="btn-red">
            Kembali ke Dashboard
        </a>
    </div>
</x-app-layout>
<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Reset Data HRIS</div>
            <div class="page-subtitle">
                Halaman khusus Admin untuk mengosongkan data HRIS tanpa menghapus akun user.
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 760px;">
        <div style="font-size: 22px; font-weight: bold; color: #991B1B; margin-bottom: 10px;">
            Danger Zone
        </div>

        <p style="color: #4B5563; line-height: 1.7; margin-bottom: 18px;">
            Fitur ini akan menghapus seluruh data karyawan, absensi, KPI, turnover,
            hasil prediksi turnover, dan laporan. Data user, role, divisi, dan jabatan
            tidak akan dihapus.
        </p>

        <div style="background: #FEF2F2; border: 1px solid #FECACA; color: #991B1B; padding: 14px; border-radius: 12px; margin-bottom: 22px;">
            Pastikan Admin sudah melakukan backup atau export format import Excel sebelum melakukan reset data.
        </div>

        <form method="POST" action="{{ route('admin.reset-data.reset') }}"
              onsubmit="return confirm('Apakah Anda benar-benar yakin ingin mengosongkan data HRIS? Tindakan ini tidak bisa dibatalkan.');">
            @csrf

            <div style="margin-bottom: 18px;">
                <label class="form-label">
                    Ketik Konfirmasi
                </label>
                <input
                    type="text"
                    name="confirmation"
                    class="form-control"
                    placeholder="Ketik: RESET DATA HRIS"
                    required
                >
                <small style="color: #6B7280;">
                    Ketik persis: RESET DATA HRIS
                </small>
            </div>

            <div style="margin-bottom: 22px;">
                <label class="form-label">
                    Password Admin
                </label>
                <input
                    type="password"
                    name="current_password"
                    class="form-control"
                    placeholder="Masukkan password admin"
                    required
                >
            </div>

            <button type="submit" class="btn-danger">
                Kosongkan Data HRIS
            </button>

            <a href="{{ route('dashboard') }}" class="btn-secondary" style="margin-left: 8px;">
                Batal
            </a>
        </form>
    </div>
</x-app-layout>
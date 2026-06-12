<x-app-layout>>
    <div class="page-header">
        <div>
            <div class="page-title">Tambah Data KPI</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Input penilaian performa bulanan karyawan.
            </p>
        </div>

        <a href="{{ route('performances.index') }}" class="btn-red">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 720px;">
        <form action="{{ route('performances.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Karyawan</label>
                <select name="employee_id" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
                    <option value="">Pilih Karyawan</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->employee_code }} - {{ $employee->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Bulan</label>
                <input type="text" name="bulan" placeholder="Contoh: Jan-2026" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Nilai Disiplin</label>
                <input type="number" name="disiplin" min="0" max="100" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Nilai Teamwork</label>
                <input type="number" name="teamwork" min="0" max="100" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight:bold;">Nilai Kecepatan Kerja</label>
                <input type="number" name="kecepatan_kerja" min="0" max="100" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <button type="submit" class="btn-red">
                Simpan KPI
            </button>
        </form>
    </div>
</x-app-layout>
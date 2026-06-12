<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Tambah Data Absensi</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Input data kehadiran karyawan.
            </p>
        </div>

        <a href="{{ route('attendances.index') }}" class="btn-red">
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
        <form action="{{ route('attendances.store') }}" method="POST">
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
                <label style="font-weight:bold;">Tanggal</label>
                <input type="date" name="tanggal" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Status Hadir</label>
                <select name="hadir" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
                    <option value="">Pilih Status</option>
                    <option value="Ya">Hadir</option>
                    <option value="Tidak">Tidak Hadir</option>
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Jam Masuk</label>
                <input type="time" name="jam_masuk" style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight:bold;">Telat Menit</label>
                <input type="number" name="telat_menit" value="0" min="0" style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <button type="submit" class="btn-red">
                Simpan Absensi
            </button>
        </form>
    </div>
</x-app-layout>
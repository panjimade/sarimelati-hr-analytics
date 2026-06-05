<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Edit Data KPI</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Perbarui penilaian performa bulanan karyawan.
            </p>
        </div>

        <a href="{{ route('performances.index') }}" class="btn-red">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div style="background: #FEE2E2; color: #991B1B; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 720px;">
        <form action="{{ route('performances.update', $performance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Karyawan</label>
                <select name="employee_id" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $performance->employee_id == $employee->id ? 'selected' : '' }}>
                            {{ $employee->employee_code }} - {{ $employee->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Bulan</label>
                <input type="text" name="bulan" value="{{ $performance->bulan }}" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Nilai Disiplin</label>
                <input type="number" name="disiplin" value="{{ $performance->disiplin }}" min="0" max="100" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Nilai Teamwork</label>
                <input type="number" name="teamwork" value="{{ $performance->teamwork }}" min="0" max="100" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight:bold;">Nilai Kecepatan Kerja</label>
                <input type="number" name="kecepatan_kerja" value="{{ $performance->kecepatan_kerja }}" min="0" max="100" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <button type="submit" class="btn-red">
                Update KPI
            </button>
        </form>
    </div>
</x-app-layout>
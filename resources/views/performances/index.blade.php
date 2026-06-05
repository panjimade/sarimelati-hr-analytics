<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Data KPI Karyawan</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Kelola penilaian performa karyawan berdasarkan disiplin, teamwork, dan kecepatan kerja.
            </p>
        </div>

        <a href="{{ route('performances.create') }}" class="btn-red">
            Tambah KPI
        </a>
    </div>

    @if(session('success'))
        <div style="background: #DCFCE7; color: #166534; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Kode</th>
                    <th>Nama Karyawan</th>
                    <th>Disiplin</th>
                    <th>Teamwork</th>
                    <th>Kecepatan Kerja</th>
                    <th>Total Score</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($performances as $performance)
                    <tr>
                        <td>{{ $performance->bulan }}</td>
                        <td>{{ $performance->employee->employee_code ?? '-' }}</td>
                        <td>{{ $performance->employee->nama ?? '-' }}</td>
                        <td>{{ $performance->disiplin }}</td>
                        <td>{{ $performance->teamwork }}</td>
                        <td>{{ $performance->kecepatan_kerja }}</td>
                        <td>{{ number_format($performance->total_score, 2) }}</td>
                        <td>
                            @if($performance->total_score >= 85)
                                <span class="badge badge-success">Sangat Baik</span>
                            @elseif($performance->total_score >= 75)
                                <span class="badge" style="background: #FEF3C7; color: #92400E;">Baik</span>
                            @else
                                <span class="badge badge-danger">Perlu Evaluasi</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('performances.edit', $performance->id) }}" class="btn-red" style="padding: 7px 10px;">
                                Edit
                            </a>

                            <form action="{{ route('performances.destroy', $performance->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data KPI ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-red" style="padding: 7px 10px; background:#991B1B;">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">Data KPI belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $performances->links() }}
        </div>
    </div>
</x-app-layout>
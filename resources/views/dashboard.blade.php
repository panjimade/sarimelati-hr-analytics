<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Dashboard Monitoring HR</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Ringkasan data karyawan, absensi, performa, dan risiko turnover.
            </p>
        </div>
    </div>

    <div class="stats-grid">
        <div class="card">
            <div class="stat-title">Total Karyawan</div>
            <div class="stat-value">{{ $totalEmployees }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Total Hadir</div>
            <div class="stat-value">{{ $totalHadir }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Total Tidak Hadir</div>
            <div class="stat-value">{{ $totalTidakHadir }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Risiko Resign Tinggi</div>
            <div class="stat-value">{{ $highRiskEmployees }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="section-title">Ranking Performa Karyawan</div>

        <table>
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Rata-rata KPI</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rankingPerformance as $item)
                    <tr>
                        <td>{{ $item->employee_code }}</td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nama_jabatan }}</td>
                        <td>{{ number_format($item->rata_rata_kpi, 2) }}</td>
                        <td>
                            @if($item->rata_rata_kpi >= 85)
                                <span class="badge badge-success">Sangat Baik</span>
                            @elseif($item->rata_rata_kpi >= 75)
                                <span class="badge" style="background: #FEF3C7; color: #92400E;">Baik</span>
                            @else
                                <span class="badge badge-danger">Perlu Evaluasi</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Data performa belum tersedia. Silakan import Excel terlebih dahulu.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
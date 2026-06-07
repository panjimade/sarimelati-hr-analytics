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

    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 24px;">
        <div class="card">
            <div class="section-title">Grafik Absensi</div>
            <div class="chart-box chart-small">
                <canvas id="attendanceChart"></canvas>
            </div>
        </div>

        <div class="card">
            <div class="section-title">Grafik Risiko Turnover</div>
            <div class="chart-box chart-small">
                <canvas id="riskChart"></canvas>
            </div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="section-title">Grafik Ranking Performa Karyawan</div>
        <div class="chart-box chart-medium">
            <canvas id="performanceChart"></canvas>
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
                        <td colspan="5">
                            Data performa belum tersedia. Silakan import Excel terlebih dahulu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const attendanceLabels = @json($attendanceChartLabels);
        const attendanceData = @json($attendanceChartData);

        const performanceLabels = @json($performanceChartLabels);
        const performanceData = @json($performanceChartData);

        const riskLabels = @json($riskChartLabels);
        const riskData = @json($riskChartData);

        new Chart(document.getElementById('attendanceChart'), {
            type: 'doughnut',
            data: {
                labels: attendanceLabels,
                datasets: [{
                    data: attendanceData,
                    backgroundColor: ['#16A34A', '#DC2626'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        new Chart(document.getElementById('riskChart'), {
            type: 'doughnut',
            data: {
                labels: riskLabels,
                datasets: [{
                    data: riskData,
                    backgroundColor: ['#16A34A', '#F59E0B', '#DC2626'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        new Chart(document.getElementById('performanceChart'), {
            type: 'bar',
            data: {
                labels: performanceLabels,
                datasets: [{
                    label: 'Rata-rata KPI',
                    data: performanceData,
                    backgroundColor: '#C8102E',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</x-app-layout>
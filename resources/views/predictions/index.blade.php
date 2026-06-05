<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Prediksi Turnover</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Analisis risiko resign karyawan menggunakan algoritma Random Forest berdasarkan data KPI dan absensi.
            </p>
        </div>

        <form action="{{ route('predictions.run') }}" method="POST" onsubmit="return confirm('Jalankan prediksi turnover sekarang?')">
            @csrf
            <button type="submit" class="btn-red">
                Jalankan Prediksi
            </button>
        </form>
    </div>

    @if(session('success'))
        <div style="background: #DCFCE7; color: #166534; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #FEE2E2; color: #991B1B; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="stats-grid">
        <div class="card">
            <div class="stat-title">Total Prediksi</div>
            <div class="stat-value">{{ $totalPredictions }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Risiko Tinggi</div>
            <div class="stat-value">{{ $highRisk }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Risiko Sedang</div>
            <div class="stat-value">{{ $mediumRisk }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Risiko Rendah</div>
            <div class="stat-value">{{ $lowRisk }}</div>
        </div>
    </div>

    <div class="table-card">
        <div class="section-title">Hasil Prediksi Turnover</div>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Nama Karyawan</th>
                    <th>Jabatan</th>
                    <th>Rata-rata KPI</th>
                    <th>Tidak Hadir</th>
                    <th>Total Telat</th>
                    <th>Skor Risiko</th>
                    <th>Kategori</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                @forelse($predictions as $prediction)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($prediction->tanggal_prediksi)->format('d M Y') }}</td>
                        <td>{{ $prediction->employee->employee_code ?? '-' }}</td>
                        <td>{{ $prediction->employee->nama ?? '-' }}</td>
                        <td>{{ $prediction->employee->position->nama_jabatan ?? '-' }}</td>
                        <td>{{ number_format($prediction->rata_rata_kpi, 2) }}</td>
                        <td>{{ $prediction->jumlah_tidak_hadir }} hari</td>
                        <td>{{ $prediction->total_telat }} menit</td>
                        <td>{{ number_format($prediction->skor_prediksi, 2) }}%</td>
                        <td>
                            @if($prediction->kategori_risiko == 'Tinggi')
                                <span class="badge badge-danger">Tinggi</span>
                            @elseif($prediction->kategori_risiko == 'Sedang')
                                <span class="badge" style="background: #FEF3C7; color: #92400E;">Sedang</span>
                            @else
                                <span class="badge badge-success">Rendah</span>
                            @endif
                        </td>
                        <td>
                            @if($prediction->hasil_prediksi == 'Berisiko Resign')
                                <span class="badge badge-danger">Berisiko Resign</span>
                            @else
                                <span class="badge badge-success">Bertahan</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">
                            Data prediksi belum tersedia. Klik tombol <b>Jalankan Prediksi</b> untuk memproses data.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $predictions->links() }}
        </div>
    </div>
</x-app-layout>
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
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-error">
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
        @php
            $nextDirection = fn($column) => ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';

            $sortUrl = fn($column) => request()->fullUrlWithQuery([
                'sort' => $column,
                'direction' => $nextDirection($column),
                'page' => 1
            ]);

            $sortIcon = fn($column) => $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '↕';
        @endphp

        <table>
            <thead>
                <tr>
                    <th>
                        <a href="{{ $sortUrl('tanggal') }}" class="sort-link">
                            Tanggal Prediksi <span class="sort-arrow">{{ $sortIcon('tanggal') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('kode') }}" class="sort-link">
                            Kode <span class="sort-arrow">{{ $sortIcon('kode') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('nama') }}" class="sort-link">
                            Nama Karyawan <span class="sort-arrow">{{ $sortIcon('nama') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('jabatan') }}" class="sort-link">
                            Jabatan <span class="sort-arrow">{{ $sortIcon('jabatan') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('rata_rata_kpi') }}" class="sort-link">
                            Rata-rata KPI <span class="sort-arrow">{{ $sortIcon('rata_rata_kpi') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('jumlah_tidak_hadir') }}" class="sort-link">
                            Tidak Hadir <span class="sort-arrow">{{ $sortIcon('jumlah_tidak_hadir') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('total_telat') }}" class="sort-link">
                            Total Telat <span class="sort-arrow">{{ $sortIcon('total_telat') }}</span>
                        </a>
                    </th>

                    <th>
                        <a href="{{ $sortUrl('skor_prediksi') }}" class="sort-link">
                            Skor Risiko <span class="sort-arrow">{{ $sortIcon('skor_prediksi') }}</span>
                        </a>
                    </th>

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
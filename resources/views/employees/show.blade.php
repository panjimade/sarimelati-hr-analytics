<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Detail Karyawan</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Informasi lengkap karyawan, riwayat absensi, KPI, dan hasil prediksi turnover.
            </p>
        </div>

        <a href="{{ route('employees.index') }}" class="btn-red">
            Kembali
        </a>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 18px;">
            <div>
                <div style="font-size: 13px; color: #6B7280;">Kode Karyawan</div>
                <div style="font-size: 18px; font-weight: bold;">{{ $employee->employee_code }}</div>
            </div>

            <div>
                <div style="font-size: 13px; color: #6B7280;">Nama Karyawan</div>
                <div style="font-size: 18px; font-weight: bold;">{{ $employee->nama }}</div>
            </div>

            <div>
                <div style="font-size: 13px; color: #6B7280;">Status</div>
                <div style="font-size: 18px; font-weight: bold;">
                    @if($employee->status == 'Aktif')
                        <span class="badge badge-success">Aktif</span>
                    @else
                        <span class="badge badge-danger">Tidak Aktif</span>
                    @endif
                </div>
            </div>

            <div>
                <div style="font-size: 13px; color: #6B7280;">Divisi</div>
                <div style="font-size: 18px; font-weight: bold;">{{ $employee->division->nama_divisi ?? '-' }}</div>
            </div>

            <div>
                <div style="font-size: 13px; color: #6B7280;">Jabatan</div>
                <div style="font-size: 18px; font-weight: bold;">{{ $employee->position->nama_jabatan ?? '-' }}</div>
            </div>

            <div>
                <div style="font-size: 13px; color: #6B7280;">Shift</div>
                <div style="font-size: 18px; font-weight: bold;">{{ $employee->shift }}</div>
            </div>

            <div>
                <div style="font-size: 13px; color: #6B7280;">Tanggal Masuk</div>
                <div style="font-size: 18px; font-weight: bold;">
                    {{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}
                </div>
            </div>
        </div>
    </div>

    <div class="stats-grid">
        <div class="card">
            <div class="stat-title">Total Hadir</div>
            <div class="stat-value">{{ $totalHadir }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Total Tidak Hadir</div>
            <div class="stat-value">{{ $totalTidakHadir }}</div>
        </div>

        <div class="card">
            <div class="stat-title">Total Telat</div>
            <div class="stat-value">{{ $totalTelat }}</div>
            <div style="font-size: 12px; color: #6B7280;">menit</div>
        </div>

        <div class="card">
            <div class="stat-title">Rata-rata KPI</div>
            <div class="stat-value">{{ number_format($rataRataKpi, 2) }}</div>
        </div>
    </div>

    <div class="card" style="margin-bottom: 24px;">
        <div class="section-title">Status Prediksi Terbaru</div>

        @if($latestPrediction)
            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 18px;">
                <div>
                    <div style="font-size: 13px; color: #6B7280;">Tanggal Prediksi</div>
                    <div style="font-size: 18px; font-weight: bold;">
                        {{ \Carbon\Carbon::parse($latestPrediction->tanggal_prediksi)->format('d M Y') }}
                    </div>
                </div>

                <div>
                    <div style="font-size: 13px; color: #6B7280;">Skor Risiko</div>
                    <div style="font-size: 18px; font-weight: bold;">
                        {{ number_format($latestPrediction->skor_prediksi, 2) }}%
                    </div>
                </div>

                <div>
                    <div style="font-size: 13px; color: #6B7280;">Kategori Risiko</div>
                    <div style="font-size: 18px; font-weight: bold;">
                        @if($latestPrediction->kategori_risiko == 'Tinggi')
                            <span class="badge badge-danger">Tinggi</span>
                        @elseif($latestPrediction->kategori_risiko == 'Sedang')
                            <span class="badge" style="background: #FEF3C7; color: #92400E;">Sedang</span>
                        @else
                            <span class="badge badge-success">Rendah</span>
                        @endif
                    </div>
                </div>

                <div>
                    <div style="font-size: 13px; color: #6B7280;">Hasil Prediksi</div>
                    <div style="font-size: 18px; font-weight: bold;">
                        @if($latestPrediction->hasil_prediksi == 'Berisiko Resign')
                            <span class="badge badge-danger">Berisiko Resign</span>
                        @else
                            <span class="badge badge-success">Bertahan</span>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <p style="color: #6B7280;">
                Belum ada hasil prediksi untuk karyawan ini. Jalankan prediksi turnover terlebih dahulu.
            </p>
        @endif
    </div>

    <div class="table-card" style="margin-bottom: 24px;">
        <div class="section-title">Riwayat KPI</div>

        <table>
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Disiplin</th>
                    <th>Teamwork</th>
                    <th>Kecepatan Kerja</th>
                    <th>Total Score</th>
                    <th>Kategori</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employee->performances as $performance)
                    <tr>
                        <td>{{ $performance->bulan }}</td>
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
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Riwayat KPI belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-card" style="margin-bottom: 24px;">
        <div class="section-title">Riwayat Absensi Terbaru</div>

        <table>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Status Hadir</th>
                    <th>Jam Masuk</th>
                    <th>Telat</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employee->attendances as $attendance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}</td>
                        <td>
                            @if($attendance->hadir == 'Ya')
                                <span class="badge badge-success">Hadir</span>
                            @else
                                <span class="badge badge-danger">Tidak Hadir</span>
                            @endif
                        </td>
                        <td>{{ $attendance->jam_masuk ?? '-' }}</td>
                        <td>{{ $attendance->telat_menit }} menit</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Riwayat absensi belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="table-card">
        <div class="section-title">Riwayat Prediksi Turnover</div>

        <table>
            <thead>
                <tr>
                    <th>Tanggal Prediksi</th>
                    <th>Rata-rata KPI</th>
                    <th>Tidak Hadir</th>
                    <th>Total Telat</th>
                    <th>Skor Risiko</th>
                    <th>Kategori Risiko</th>
                    <th>Hasil Prediksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employee->turnoverPredictions as $prediction)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($prediction->tanggal_prediksi)->format('d M Y') }}</td>
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
                        <td colspan="7">Riwayat prediksi belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
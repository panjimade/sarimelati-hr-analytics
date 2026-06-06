<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Laporan HRIS</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Generate laporan data karyawan, absensi, KPI, dan prediksi turnover dalam format PDF atau Excel.
            </p>
        </div>
    </div>

    <div class="card" style="max-width: 760px;">
        <form method="GET" style="display: grid; grid-template-columns: 1fr 1fr; gap: 18px;">
            <div>
                <label style="font-weight: bold;">Periode Awal</label>
                <input 
                    type="date" 
                    name="periode_awal" 
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #D1D5DB; border-radius: 10px; margin-top: 8px;"
                >
            </div>

            <div>
                <label style="font-weight: bold;">Periode Akhir</label>
                <input 
                    type="date" 
                    name="periode_akhir" 
                    required
                    style="width: 100%; padding: 12px; border: 1px solid #D1D5DB; border-radius: 10px; margin-top: 8px;"
                >
            </div>

            <div style="grid-column: span 2; display: flex; gap: 12px; margin-top: 10px;">
                <button 
                    type="submit" 
                    formaction="{{ route('reports.export.pdf') }}"
                    class="btn-red"
                >
                    Export PDF
                </button>

                <button 
                    type="submit" 
                    formaction="{{ route('reports.export.excel') }}"
                    class="btn-red"
                    style="background: #166534;"
                >
                    Export Excel
                </button>
            </div>
        </form>
    </div>

    <div class="table-card" style="margin-top: 24px;">
        <div class="section-title">Isi Laporan</div>

        <table>
            <thead>
                <tr>
                    <th>Bagian</th>
                    <th>Data yang Ditampilkan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Data Karyawan</td>
                    <td>Kode, nama, divisi, jabatan, shift, dan status karyawan</td>
                </tr>
                <tr>
                    <td>Absensi</td>
                    <td>Total hadir, total tidak hadir, dan total keterlambatan</td>
                </tr>
                <tr>
                    <td>KPI</td>
                    <td>Rata-rata nilai performa karyawan</td>
                </tr>
                <tr>
                    <td>Prediksi Turnover</td>
                    <td>Skor prediksi, kategori risiko, dan hasil prediksi resign</td>
                </tr>
            </tbody>
        </table>
    </div>
</x-app-layout>
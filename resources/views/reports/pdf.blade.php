<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan HRIS Sarimelati</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #111827;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            color: #C8102E;
            margin-bottom: 4px;
        }

        .subtitle {
            font-size: 12px;
            color: #374151;
        }

        .periode {
            margin-bottom: 16px;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background: #C8102E;
            color: white;
            padding: 7px;
            border: 1px solid #9B0D23;
        }

        td {
            padding: 6px;
            border: 1px solid #D1D5DB;
        }

        tr:nth-child(even) {
            background: #F9FAFB;
        }

        .footer {
            margin-top: 24px;
            font-size: 10px;
            color: #6B7280;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">Sarimelati HR Analytics</div>
        <div class="subtitle">Laporan Monitoring Karyawan, Absensi, KPI, dan Prediksi Turnover</div>
    </div>

    <div class="periode">
        <strong>Periode:</strong>
        {{ \Carbon\Carbon::parse($periodeAwal)->format('d M Y') }}
        s/d
        {{ \Carbon\Carbon::parse($periodeAkhir)->format('d M Y') }}
    </div>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Divisi</th>
                <th>Jabatan</th>
                <th>Shift</th>
                <th>Status</th>
                <th>Hadir</th>
                <th>Tidak Hadir</th>
                <th>Total Telat</th>
                <th>Rata-rata KPI</th>
                <th>Skor Prediksi</th>
                <th>Risiko</th>
                <th>Hasil</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
                <tr>
                    <td>{{ $row['kode'] }}</td>
                    <td>{{ $row['nama'] }}</td>
                    <td>{{ $row['divisi'] }}</td>
                    <td>{{ $row['jabatan'] }}</td>
                    <td>{{ $row['shift'] }}</td>
                    <td>{{ $row['status'] }}</td>
                    <td>{{ $row['total_hadir'] }}</td>
                    <td>{{ $row['total_tidak_hadir'] }}</td>
                    <td>{{ $row['total_telat'] }} menit</td>
                    <td>{{ $row['rata_rata_kpi'] }}</td>
                    <td>{{ $row['skor_prediksi'] }}</td>
                    <td>{{ $row['kategori_risiko'] }}</td>
                    <td>{{ $row['hasil_prediksi'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d M Y H:i') }}
    </div>
</body>
</html>
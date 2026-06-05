<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Data Absensi</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Kelola data kehadiran karyawan berdasarkan tanggal, status hadir, jam masuk, dan keterlambatan.
            </p>
        </div>

        <a href="{{ route('attendances.create') }}" class="btn-red">
            Tambah Absensi
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
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Nama Karyawan</th>
                    <th>Status Hadir</th>
                    <th>Jam Masuk</th>
                    <th>Telat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attendances as $attendance)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d M Y') }}</td>
                        <td>{{ $attendance->employee->employee_code ?? '-' }}</td>
                        <td>{{ $attendance->employee->nama ?? '-' }}</td>
                        <td>
                            @if($attendance->hadir == 'Ya')
                                <span class="badge badge-success">Hadir</span>
                            @else
                                <span class="badge badge-danger">Tidak Hadir</span>
                            @endif
                        </td>
                        <td>{{ $attendance->jam_masuk ?? '-' }}</td>
                        <td>{{ $attendance->telat_menit }} menit</td>
                        <td>
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn-red" style="padding: 7px 10px;">
                                Edit
                            </a>

                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data absensi ini?')">
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
                        <td colspan="7">Data absensi belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $attendances->links() }}
        </div>
    </div>
</x-app-layout>
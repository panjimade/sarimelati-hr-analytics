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
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-card">
        @php
            $nextDirection = fn($column) => ($sort === $column && $direction === 'asc') ? 'desc' : 'asc';
            $sortUrl = fn($column) => request()->fullUrlWithQuery([
                'sort' => $column,
                'direction' => $nextDirection($column)
            ]);
            $sortIcon = fn($column) => $sort === $column ? ($direction === 'asc' ? '↑' : '↓') : '↕';
        @endphp
        <table>
            <thead>
                <tr>
                    <th>
                        <a href="{{ $sortUrl('Tanggal') }}" class="sort-link">
                            Tanggal <span class="sort-arrow">{{ $sortIcon('Tanggal') }}</span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ $sortUrl('Kode') }}" class="sort-link">
                            Kode <span class="sort-arrow">{{ $sortIcon('Kode') }}</span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ $sortUrl('Nama Karyawan') }}" class="sort-link">
                            Nama Karyawan <span class="sort-arrow">{{ $sortIcon('Nama Karyawan') }}</span>
                        </a>
                    </th>
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
                            <a href="{{ route('attendances.edit', $attendance->id) }}" class="btn-secondary" style="padding: 7px 10px;">
                                Edit
                            </a>

                            <form action="{{ route('attendances.destroy', $attendance->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data absensi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" style="padding: 7px 10px;">
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
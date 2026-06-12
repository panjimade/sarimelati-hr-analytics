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
                            Tanggal <span class="sort-arrow">{{ $sortIcon('tanggal') }}</span>
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
                        <a href="{{ $sortUrl('hadir') }}" class="sort-link">
                            Status Hadir <span class="sort-arrow">{{ $sortIcon('hadir') }}</span>
                        </a>
                    </th>
                    <th>Jam Masuk</th>
                    <th>
                        <a href="{{ $sortUrl('telat_menit') }}" class="sort-link">
                            Telat <span class="sort-arrow">{{ $sortIcon('telat_menit') }}</span>
                        </a>
                    </th>
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
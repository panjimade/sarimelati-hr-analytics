<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Data Karyawan</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Daftar karyawan berdasarkan dataset HRIS PT Sarimelati Kencana Tbk.
            </p>
        </div>

        <a href="{{ route('import.index') }}" class="btn-red">
            Import Excel
        </a>
    </div>

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
                        <a href="{{ $sortUrl('divisi') }}" class="sort-link">
                            Divisi <span class="sort-arrow">{{ $sortIcon('divisi') }}</span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ $sortUrl('jabatan') }}" class="sort-link">
                            Jabatan <span class="sort-arrow">{{ $sortIcon('jabatan') }}</span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ $sortUrl('shift') }}" class="sort-link">
                            Shift <span class="sort-arrow">{{ $sortIcon('shift') }}</span>
                        </a>
                    </th>
                    <th>
                        <a href="{{ $sortUrl('tanggal_masuk') }}" class="sort-link">
                            Tanggal Masuk <span class="sort-arrow">{{ $sortIcon('tanggal_masuk') }}</span>
                        </a>
                    </th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($employees as $employee)
                    <tr>
                        <td>{{ $employee->employee_code }}</td>
                        <td>{{ $employee->nama }}</td>
                        <td>{{ $employee->division->nama_divisi ?? '-' }}</td>
                        <td>{{ $employee->position->nama_jabatan ?? '-' }}</td>
                        <td>{{ $employee->shift }}</td>
                        <td>{{ \Carbon\Carbon::parse($employee->tanggal_masuk)->format('d M Y') }}</td>
                        <td>
                            @if($employee->status == 'Aktif')
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('employees.show', $employee->id) }}" class="btn-red" style="padding: 7px 10px;">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            Data karyawan belum tersedia. Silakan import file Excel terlebih dahulu.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $employees->links() }}
        </div>
    </div>
</x-app-layout>
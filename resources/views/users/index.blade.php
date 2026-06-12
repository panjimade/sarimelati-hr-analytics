<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Manajemen User</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Kelola akun pengguna sistem berdasarkan role akses.
            </p>
        </div>

        <a href="{{ route('users.create') }}" class="btn-red">
            Tambah User
        </a>
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

    <div class="table-card">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Dibuat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge badge-danger">Admin</span>
                            @elseif($user->role == 'supervisor')
                                <span class="badge" style="background:#DBEAFE; color:#1D4ED8;">Supervisor</span>
                            @else
                                <span class="badge badge-success">HRD/Manager</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                        <td>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn-secondary" style="padding: 7px 10px;">
                                Edit
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
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
                        <td colspan="5">Data user belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination-wrapper">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
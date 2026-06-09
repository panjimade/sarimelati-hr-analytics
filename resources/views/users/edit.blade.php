<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Edit User</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Perbarui data akun pengguna sistem.
            </p>
        </div>

        <a href="{{ route('users.index') }}" class="btn-red">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div style="background: #FEE2E2; color: #991B1B; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 720px;">
        <form action="{{ route('users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Nama User</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Password Baru</label>
                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengganti password" style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight:bold;">Role</label>
                <select name="role" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="supervisor" {{ old('role', $user->role) == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    <option value="hrd_manager" {{ old('role', $user->role) == 'hrd_manager' ? 'selected' : '' }}>HRD/Manager</option>
                </select>
            </div>

            <button type="submit" class="btn-red">
                Update User
            </button>
        </form>
    </div>
</x-app-layout>
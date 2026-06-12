<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Tambah User</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Buat akun baru untuk pengguna sistem.
            </p>
        </div>

        <a href="{{ route('users.index') }}" class="btn-red">
            Kembali
        </a>
    </div>

    @if($errors->any())
        <div class="alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 720px;">
        <form action="{{ route('users.store') }}" method="POST">
            @csrf

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Nama User</label>
                <input type="text" name="name" value="{{ old('name') }}" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 16px;">
                <label style="font-weight:bold;">Password</label>
                <input type="password" name="password" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="font-weight:bold;">Role</label>
                <select name="role" required style="width:100%; padding:12px; border:1px solid #D1D5DB; border-radius:10px; margin-top:8px;">
                    <option value="">Pilih Role</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="supervisor" {{ old('role') == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                    <option value="hrd_manager" {{ old('role') == 'hrd_manager' ? 'selected' : '' }}>HRD/Manager</option>
                </select>
            </div>

            <button type="submit" class="btn-red">
                Simpan User
            </button>
        </form>
    </div>
</x-app-layout>
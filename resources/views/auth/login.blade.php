<x-guest-layout>
    <div class="login-logo">
        HR
    </div>

    <div class="login-title">
        Masuk ke Sistem
    </div>

    <div class="login-subtitle">
        Gunakan akun yang telah terdaftar untuk mengakses dashboard Sarimelati HR Analytics.
    </div>

    @if ($errors->any())
        <div class="error-box">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-group">
            <label for="email" class="input-label">Email</label>
            <input 
                id="email" 
                class="input-field" 
                type="email" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autofocus 
                autocomplete="username"
                placeholder="Masukkan email"
            >
        </div>

        <div class="form-group">
            <label for="password" class="input-label">Password</label>
            <input 
                id="password" 
                class="input-field"
                type="password"
                name="password"
                required 
                autocomplete="current-password"
                placeholder="Masukkan password"
            >
        </div>

        <div class="remember-row">
            <label style="display: flex; align-items: center; gap: 8px;">
                <input type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    Lupa password?
                </a>
            @endif
        </div>

        <button type="submit" class="login-button">
            Login
        </button>
    </form>

</x-guest-layout>
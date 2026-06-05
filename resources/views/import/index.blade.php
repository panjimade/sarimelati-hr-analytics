<x-app-layout>
    <div class="page-header">
        <div>
            <div class="page-title">Import Dataset HRIS</div>
            <p style="color: #6B7280; margin-top: 6px;">
                Upload file Excel berisi data Employees, Attendance, Performance, dan Turnover.
            </p>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #DCFCE7; color: #166534; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="background: #FEE2E2; color: #991B1B; padding: 14px; border-radius: 12px; margin-bottom: 20px;">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="card" style="max-width: 620px;">
        <form action="{{ route('import.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label style="display: block; margin-bottom: 8px; font-weight: bold;">
                Pilih File Excel
            </label>

            <input 
                type="file" 
                name="file" 
                accept=".xlsx,.xls"
                required
                style="width: 100%; padding: 12px; border: 1px solid #D1D5DB; border-radius: 10px; margin-bottom: 18px;"
            >

            <button type="submit" class="btn-red">
                Import Excel
            </button>
        </form>
    </div>
</x-app-layout>
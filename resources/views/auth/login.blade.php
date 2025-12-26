@extends('layouts.login')

@section('content')
    <div class="login-container">
        <div class="card-header">
            <img src="{{ asset('assets/logo umri png.png') }}" alt="Logo RS" class="logo">
            <h3>Rumah Sakit Universitas Muhammadiyah Riau</h3>
            <h2>Sistem Janji Temu</h2>
        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Masukkan username Anda" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required>

            <input type="hidden" name="user_type" value="doctor">

            <input type="submit" value="Masuk">
        </form>

        <p class="form-footer-text">
            Belum memiliki akun? 
            <a href="{{ route('register.patient.form') }}" style="font-weight: 700;">Daftar sebagai Pasien</a>
        </p>

        @if (session('message'))
            <div class="alert-message">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div id="current-datetime"></div>

    <script>
        function updateDateTime() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('current-datetime').innerText = now.toLocaleString('id-ID', options);
        }
        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
@endsection
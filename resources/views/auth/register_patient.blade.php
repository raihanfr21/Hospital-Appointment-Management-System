@extends('layouts.login')

@section('content')
<div class="login-container">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('assets/logo umri png.png') }}" alt="Logo RS" class="logo" style="width: 70px; margin-bottom: 10px;">
        <h2 style="font-size: 20px; margin-bottom: 5px;">Registrasi Pasien</h2>
        <p style="font-size: 12px; color: #718096;">Daftar untuk membuat janji temu</p>
    </div>

    <form action="{{ route('register.patient') }}" method="POST">
        @csrf
        
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Sesuai KTP" required>
        
        <label>Username</label>
        <input type="text" name="username" placeholder="Buat username anda" required>
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Rahasiakan password anda" required>
        
        <label>NIK</label>
        <input type="number" name="nik" placeholder="16 digit NIK" required>
        
        <label>Alamat</label>
        <input type="text" name="alamat" placeholder="Alamat domisili saat ini" required>
        
        <label>Nomor WhatsApp</label>
        <input type="number" name="no_whatsapp" placeholder="Contoh: 08123456789" required>
        
        <input type="submit" value="Buat Akun">
    </form>

    <p style="margin-top: 20px;">Sudah memiliki akun? <a href="{{ route('login') }}">Login disini</a></p>
</div>
@endsection
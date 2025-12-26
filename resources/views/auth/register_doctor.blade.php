@extends('layouts.login')

@section('content')
<div class="login-container">
    <div style="text-align: center; margin-bottom: 20px;">
        <img src="{{ asset('assets/logo umri png.png') }}" alt="Logo RS" class="logo" style="width: 70px; margin-bottom: 10px;">
        <h2 style="font-size: 20px; margin-bottom: 5px;">Registrasi Dokter</h2>
        <p style="font-size: 12px; color: #718096;">Silakan lengkapi data diri Anda</p>
    </div>

    <form action="{{ route('register.doctor') }}" method="POST">
        @csrf
        
        <label>Nama Lengkap</label>
        <input type="text" name="nama" placeholder="Contoh: dr. Arief" required>
        
        <label>Username</label>
        <input type="text" name="username" placeholder="Buat username unik" required>
        
        <label>Password</label>
        <input type="password" name="password" placeholder="Minimal 6 karakter" required>
        
        <label>Spesialisasi</label>
        <select name="spesialis_id" required>
            <option value="">-- Pilih Spesialisasi --</option>
            @foreach($specializations as $specialization)
                <option value="{{ $specialization->id }}">{{ $specialization->nama }}</option>
            @endforeach
        </select>
        
        <input type="submit" value="Buat Akun">
    </form>

    <p style="margin-top: 20px;">Sudah memiliki akun? <a href="{{ route('login') }}">Login disini</a></p>
</div>
@endsection
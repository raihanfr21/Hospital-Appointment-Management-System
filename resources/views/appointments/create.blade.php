@extends('layouts.app')

@section('content')
<h1>Buat Janji Temu</h1>
<p>Lengkapi form berikut untuk membuat janji temu dengan dokter Rumah Sakit Universitas Muhammadiyah Riau</p>
<div class="form-container">
    <form action="{{ route('appointments.store') }}" method="POST">
        @csrf

        <input type="text" name="full_name" id="full_name" placeholder="Nama Lengkap" required>
        <input type="text" name="no_whatsapp" id="no_whatsapp" placeholder="Nomor WhatsApp" required>
        <input type="text" name="nik" id="nik" placeholder="NIK Sesuai KTP" required>
        <input type="text" name="address" id="address" placeholder="Alamat" required>
        <select name="doctor_id" id="doctor_id" required>
            <option value="">Pilih Dokter</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->nama }}</option>
            @endforeach
        </select>
        <input type="date" name="date" id="date" required>
        <input type="time" name="time" id="time" required>
        <textarea name="complaint" id="complaint" placeholder="Keluhan" required></textarea>
        <label>Memiliki Riwayat Penyakit Tertentu? (cth: Diabetes, Hipertensi, Jantung, dll)</label>
        <label><input type="checkbox" name="riwayat_penyakit" value="ya"> Ya</label>
        <label><input type="checkbox" name="riwayat_penyakit" value="tidak"> Tidak</label>
        <select name="payment_type" id="payment_type" required>
            <option value="">Pilih Tipe Pembayaran</option>
            <option value="Umum">Umum</option>
            <option value="BPJS Kesehatan">BPJS Kesehatan</option>
        </select>

        <input type="submit" value="Buat Janji Temu">
    </form>
</div>
@endsection
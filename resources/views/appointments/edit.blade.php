@extends('layouts.app')

@section('content')
<h1>Edit Janji Temu</h1>
<p>Ubah informasi janji temu Anda di bawah ini.</p>
<div class="form-container">
    <form action="{{ route('appointments.edit', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT') <!-- Menyatakan bahwa ini adalah permintaan PUT -->

        <input type="text" name="full_name" id="full_name" placeholder="Nama Lengkap" value="{{ old('full_name', $appointment->full_name) }}" required>
        <input type="text" name="no_whatsapp" id="no_whatsapp" placeholder="Nomor WhatsApp" value="{{ old('no_whatsapp', $appointment->no_whatsapp) }}" required>
        <input type="text" name="nik" id="nik" placeholder="NIK Sesuai KTP" value="{{ old('nik', $appointment->nik) }}" required>
        <input type="text" name="address" id="address" placeholder="Alamat" value="{{ old('address', $appointment->address) }}" required>
        
        <select name="doctor_id" id="doctor_id" required>
            <option value="">Pilih Dokter</option>
            @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}" {{ $doctor->id == $appointment->doctor_id ? 'selected' : '' }}>{{ $doctor->nama }}</option>
            @endforeach
        </select>

        <input type="date" name="date" id="date" value="{{ old('date', $appointment->date) }}" required>
        <input type="time" name="time" id="time" value="{{ old('time', $appointment->time) }}" required>
        <textarea name="complaint" id="complaint" placeholder="Keluhan" required>{{ old('complaint', $appointment->complaint) }}</textarea>

        <label>Memiliki Riwayat Penyakit Tertentu? (cth: Diabetes, Hipertensi, Jantung, dll)</label>
        <label><input type="checkbox" name="riwayat_penyakit" value="ya" {{ $appointment->riwayat_penyakit == 'ya' ? 'checked' : '' }}> Ya</label>
        <label><input type="checkbox" name="riwayat_penyakit" value="tidak" {{ $appointment->riwayat_penyakit == 'tidak' ? 'checked' : '' }}> Tidak</label>

        <select name="payment_type" id="payment_type" required>
            <option value="">Pilih Tipe Pembayaran</option>
            <option value="Umum" {{ $appointment->payment_type == 'Umum' ? 'selected' : '' }}>Umum</option>
            <option value="BPJS Kesehatan" {{ $appointment->payment_type == 'BPJS Kesehatan' ? 'selected' : '' }}>BPJS Kesehatan</option>
        </select>

        <input type="submit" value="Update Janji Temu">
    </form>
</div>
@endsection
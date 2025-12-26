<!-- resources/views/user_dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="halo-user">Halo, {{ htmlspecialchars($user_name) }}</div>
    <h1>Cari Dokter</h1>
    <p>Percayakan kesehatan Anda kepada dokter spesialis terbaik di Rumah Sakit Universitas Muhammadiyah Riau</p>

    <div class="search-bar">
        <form action="{{ route('dashboard.patient') }}" method="GET">
            <input type="text" name="search" id="search" placeholder="Cari Nama Dokter" value="{{ request('search') }}">
            <select name="spesialis" id="spesialis">
                <option value="">Pilih Spesialis/Poliklinik</option>
                @foreach ($specializations as $spesialis)
                    <option value="{{ $spesialis->id }}" {{ request('spesialis') == $spesialis->id ? 'selected' : '' }}>
                        {{ $spesialis->nama }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="doctor-cards">
        @if ($dokter_result && $dokter_result->count() > 0)
            @foreach ($dokter_result as $dokter)
                <div class="doctor-card">
                    <img src="{{ asset('assets/logodokter.jpg') }}" alt="Foto Dokter" class="doctor-photo">
                    <p><strong>{{ htmlspecialchars($dokter->specialization->nama) }}</strong></p>
                    <p>{{ htmlspecialchars($dokter->nama) }}</p>
                </div>
            @endforeach
        @else
            <p>Tidak ada dokter yang ditemukan.</p>
        @endif
    </div>
</div>
@endsection
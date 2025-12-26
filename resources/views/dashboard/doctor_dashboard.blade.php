<!-- resources/views/doctor_dashboard.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="halo-user">Halo, {{ htmlspecialchars($user_name) }}</div>
    <h1>Statistik Janji Temu</h1>
    <div class="kotak-container">
        <div class="kotak">
            <h2>Antrian Menunggu</h2>
            <h2>{{ $total_antri }}</h2>
        </div>
        <div class="kotak">
            <h2>Selesai Ditangani</h2>
            <h2>{{ $total_selesai }}</h2>
        </div>
    </div>
</div>
@endsection
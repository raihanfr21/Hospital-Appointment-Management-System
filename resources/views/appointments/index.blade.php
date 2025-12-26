@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Daftar Janji Temu</h1>
    <p>Lihat janji temu yang telah Anda ajukan disini</p>
    <table>
        <thead>
            <tr>
                <th>Dokter</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>Keluhan</th>
                <th>Tipe Pembayaran</th>
                <th>Aksi</th> <!-- Tambahkan kolom aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->doctor->nama }}</td>
                    <td>{{ $appointment->tanggal }}</td>
                    <td>{{ $appointment->waktu }}</td>
                    <td>{{ $appointment->keluhan }}</td>
                    <td>{{ $appointment->pembayaran }}</td>
                    <td>
                        <!-- Tombol Edit -->
                        <a href="{{ route('appointments.edit', $appointment->id) }}" class="btn btn-primary">Edit</a>
                        
                        <!-- Tombol Delete -->
                        <form action="{{ route('appointments.destroy', $appointment->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah Anda yakin ingin menghapus janji temu ini?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
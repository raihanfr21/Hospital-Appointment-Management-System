<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $userId = auth()->id();
    
        // Ambil janji temu yang dibuat oleh pengguna ini
        $appointments = Appointment::where('pasien_id', $userId)->with('doctor')->get();
    
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('appointments.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:dokter,id',
            'date' => 'required|date',
            'time' => 'required',
            'complaint' => 'required',
            'payment_type' => 'required|in:Umum,BPJS Kesehatan',
        ]);

        Appointment::create([
            'pasien_id' => auth()->user()->id,
            'dokter_id' => $request->doctor_id,
            'tanggal' => $request->date,
            'waktu' => $request->time,
            'keluhan' => $request->complaint,
            'pembayaran' => $request->payment_type,
            'status' => 'antri',
            'riwayat_penyakit' => 'tidak',
        ]);

        return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dibuat.');
    }

    public function edit($id)
{
    $appointment = Appointment::findOrFail($id);
    $doctors = Doctor::all(); // Ambil semua dokter untuk dropdown
    return view('appointments.edit', compact('appointment', 'doctors'));
}

public function destroy($id)
{
    $appointment = Appointment::findOrFail($id);
    $appointment->delete();
    return redirect()->route('appointments.index')->with('success', 'Janji temu berhasil dihapus.');
}
}
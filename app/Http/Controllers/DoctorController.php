<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;

class DoctorController extends Controller
{
    public function showRegisterForm()
    {
        $specializations = Specialization::all();
        return view('auth.register_doctor', compact('specializations'));
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users_dokter',
            'password' => 'required',
            'nama' => 'required',
            'spesialis_id' => 'required|exists:spesialis,id', // Pastikan spesialisasi ada
        ]);

        // Buat dokter di tabel users_dokter
        $doctorUser  = Doctor::create([
            'username' => $request->username,
            'password' => Hash::make($request->password), // Hash password
            'nama' => $request->nama,
            'spesialis_id' => $request->spesialis_id,
        ]);

        // Buat entri di tabel dokter
        DB::table('dokter')->insert([
            'id' => $doctorUser ->id, // Menggunakan ID pengguna yang baru dibuat
            'nama' => $request->nama, // Pastikan nama juga disimpan di tabel dokter
            'spesialis_id' => $request->spesialis_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Akun dokter berhasil dibuat.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cek apakah pengguna adalah dokter
        $doctor = Doctor::where('username', $request->username)->first();

        if ($doctor && Hash::check($request->password, $doctor->password)) {
            auth()->login($doctor);
            return redirect()->route('dashboard.doctor'); // Arahkan ke dashboard dokter
        }

        return back()->withErrors(['username' => 'Username atau password salah.']);
    }

    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $user_name = $user->nama; // Ambil nama pengguna

        // Logika untuk dashboard dokter
        $total_antri = Appointment::where('dokter_id', $user->id)->where('status', 'antri')->count();
        $total_selesai = Appointment::where('dokter_id', $user->id)->where('status', 'selesai')->count();

        return view('dashboard.doctor_dashboard', compact('user_name', 'total_antri', 'total_selesai'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
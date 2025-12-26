<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Doctor;
use App\Models\Specialization;

class PatientController extends Controller
{
    public function showRegisterForm()
    {
        return view('auth.register_patient');
    }

    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users_pasien',
            'password' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_whatsapp' => 'required',
        ]);

        // Buat pengguna di tabel users
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_whatsapp' => $request->no_whatsapp,
        ]);

        // Buat entri di tabel pasien
        DB::table('pasien')->insert([
            'id' => $user->id, // Menggunakan ID pengguna yang baru dibuat
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_whatsapp' => $request->no_whatsapp,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('login')->with('success', 'Akun pasien berhasil dibuat.');
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

        // Cek apakah pengguna adalah pasien
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            auth()->login($user);
            return redirect()->route('dashboard.patient'); // Arahkan ke dashboard pasien
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

        // Logika untuk dashboard pasien
        $specializations = Specialization::all(); // Ambil semua spesialisasi
        $search = request()->get('search', '');
        $spesialis_id = request()->get('spesialis', 0);

        $dokter_query = Doctor::with('specialization')->where('nama', 'like', "%$search%");

        if ($spesialis_id) {
            $dokter_query->where('spesialis_id', $spesialis_id);
        }

        $dokter_result = $dokter_query->get();

        return view('dashboard.patient_dashboard', compact('user_name', 'specializations', 'dokter_result'));
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
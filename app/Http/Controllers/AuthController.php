<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Appointment;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; // Pastikan ini di-import

class AuthController extends Controller
{
    // ... (Fungsi register biarkan saja seperti sebelumnya) ...

    public function showDoctorRegisterForm()
    {
        $specializations = Specialization::all();
        return view('auth.register_doctor', compact('specializations'));
    }

    public function registerDoctor(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users_dokter',
            'password' => 'required',
            'nama' => 'required',
            'spesialis_id' => 'required|exists:spesialis,id',
        ]);
    
        $doctorUser  = Doctor::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'spesialis_id' => $request->spesialis_id,
        ]);
    
        DB::table('dokter')->insert([
            'id' => $doctorUser ->id,
            'nama' => $request->nama,
            'spesialis_id' => $request->spesialis_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->route('login')->with('success', 'Akun dokter berhasil dibuat.');
    }

    public function showPatientRegisterForm()
    {
        return view('auth.register_patient');
    }

    public function registerPatient(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required',
            'nama' => 'required',
            'nik' => 'required',
            'alamat' => 'required',
            'no_whatsapp' => 'required',
        ]);

        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'nama' => $request->nama,
            'nik' => $request->nik,
            'alamat' => $request->alamat,
            'no_whatsapp' => $request->no_whatsapp,
        ]);

        DB::table('pasien')->insert([
            'id' => $user->id,
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

    // --- BAGIAN INI YANG DIUBAH TOTAL ---
    public function login(Request $request)
    {
        // 1. Hapus validasi 'user_type', kita tidak butuh itu lagi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // 2. Cek Pertama: Apakah yang login adalah DOKTER?
        $doctor = Doctor::where('username', $request->username)->first();

        if ($doctor && Hash::check($request->password, $doctor->password)) {
            auth()->login($doctor);
            // Tambahkan session role agar dashboard tahu siapa yang login (opsional tapi berguna)
            session(['role' => 'doctor']); 
            return redirect()->route('dashboard.doctor');
        }

        // 3. Cek Kedua: Jika bukan dokter, apakah PASIEN?
        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            auth()->login($user);
            // Tambahkan session role
            session(['role' => 'patient']);
            return redirect()->route('dashboard.patient');
        }

        // 4. Jika keduanya tidak cocok
        return back()->withErrors(['username' => 'Username atau password salah.']);
    }
    // ------------------------------------

    public function dashboard()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();
        $user_name = $user->nama;

        $total_antri = 0;
        $total_selesai = 0;
        $specializations = Specialization::all();
        $dokter_result = null;

        // Cek tipe user menggunakan Instanceof atau Session yang kita set tadi
        if ($user instanceof Doctor) {
            $total_antri = Appointment::where('dokter_id', $user->id)->where('status', 'antri')->count();
            $total_selesai = Appointment::where('dokter_id', $user->id)->where('status', 'selesai')->count();
            
            return view('dashboard.doctor_dashboard', compact('user_name', 'total_antri', 'total_selesai'));
        } 
        // Jika Pasien (User biasa)
        elseif ($user instanceof User) {
            $search = request()->get('search', '');
            $spesialis_id = request()->get('spesialis', 0);

            $dokter_query = Doctor::with('specialization')->where('nama', 'like', "%$search%");

            if ($spesialis_id) {
                $dokter_query->where('spesialis_id', $spesialis_id);
            }

            $dokter_result = $dokter_query->get();

            return view('dashboard.patient_dashboard', compact('user_name', 'specializations', 'dokter_result'));
        }

        return redirect()->route('login');
    }

    public function logout()
    {
        auth()->logout();
        // Hapus session role saat logout
        session()->forget('role');
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
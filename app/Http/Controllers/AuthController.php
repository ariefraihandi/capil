<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Role;
use App\Models\EmailVerificationToken;
use App\Models\WhatsappVerificationToken;
use App\Mail\VerifyEmail;
use Exception;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        $data = [
            'title' => 'Login Portal',
            'subtitle' => 'PA Muara Enim',
            'meta_description' => 'Login to access the PA Muara Enim Portal.',
            'meta_keywords' => 'login, portal, PA Muara Enim'
        ];

        return view('Auth.login', $data);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email-username', 'password');
    
        // Cek apakah input adalah email atau username
        $loginField = filter_var($credentials['email-username'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    
        // Buat array untuk kredensial berdasarkan input pengguna
        $credentialsToAttempt = [
            $loginField => $credentials['email-username'],
            'password' => $credentials['password']
        ];
    
        // Coba melakukan autentikasi
        if (Auth::attempt($credentialsToAttempt)) {
            // Ambil data pengguna
            $user = User::where($loginField, $credentials['email-username'])->first();             
    
            // Cek role pengguna berdasarkan role_id
            $roleName = Role::where('id', $user->role)->value('name'); // Ambil nama role dari tabel roles berdasarkan id
    
            if ($roleName === 'dukcapil') {
                // Jika role adalah DUKCAPIL, arahkan ke route khusus
                return redirect()->route('aplikasi.siramasakan')->with('response', [
                    'success' => true,
                    'title' => 'Berhasil',
                    'message' => 'Anda berhasil login sebagai DUKCAPIL.',
                ]);
            }
    
            // Ambil URL tujuan dari sesi atau default ke halaman profil
            $intendedUrl = Session::get('url.intended', route('aplikasi.siramasakan'));
    
            // Bersihkan URL tujuan dari sesi
            Session::forget('url.intended');
    
            $response = [
                'success' => true,
                'title' => 'Berhasil',
                'message' => 'Anda berhasil login.',
            ];
    
            // Redirect ke URL yang disimpan di sesi atau ke halaman profil
            return redirect()->intended($intendedUrl)->with('response', $response);
        }
    
        // Autentikasi gagal, buat pesan kesalahan
        $errorMessage = 'Username/Email dan Password Salah';
    
        // Buat respons untuk SweetAlert
        $response = [
            'success' => false,
            'title' => 'Gagal',
            'message' => $errorMessage,
        ];
    
        // Kembalikan respons ke halaman login
        return redirect()->back()->with('response', $response);
    }
    

    public function showRegisterForm()
    {
        $data = [
            'title' => 'Register Portal',
            'subtitle' => 'Portal MS Lhokseumawe',
            'meta_description' => 'Register to access the MS Lhokseumawe Portal.',
            'meta_keywords' => 'Register, portal, MS Lhokseumawe'
        ];

        return view('Auth.register', $data);
    }

    public function submitRegister(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'whatsapp' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:5|confirmed',
        ]);

        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Membuat user baru dengan data dari form dan default data
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->whatsapp = $request->input('whatsapp', 'default_whatsapp'); // Default whatsapp jika kosong
            $user->role = 1; // Menetapkan role = 1
            $user->password = Hash::make($request->input('password')); // Password yang di-hash
            $user->save(); // Simpan user

            // Membuat user detail dengan data default selain inputan form
            $userDetail = new UserDetail();
            $userDetail->user_id = $user->id;
            $userDetail->name = $request->input('username'); // Gunakan username sebagai name jika tidak ada input nama lengkap
            $userDetail->jabatan = 'Administrator'; // Default jabatan adalah 'Staff'
            $userDetail->image = 'logo.png'; // Default image
            $userDetail->nip = '1234567890'; // Default NIP
            $userDetail->whatsapp = $request->input('whatsapp', 'default_whatsapp');
            $userDetail->tlahir = '1990-01-01'; // Default tanggal lahir
            $userDetail->tglahir = '1990-01-01'; // Default tanggal lahir
            $userDetail->kelamin = '1'; // Default kelamin
            $userDetail->alamat = 'PA Muara Enim, Indonesia'; // Default alamat
            $userDetail->instansi = 'PA Muara Enim'; // Default instansi
            $userDetail->posisi = 'Satuan Kerja'; // Default posisi
            $userDetail->lastmodified = now(); // Tanggal modifikasi terakhir
            $userDetail->save(); // Simpan user detail

            // Jika semua berhasil, commit transaksi
            DB::commit();

            // Redirect ke halaman login dengan response pesan
            return redirect()->route('login.view')->with([
                'response' => [
                    'success' => 'Pendaftaran Berhasil',
                    'title' => 'Success',
                    'message' => 'Silahkan login',
                ],
            ]);
        } catch (\Exception $e) {
            // Jika ada error, rollback transaksi
            DB::rollBack();

            // Tangkap error message dan kirimkan ke session untuk ditampilkan
            $errorMessage = $e->getMessage(); // Mendapatkan pesan error

            // Redirect kembali dengan pesan error
            return redirect()->back()->with([
                'response' => [
                    'success' => 'Pendaftaran Gagal',
                    'title' => 'Error',
                    'message' => 'Terjadi kesalahan: ' . $errorMessage, // Tampilkan error message
                ],
            ]);
        }
    }



    

    public function verifyEmail(Request $request)
    {
        try {
            $uniqueId = $request->query('token');
            $decodedParams = base64_decode($uniqueId);
    
            // Mendekode string menjadi array asosiatif
            parse_str($decodedParams, $params);
    
            // Mendapatkan email dan token dari array
            $email = $params['email'] ?? null;
            $token = $params['token'] ?? null;

            // dd($decodedParams, $params);
    
            if (!$email || !$token) {
                throw new Exception('Token verifikasi email tidak valid.');
            }
    
            // Menggunakan transaksi untuk mengelola pengecualian secara keseluruhan
            DB::beginTransaction();
    
            // Mengambil token verifikasi
            $verificationToken = EmailVerificationToken::where('email', $email)
                ->where('token', $token)
                ->first();
    
            // Jika token tidak ditemukan atau sudah kadaluarsa
            if (!$verificationToken || $verificationToken->expires_at < now()) {
                throw new Exception('Token verifikasi email tidak valid atau sudah kadaluarsa.');
            }
    
            // Ubah status verifikasi email pada user
            $user = User::where('email', $email)->first();
            if (!$user) {
                throw new Exception('User tidak ditemukan.');
            }
            $user->email_verified_at = now(); // Isi dengan waktu verifikasi email
            $user->save();
    
            // Hapus token verifikasi dari database
            EmailVerificationToken::where('email', $email)->delete();
    
            // Commit transaksi jika tidak ada pengecualian
            DB::commit();
    
            // Set response untuk pesan sukses
            $response = [
                'success' => true,
                'title' => 'Berhasil',
                'message' => 'Akun anda berhasil terverifikasi. Silakan login.',
            ];
    
            // Redirect pengguna ke halaman login dengan pesan sukses
            return redirect()->route('login.view')->with('response', $response);
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi pengecualian
            DB::rollBack();
    
            // Set response untuk pesan kesalahan
            $response = [
                'success' => false,
                'title' => 'Gagal',
                'message' => $e->getMessage(),
            ];
    
            // Redirect pengguna ke halaman login dengan pesan kesalahan
            return redirect()->route('login.view')->with('response', $response);
        }
    }
    

    public function verifyWhatsapp(Request $request)
    {
        try {
            $uniqueId = $request->query('verify');
            $decodedParams = base64_decode($uniqueId);

            // Mendekode string menjadi array asosiatif
            parse_str($decodedParams, $params);

            // Mendapatkan whatsapp dan token dari array
            $whatsapp = $params['whatsapp'];
            $token = $params['token'];

            // Menggunakan transaksi untuk mengelola pengecualian secara keseluruhan
            DB::beginTransaction();

            // Mengambil token verifikasi
            $verificationToken = WhatsappVerificationToken::where('whatsapp', $whatsapp)
                ->where('token', $token)
                ->first();

            // Jika token tidak ditemukan atau sudah kadaluarsa
            if (!$verificationToken || $verificationToken->expires_at < now()) {
                throw new Exception('Token verifikasi WhatsApp tidak valid atau sudah kadaluarsa.');
            }

            // Ubah status verifikasi WhatsApp pada user
            $user = User::where('whatsapp', $whatsapp)->first();
            if (!$user) {
                throw new Exception('User tidak ditemukan.');
            }
            $user->whatsapp_verified_at = now(); // Isi dengan waktu verifikasi WhatsApp
            $user->save();

            // Hapus token verifikasi dari database
            WhatsappVerificationToken::where('whatsapp', $whatsapp)->delete();

            // Commit transaksi jika tidak ada pengecualian
            DB::commit();

            // Set response untuk pesan sukses
            $response = [
                'success' => true,
                'title' => 'Berhasil',
                'message' => 'WhatsApp anda berhasil Terverifikasi. Silahkan Login',
            ];

            // Redirect pengguna ke halaman login dengan pesan sukses
            return redirect()->route('login.view')->with('response', $response);
        } catch (Exception $e) {
            // Rollback transaksi jika terjadi pengecualian
            DB::rollBack();

            // Set response untuk pesan kesalahan
            $response = [
                'success' => false,
                'title' => 'Gagal',
                'message' => $e->getMessage(),
            ];

            // Redirect pengguna ke halaman login dengan pesan kesalahan
            return redirect()->route('login.view')->with('response', $response);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/auth');
    }
}

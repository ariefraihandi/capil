<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sign;
use App\Models\User;
use App\Models\Role;
use App\Models\PemohonInformasi;
use App\Models\SignsUbahStatus;

class BarcodeController extends Controller
{
    /**
     * Handle the incoming request for scanning and get user details.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
    
    public function getSignDataSiramasakan(Request $request)
    {
        // Ambil eSign dari query parameter
        $eSign = $request->query('eSign');

        // Validasi input eSign untuk memastikan bahwa ID tidak kosong
        if (empty($eSign)) {
            return response()->json(['message' => 'Invalid eSign ID'], 400);
        }

        // Cari data berdasarkan eSign sebagai id di tabel Sign
        $signData = SignsUbahStatus::where('id', $eSign)->first();

        // Lihat data yang ditemukan
        if ($signData) {
            // Ambil data user berdasarkan user_id dari signData
            $user = PemohonInformasi::find($signData->pemohon_id);

            // Siapkan data untuk dikirim ke view
            $data = [
                'title'         => 'Detail Tanda Tangan Elektronik',
                'subtitle'      => 'Portal MS Lhokseumawe',
                'sidebar'       => 'Your Sidebar Data', // Ganti dengan data sidebar Anda
                'sign'          => $signData,  // Data eSign yang diambil
                'user'          => $user,      // Data user yang terkait               
            ];

            // Kirim data ke view .blade
            return view('LandingPage.Barcode.signSiramasakan', $data);
        } else {
            // Jika sign tidak ditemukan, kembalikan respon dengan pesan error
            return response()->json(['message' => 'Sign data not found'], 404);
        }
    }
}

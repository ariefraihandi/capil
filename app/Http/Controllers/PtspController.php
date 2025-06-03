<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserDetail;
use App\Models\Perkara;
use App\Models\Role;
use App\Models\SyaratPerkara;
use App\Models\PemohonUbahStatus;
use App\Models\Feedback;
use App\Models\Pekerjaan;
use App\Models\Pendidikan;
use App\Models\SignsUbahStatus;
use App\Models\PemohonInformasi;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use PDF;
use DataTables;
use Exception;

class PtspController extends Controller
{    
    public function uploadDocument(Request $request)
    {        
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Validasi input dari form
            $validatedData = $request->validate([
                'nama' => 'required|string|max:255',
                'NIK' => 'required|string|max:255',
                'jenisperkara' => 'required|string|max:255',
                'whatsapp' => 'required|string|max:15',
                'email' => 'nullable|string|max:255',
                'upload_option' => 'required|in:manual,url',
                'document' => 'nullable|file|mimes:pdf,jpeg,png', // Validasi file jika upload document
                'external_url' => 'nullable|url', // Validasi external URL                
                'status_awal' => 'nullable|string|max:255',
                'status_baru' => 'nullable|string|max:255',
                'jalan_awal' => 'nullable|string|max:255', // Nullable untuk jalan_awal
                'jalan_baru' => 'nullable|string|max:255', // Nullable untuk jalan_baru
                'rt_rw_awal' => 'nullable|string|max:255', // Nullable untuk rt_rw_awal
                'rt_rw_baru' => 'nullable|string|max:255', // Nullable untuk rt_rw_baru
                'kel_des_awal' => 'nullable|string|max:255', // Nullable untuk kel_des_awal
                'kel_des_baru' => 'nullable|string|max:255', // Nullable untuk kel_des_baru
                'kec_awal' => 'nullable|string|max:255', // Nullable untuk kec_awal
                'kec_baru' => 'nullable|string|max:255', // Nullable untuk kec_baru
                'kab_kota_awal' => 'nullable|string|max:255', // Nullable untuk kab_kota_awal
                'kab_kota_baru' => 'nullable|string|max:255', // Nullable untuk kab_kota_baru
                'provinsi_awal' => 'nullable|string|max:255', // Nullable untuk provinsi_awal
                'provinsi_baru' => 'nullable|string|max:255', // Nullable untuk provinsi_baru
        
            ]);
    
            // Default values for fields that are not present in the form
            $defaultValues = [
                'alamat' => 'Alamat Tidak Diketahui',                
                'jenis_permohonan' => 'Permohonan',  // Default value for jenis_permohonan
                'jenis_perkara_gugatan' => null,
                'jenis_perkara_permohonan' => null,
                'rincian_informasi' => null,
                'tujuan_penggunaan' => null,
                'pendidikan' => '1',  // Default pendidikan
                'jenis_kelamin' => 'Laki-laki',  // Default jenis kelamin
                'umur' => 30, // Default umur
            ];
    
            // Create PemohonInformasi
            $pemohon = PemohonInformasi::create([
                'nama' => $validatedData['nama'],
                'alamat' => $validatedData['alamat'] ?? $defaultValues['alamat'],                
                'whatsapp' => $validatedData['whatsapp'],
                'email' => $validatedData['email'] ?? '-',  // Default email
                'jenis_permohonan' => $validatedData['jenisperkara'] ?? $defaultValues['jenis_permohonan'],
                'jenis_perkara_gugatan' => $defaultValues['jenis_perkara_gugatan'],
                'jenis_perkara_permohonan' => $defaultValues['jenis_perkara_permohonan'],
                'rincian_informasi' => $validatedData['rincian_informasi'] ?? $defaultValues['rincian_informasi'],
                'tujuan_penggunaan' => $validatedData['tujuan_penggunaan'] ?? $defaultValues['tujuan_penggunaan'],
                'ubah_status' => $request->has('ubah_status') ? '1' : null,
                'pendidikan' => $validatedData['pendidikan'] ?? $defaultValues['pendidikan'],
                'NIK' => $validatedData['NIK'],
                'umur' => $validatedData['umur'] ?? $defaultValues['umur'],
                'jenis_kelamin' => $validatedData['jenis_kelamin'] ?? $defaultValues['jenis_kelamin'],
            ]);
    
            // Sign message construction
            $pengajuan = $validatedData['jenisperkara']; // You can adjust this if needed
            $signMessage = "Saya yang bernama, " . $pemohon->nama . " dengan ini menyatakan telah mengajukan Perkara " . $pengajuan . " di PA Muara Enim dan bersedia mengajukan perubahan  pada data Kependudukan Saya di Dinas Kependudukan dan Pencatatan Sipil Kabupaten Muara Enim Secara Elektronik.";
    
            // Handle file upload if manual upload is selected
            $url_document = null;
            if ($request->input('upload_option') === 'manual' && $request->hasFile('document')) {
                $document = $request->file('document');
                $filename = time() . '-' . $document->getClientOriginalName();
                $document->move(public_path('documents'), $filename);
                $url_document = url('/') . '/documents/' . $filename; // Generate URL for the uploaded document
            }
    
            // Handle external URL if selected
            if ($request->input('upload_option') === 'url' && $validatedData['external_url']) {
                $url_document = $validatedData['external_url']; // Store the external URL
            }
    
            // Create sign entry
            $sign = SignsUbahStatus::create([
                'pemohon_id' => $pemohon->id, // Save pemohon_id for reference
                'message' => $signMessage,
            ]);
    
            $cekstatus = $request->has('ubah_status') ? true : false;
            PemohonUbahStatus::create([
                'id' => Str::uuid(),
                'id_pemohon' => $pemohon->id,
                'cheklist_ubah_status' => $cekstatus,
                'cheklist_ubah_alamat' => $request->has('ubah_alamat'),
                'url_document' => $url_document,
                'status' => 1,
                'status_awal' => $validatedData['status_awal'] ?? 'Belum Tersedia',
                'status_baru' => $validatedData['status_baru'] ?? 'Belum Tersedia',
                'jalan_awal' => $validatedData['jalan_awal'] ?? 'Jalan Default',
                'jalan_baru' => $validatedData['jalan_baru'] ?? 'Jalan Default',
                'rt_rw_awal' => $validatedData['rt_rw_awal'] ?? 'RT/RW Default',
                'rt_rw_baru' => $validatedData['rt_rw_baru'] ?? 'RT/RW Default',
                'kel_des_awal' => $validatedData['kel_des_awal'] ?? 'Kel/Des Default',
                'kel_des_baru' => $validatedData['kel_des_baru'] ?? 'Kel/Des Default',
                'kec_awal' => $validatedData['kec_awal'] ?? 'Kecamatan Default',
                'kec_baru' => $validatedData['kec_baru'] ?? 'Kecamatan Default',
                'kab_kota_awal' => $validatedData['kab_kota_awal'] ?? 'Kab/Kota Default',
                'kab_kota_baru' => $validatedData['kab_kota_baru'] ?? 'Kab/Kota Default',
                'provinsi_awal' => $validatedData['provinsi_awal'] ?? 'Provinsi Default',
                'provinsi_baru' => $validatedData['provinsi_baru'] ?? 'Provinsi Default',
                'catatan' => null,
                'id_sign' => $sign->id,
            ]);
               
            DB::commit();
    
            // Redirect or return a success message
            return redirect()->back()->with([ 
                'response' => [
                    'success' => 'Pemohon Berhasil Ditembahkan', 
                    'title' => 'Success',
                    'message' => 'Berhasil',
                ]
            ]);
        } catch (\Exception $e) {
            // Rollback transaction if there is any error
            DB::rollBack();
    
            // Return error response if any exception occurs
            return redirect()->back()->with([
                'response' => [
                    'success' => false,
                    'title' => 'Error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ]
            ]);
        }
    }

}

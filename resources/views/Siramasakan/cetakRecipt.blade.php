<!DOCTYPE html>
<html>
<head>
    <title style="text-align: center;">
        {{ $detailPermohonan }} atas nama {{ $pemohon->pemohon->nama }}
    </title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            width: 100%;
            height: auto;
            margin: 0;
        }
        .content {
            text-align: center; /* Center the content */
            margin: 20px auto;  /* Center margin */
        }
        h2 {
            font-size: 16px;
        }
        .receipt-table {
        width: 70%; /* Adjust this width as per your needs */
        border-collapse: collapse;
        margin-left: auto; /* This will center the table */
        margin-right: auto; /* This will center the table */
    }
    .receipt-table th, .receipt-table td {
        border: 1px solid black;
        padding: 8px;
        text-align: left; /* Align the text to the left */
    }
    </style>
</head>
<body>
    <div class="kop-surat">
        <img src="{{ public_path('assets/img/kop.png') }}" alt="Kop Surat">
    </div>

    <div class="content">
        <h2>Permohonan Ubah 
            @if ($pemohon->cheklist_ubah_status && $pemohon->cheklist_ubah_alamat)
                Status & Alamat
            @elseif ($pemohon->cheklist_ubah_status)
                Status
            @elseif ($pemohon->cheklist_ubah_alamat)
                Alamat
            @else
                (No Data)
            @endif
        </h2>
    
        <table class="receipt-table">
            <tr>
                <th>Nama Pemohon</th>
                <td>{{ $pemohon->pemohon->nama ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>No HP/Whatsapp</th>
                <td>{{ $pemohon->pemohon->whatsapp ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $pemohon->pemohon->email ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $pemohon->pemohon->alamat ?? 'N/A' }}</td>
            </tr>
        </table>
    
        <h3>Permohonan Perubahan: 
            @if ($pemohon->cheklist_ubah_status && $pemohon->cheklist_ubah_alamat)
                Status & Alamat
            @elseif ($pemohon->cheklist_ubah_status)
                Status
            @elseif ($pemohon->cheklist_ubah_alamat)
                Alamat
            @else
                (No Data)
            @endif
        </h3>
    
        @if ($pemohon->cheklist_ubah_status && !$pemohon->cheklist_ubah_alamat)
        <h4 style="text-align: left; padding-left: 50px;">Detail Perubahan Status:</h4>
            <table class="receipt-table">
                <tr>
                    <td style="text-align: center;">Status Awal</td>
                    <td style="text-align: center;">Status Yang Ingin Diubah</td>
                </tr>
                <tr>
                    <th style="text-align: center;">{{ $pemohon->status_awal ?? 'N/A' }}</th>
                    <th style="text-align: center;">{{ $pemohon->status_baru ?? 'N/A' }}</th>
                </tr>                
            </table>
        @elseif ($pemohon->cheklist_ubah_status && $pemohon->cheklist_ubah_alamat)
        <h4 style="text-align: left; padding-left: 50px;">Detail Perubahan Status:</h4>
            <table class="receipt-table">
                <tr>
                    <td style="text-align: center;">Status Awal</td>
                    <td style="text-align: center;">Status Yang Ingin Diubah</td>
                </tr>
                <tr>
                    <th style="text-align: center;">{{ $pemohon->status_awal ?? 'N/A' }}</th>
                    <th style="text-align: center;">{{ $pemohon->status_baru ?? 'N/A' }}</th>
                </tr>                
            </table>
            <h4 style="text-align: left; padding-left: 50px;">Detail Perubahan Alamat:</h4>
            <table class="receipt-table">
                <tr>
                    <th colspan="2" style="text-align: center;">Alamat Lama</th>
                    <th colspan="2" style="text-align: center;">Alamat Baru</th>                   
                </tr>
                <tr>
                    <td>Jalan Awal:</td>
                    <td>{{ $pemohon->jalan_awal ?? 'N/A' }}</td>
                    <td>Jalan Baru:</td>
                    <td>{{ $pemohon->jalan_baru ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>RT/RW Awal:</td>
                    <td>{{ $pemohon->rt_rw_awal ?? 'N/A' }}</td>
                    <td>RT/RW Baru:</td>
                    <td>{{ $pemohon->rt_rw_baru ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Kel/Des Awal:</td>
                    <td>{{ $pemohon->kel_des_awal ?? 'N/A' }}</td>
                    <td>Kel/Des Baru:</td>
                    <td>{{ $pemohon->kel_des_baru ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Kec Awal:</td>
                    <td>{{ $pemohon->kec_awal ?? 'N/A' }}</td>
                    <td>Kec Baru:</td>
                    <td>{{ $pemohon->kec_baru ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Kab/Kota Awal:</td>
                    <td>{{ $pemohon->kab_kota_awal ?? 'N/A' }}</td>
                    <td>Kab/Kota Baru:</td>
                    <td>{{ $pemohon->kab_kota_baru ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <td>Provinsi Awal :</td>
                    <td>{{ $pemohon->provinsi_awal ?? 'N/A' }}</td>
                    <td>Provinsi Baru:</td>
                    <td>{{ $pemohon->provinsi_baru ?? 'N/A' }}</td>
                </tr>
            </table>   
            @endif
            <br><br>
            <!-- Add space for signature, name, date, and QR code -->
            <table class="receipt-table" style="margin-left: auto; margin-left: 300px;">
                <tr>
                    <!-- Empty columns for the signature and name -->
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <!-- Third column for date and location -->
                    <td style="border: none;">Pemohon,<br>Muara Enim, {{ $createdAtFormatted }}</td>
                </tr>
                <tr>
                    <!-- Empty rows for signature area -->
                    <td style="border: none;">&nbsp;</td>
                    <td style="border: none;">&nbsp;</td>
                    <!-- QR code area -->
                    <td style="border: none;">
                        <img src="data:image/svg+xml;base64,{{ $qrCodePemohon }}" alt="QR Code" />
                    </td>
                </tr>
                <tr>
                    <td style="border: none;"></td>
                    <td style="border: none;"></td>
                    <td style="border: none;">{{ $pemohon->pemohon->nama ?? 'N/A' }}</td>
                </tr>
            </table>
            

    </div>
</body>
</html>

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	exit;
}

class Report extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('Model_business','business');
	}

     public function ReportCalonNasabah($id_calon_debitur){

        $data = $this->business->get_calon_nasabah($id_calon_debitur)->row();
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);

        //print_r($data);die();
        $gambar = 'http://localhost/webtools-kdpms/assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');

        $pdf->Cell(0,8, " ", "B");
        $pdf->Ln(10);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','BU',12);
        $pdf->Cell(163,6,'LEMBAR DATA CALON DEBITUR',0,0,'C');
        $pdf->SetFont('times','BU',9);
        $pdf->Cell(10,6,'',0,1);

        $pdf->Cell(10,6,'',0,1);

        $pdf->MultiCell(0,0,'ACC. OFFICER',0,'L',false);
        $pdf->MultiCell(0,0,'Area Kerja',0,'R',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','B',9);
        $pdf->MultiCell(0,0,''.$data->AO.'',0,'L',false);
        $pdf->MultiCell(0,0,''.$data->nama_area_kerja.'',0,'R',false);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PERSONAL CALON DEBITUR',1,0);
            $cadeb = '
        Nama Lengkap                      : '.strtoupper($data->nama_identitas).'
        Nama Identitas                      : '.$data->nama_identitas.'
        Nama Panggilan                    : '.$data->nama_panggilan.'
        Alamat                                   : '.$data->alamat.', RT.'.$data->rt.' RW.'.$data->rw.', KELURAHAN.'.$data->Kelurahan.',
                                                             KECAMATAN.'.$data->Kecamatan.', '.$data->Kotakab.',
                                                             '.$data->propinsi.'
        Tempat, Tanggal Lahir          : '.$data->tempat_lahir.','.$data->tgl_lahir.'
        No. KTP                                : '.$data->no_ktp.'
        NPWP                                   : '.$data->npwp.'
        Jenis Kelamin                        : '.$data->kelamin.'
        Nomor KK                            : '.$data->no_kk.'
        Kewarganegaraan                  : '.$data->kewarganegaraan.'
        Sumber Penghasilan              : '.$data->sumber_penghasilan_cn.'
        Nama Ibu Kandung               : '.$data->nama_gadis_ibu_kandung.'
        Jenis Debitur                         : '.$data->jenis_debitur.'
        Status Nikah                          : '.$data->status_nikah.'
        Agama                                   : '.$data->agama.'
        Pekerjaan                               : '.$data->pekerjaan_cn.'
        Pendidikan                             : '.$data->pendidikan_cn.'
        Status Kepemilikan Rumah   : '.$data->kep_rumah_cn.'
        Tinggal Sejak                         : '.$data->tinggal_sejak.'
        No HP                                    : '.$data->telp_hp.'
        Email                                     : '.$data->email.'
        Nama Kerabat                       : '.$data->nama_kerabat.'
        Hubungan Dengan Kerabat   : '.$data->hubungan_dengan_calon.'
        No Telepon Kerabat              : '.$data->no_telp_kerabat.'
        Alamat Kerabat                     : '.$data->alamat_kerabat.'
        ';

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$cadeb,'L R B','L',false);

        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $datapasangan = $this->business->get_pasangan($id_calon_debitur)->num_rows();

        if ($datapasangan != 0) {
        $datapasangan = $this->business->get_pasangan($id_calon_debitur)->row();
        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATApasangan PERSONAL PASANGAN',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $datapasangan = '
        Nama Lengkap                      : '.$datapasangan->nama_identitas.'
        Nama Identitas                      : '.$datapasangan->nama_identitas.'
        Nama Panggilan                    : '.$datapasangan->nama_panggilan.'
        Alamat                                   : '.$datapasangan->alamat.', RT.'.$datapasangan->rt.' RW.'.$datapasangan->rw.', KELURAHAN.'.$datapasangan->Kelurahan.',
                                                             KECAMATAN.'.$datapasangan->Kecamatan.', '.$datapasangan->Kotakab.',
                                                             '.$datapasangan->propinsi.'
        Tempat, Tanggal Lahir          : '.$datapasangan->tempat_lahir.','.$datapasangan->tgl_lahir.'
        No. KTP                                 : '.$datapasangan->no_ktp.'
        NPWP                                    : '.$datapasangan->npwp.'
        Jenis Kelamin                        : '.$datapasangan->kelamin.'
        Nomor KK                             : '.$datapasangan->no_kk.'
        Kewarganegaraan                  : '.$datapasangan->kewarganegaraan.'
        Nama Ibu Kandung               : '.$datapasangan->nama_gadis_ibu_kandung.'
        Agama                                   : '.$datapasangan->agama.'
        Pekerjaan                              : '.$datapasangan->pekerjaan.'
        Pendidikan                            : '.$datapasangan->pendidikan.'
        No HP                                   : '.$datapasangan->telp_hp.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$datapasangan,'L R B','L',false);
        }

        $datapenjamin = $this->business->get_penjamin($id_calon_debitur)->num_rows();

        if ($datapenjamin != 0) {
        $datapenjamin = $this->business->get_penjamin($id_calon_debitur)->row();

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PERSONAL PENJAMIN',1,0);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','',10);
        $ketcalondebitur = '
        Nama Lengkap                      : '.$datapenjamin->nama_identitas.'
        Nama Identitas                      : '.$datapenjamin->nama_identitas.'
        Alamat                                   : '.$datapenjamin->alamat.', RT.'.$datapenjamin->rt.' RW.'.$datapenjamin->rw.', KELURAHAN.'.$datapenjamin->Kelurahan.',
                                                             KECAMATAN.'.$datapenjamin->Kecamatan.', '.$datapenjamin->Kotakab.',
                                                             '.$datapenjamin->propinsi.'
        Tempat, Tanggal Lahir          : '.$datapenjamin->tempat_lahir.','.$datapenjamin->tgl_lahir.'
        No. KTP                                 : '.$datapenjamin->no_ktp.'
        NPWP                                    : '.$datapenjamin->npwp.'
        Jenis Kelamin                        : '.$datapenjamin->kelamin.'
        Nomor KK                             : '.$datapenjamin->no_kk.'
        Kewarganegaraan                  : '.$datapenjamin->kewarganegaraan.'
        Nama Ibu Kandung               : '.$datapenjamin->nama_gadis_ibu_kandung.'
        Agama                                   : '.$datapenjamin->agama.'
        Pekerjaan                              : '.$datapenjamin->pekerjaan.'
        No HP                                   : '.$datapenjamin->telp.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$ketcalondebitur,'L R B','L',false);
        $pdf->Cell(10,6,'',0,1);
        }


/*        $pdf->SetFont('times','B',11);
        $pdf->MultiCell(0,0,'Mengetahui/Menyetujui                                                                        Bogor, 17 januari 2019
                                         ',0,'L',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->MultiCell(0,0,'                                                                                                             Petugas Pemeriksa/Penilaian
                                         ',0,'R',false);


        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $pdf->MultiCell(0,0,'                  ',0,'C',false);
        $pdf->Cell(10,4,'',0,1);
        $pdf->MultiCell(0,0,'(                       1              )',0,'L',false);
        $pdf->MultiCell(0,0,'(                      2               )',0,'C',false);
        $pdf->MultiCell(0,0,'(                      3               ) ',0,'R',false);

        $pdf->Cell(10,6,'',0,1);*/

        $pdf->SetFont('times','',10);
        $pdf->MultiCell(0,15,'Dibuat Oleh',0,'R',false);
        $pdf->MultiCell(0,10,'Bogor, '.$this->changeDate(date('Y-m-d')).'',0,'R',false);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $pdf->MultiCell(0,0,'...............',0,'R',false);

        $pdf->Output();
    }

    public function ReportOrder($id_order){

        $dataorder = $this->business->get_detail_order($id_order)->row();
        $datafile = json_decode($dataorder->file_lampiran);

        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
        //print_r($dataorder);die();
        $gambar = 'http://103.31.232.30/webtools-kdpms/assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');

        $pdf->Cell(0,8, " ", "B");
        $pdf->Ln(10);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','BU',12);
        $pdf->Cell(163,6,'LEMBAR DATA ORDER CALON DEBITUR',0,0,'C');
        $pdf->SetFont('times','BU',9);
        $pdf->Cell(10,6,'',0,1);

        $pdf->Cell(10,6,'',0,1);

        $pdf->MultiCell(0,0,'ACC. OFFICER',0,'L',false);
        $pdf->MultiCell(0,0,'Area Kerja',0,'R',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','B',9);
        $pdf->MultiCell(0,0,''.$dataorder->AO_ORDER.'',0,'L',false);
        $pdf->MultiCell(0,0,''.$dataorder->nama_area_kerja.'',0,'R',false);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PERSONAL CALON DEBITUR',1,0);
            $dataorder = '
        Nama Lengkap                           : '.strtoupper($dataorder->nama_calon_nasabah).'
        No KTP                                      : '.$dataorder->noktp.'
        Plafond                                       : Rp. '.number_format($dataorder->plafond, 2, ".", ".").'
        Tenor                                          : '.$dataorder->tenor.' Bulan
        Jenis Pinjaman                            : '.$dataorder->nama_jenis_pinjaman.'
        Keterangan Jaminan                   : '.$dataorder->ket_jaminan.'
        Sumber Aplikasi                         : '.$dataorder->nama_sumber_aplikasi.'
        Keterangan                                 : '.$dataorder->keterangan.'
        ';

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$dataorder,'L R B','L',false);
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(0,15,'Dibuat Oleh',0,'R',false);
        $pdf->MultiCell(0,10,'Bogor, '.$this->changeDate(date('Y-m-d')).'',0,'R',false);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $pdf->MultiCell(0,0,'.................',0,'R',false);
        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','B',10);
        $pdf->MultiCell(0,0,'Lampiran',0,'L',false);
        foreach ($datafile->file as $h) {
            $gambar = 'http://103.31.232.30/webtools-kdpms/assets/lampiran/'.$h;
            $pdf->Image($gambar,33,30,150,100);
            $pdf->Cell(10,6,'',0,1);
            $pdf->AddPage();
        }
        $pdf->Output();
    }


	public function ReportMemoAO($id_order){
		$debitur = $this->business->DataReportMemoAo($id_order)->row();
		//print_r($debitur);die();
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
        $gambar = 'http://103.31.232.30/webtools-kdpms/assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');

		$pdf->Cell(0,8, " ", "B");
		$pdf->Ln(10);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','BU',12);
        $pdf->Cell(163,6,'MEMORANDUM KREDIT ( ACCOUNT OFFICER )',0,0,'C');
        $pdf->SetFont('times','BU',9);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,0,'Nomor Aplikasi',0,'L',false);
       	$pdf->MultiCell(0,0,'ACC. OFFICER',0,'C',false);
       	$pdf->MultiCell(0,0,'Sumber Aplikasi',0,'R',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','B',9);
       	$pdf->MultiCell(0,0,''.$debitur->no_aplikasi.'',0,'L',false);
       	$pdf->MultiCell(0,0,''.$debitur->AO_ORDER.'',0,'C',false);
       	$pdf->MultiCell(0,0,''.$debitur->sumber_aplikasi.'',0,'R',false);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA CALON DEBITUR',1,0);

        $dataPasangan = $this->business->get_pasangan($debitur->id_calon_debitur)->row();
        $jumPas = $this->business->get_pasangan($debitur->id_calon_debitur)->num_rows();
        if ($jumPas == 0) {
	        $pasangan = 'PASANGAN

	 		 Nama                              : -
	 		 Tempat, Tanggal Lahir  : -
	 		 No. KTP/No. SIM          : -';
        }else{
        	$pasangan = 'PASANGAN

	 		 Nama                              : '.$dataPasangan->nama_identitas.'
	 		 Tempat, Tanggal Lahir  : '.$dataPasangan->tempat_lahir.','.$dataPasangan->tgl_lahir.'
	 		 No. KTP/No. SIM          : '.$dataPasangan->no_ktp.'';
        }

        $datadebitur = '
   	Nama debitur                 : '.strtoupper($debitur->nama_identitas).'
 		 Alamat                           : '.strtoupper($debitur->alamat).', RT.'.$debitur->rt.' RW.'.$debitur->rw.', KELURAHAN.'.$debitur->Kelurahan.',
 		 				                                     KECAMATAN.'.$debitur->Kecamatan.', '.$debitur->Kotakab.',
 		 				                                     '.$debitur->propinsi.'
 		 Tempat, Tanggal Lahir  : '.strtoupper($debitur->tempat_lahir).', '.$debitur->tgl_lahir.'
 		 Nama Ibu Kandung       : '.$debitur->nama_gadis_ibu_kandung.'
 		 Status                             : '.$debitur->status_nikah.'
 		 Jml Tanggungan            : -
 		 No. Telp                         : '.$debitur->telp_hp.'
 		 No. KTP/No. SIM          : '.$debitur->no_ktp.'

 		 '.$pasangan.'
 		 ';
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$datadebitur,'L R','L',false);

        /*$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PENJAMIN (JIKA ADA)',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $penjamin = '
    Hubungan                      : Apa hubungannya
 		 Nama                             : Dono
 		 Alamat                           : Bali, RT.25 RW.23, KELURAHAN.PEMECUTAN,
 		 Tempat, Tanggal Lahir  : JAKARTA, 03-01-1982
 		 No. KTP/No. SIM         	: 876867866868676786
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$penjamin,'L R','L',false);*/

		/*$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PEKERJAAN CALON DEBITUR',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $datapekerjaan = '
    Hubungan                       : Karyawan
 		 Nama Perusahaan           : DELTA GRUP
 		 Posisi                              : IT
 		 Jenis Usaha                     :Pembayaran
 		 Alamat Usaha / Kantor   : KP JATI PARUNG, JL JAKARTA-BOGOR
 		 Masa Kerja / Telp.          : 10 Tahun                                                                 Telp.0251861132
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$datapekerjaan,'L R B','L',false);*/

		/*$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PEKERJAAN PASANGAN/PENJAMIN',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $datapekerjaan = '
    Hubungan                       : Karyawan
 		 Nama Perusahaan           : DELTA GRUP
 		 Posisi                              : IT
 		 Jenis Usaha                     :Pembayaran
 		 Alamat Usaha / Kantor   : KP JATI PARUNG, JL JAKARTA-BOGOR
 		 Masa Kerja / Telp.          : 10 Tahun                                                                 Telp.0251861132
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$datapekerjaan,'L R','L',false);*/

		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    KAPASITAS(BULANAN)',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $total_pend = $debitur->gaji_debitur+$debitur->gaji_pasangan+$debitur->gaji_penjamin;
        $total_pengeluaran =$debitur->pengeluaran_rumah_tangga+$debitur->pengeluaran_transportasi+$debitur->pengeluaran_pendidikan+$debitur->angsuran_lain+$debitur->pengeluaran_lainya;
        $kapasitas = '
        	PENDAPATAN
			Cadeb                                : Rp. '.number_format($debitur->gaji_debitur, 2, ".", ".").'
			Pasangan                           : Rp. '.number_format($debitur->gaji_pasangan, 2, ".", ".").'
			Penjamin                           : Rp. '.number_format($debitur->gaji_penjamin, 2, ".", ".").'
   Total Pendapatan              : Rp. '.number_format($total_pend, 2, ".", ".").'

   			PENGELUARAN
			Rumah Tangga                  : Rp. '.number_format($debitur->pengeluaran_rumah_tangga, 2, ".", ".").'
			Transport                           : Rp. '.number_format($debitur->pengeluaran_transportasi, 2, ".", ".").'
			Pendidikan                         : Rp. '.number_format($debitur->pengeluaran_pendidikan, 2, ".", ".").'
			Angsuran Lain-Lain          : Rp. '.number_format($debitur->angsuran_lain, 2, ".", ".").'
			Lainnya                              : Rp. '.number_format($debitur->pengeluaran_lainya, 2, ".", ".").'
			Total Pengeluaran             : Rp. '.number_format($total_pengeluaran, 2, ".", ".").'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$kapasitas,'L R B','L',false);

		$pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    ANGUNAN',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);

        $sertifikat = $this->business->DetailMemoAoSetifikat($id_order)->row();
		$jum_sert = $this->business->DetailMemoAoSetifikat($id_order)->num_rows();
		$kendaraan = $this->business->DetailMemoAoKendaraan($id_order)->row();
		$jum_ken = $this->business->DetailMemoAoKendaraan($id_order)->num_rows();


        //print_r($sertifikat);die();
        if ($jum_ken == 0) {
    		if ($sertifikat->jenis_sertifikat == 'SHM') {
    			$detserti = 'No SHM                            :  '.$sertifikat->no_shm;
    		}else if ($sertifikat->jenis_sertifikat == 'SHGB') {
    			$detserti = 'No surat ukur SHGB          : '.$sertifikat->no_surat_ukur.'
    					Masa berlaku SHGB				      : '.$sertifikat->masa_berlaku_shgb;
    		}else if ($sertifikat->jenis_sertifikat == 'AJB') {
    			$detserti = 'No AJB                               : '.$sertifikat->no_ajb.'
    					Tanggal AJB				                   : '.$sertifikat->tgl_ajb;
    		}else if ($sertifikat->jenis_sertifikat == 'SHMRS') {
    			$detserti = 'Masa berlaku SHMRS       :  '.$sertifikat->masa_berlaku_shmrs;
    		}
            //'.$detserti.'
	        $jaminan = '
				 Lokasi                                 : '.$sertifikat->lokasi.'
				 Kepemilikan                       : '.$sertifikat->nama_kepemilikan.'
				 Pengunaan                          : '.$sertifikat->penggunaan.'
				 No Sertifikat                       : '.$sertifikat->no_sertifikat.'
				 Tanggal Sertifikat               : '.$sertifikat->tgl_sertifikat.'
				 Jenis Sertifikat                    : '.$sertifikat->jenis_sertifikat.'
				 Atas Nama                          : '.$sertifikat->atas_nama.'
				 Alamat                                : '.$sertifikat->alamat.'
	 			Luas Tanah                         : '.$sertifikat->luas_tanah.' M                       Luas Bangunan : '.$sertifikat->luas_bangunan.' M
	 			Kondisi Bangunan              : '.$sertifikat->kondisi_bangunan.'
	 			IMB                                    : '.$sertifikat->imb.'
	 			Legalitas                             : '.$sertifikat->legalitas.'
	 			Catatan Lainnya                 : '.$sertifikat->catatan_lainnya.'

	 		';
		}else if ($jum_sert == 0) {
			$jaminan = '
			Merk                                 : '.$kendaraan->nama_merk.'
			Type                                 : '.$kendaraan->type_kendaraan.'
			Jenis                                 : '.$kendaraan->jenis_kendaraan.'
			Kepemilikan                    : '.$kendaraan->kepemilikan.'
			Atas Nama                       : '.$kendaraan->penggunaan.'
			Alamat BPKB                  : '.strtoupper($kendaraan->alamat_bpkb).', KELURAHAN.'.strtoupper($kendaraan->kelurahan_bpkb).',
 		 				                                       KECAMATAN.'.strtoupper($kendaraan->kecamatan_bpkb).', KOTA '.$kendaraan->kota_bpkb.'
 			No STNK                        : '.$kendaraan->no_stnk.'
 			No Polisi                         : '.$kendaraan->no_polisi.'
 			No Mesin                        : '.$kendaraan->no_mesin.'
 			Warna                             : '.$kendaraan->warna.'
 			Tahun                              : '.$kendaraan->tahun.'

 		';
		}

        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$jaminan,'L R B','L',false);

		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    CEK LINGKUNGAN DAN VERIFIKASI DATA',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $Rcek_lingkungan = '
			HASIL CEK LINGKUNGAN :
			'.$debitur->hasil_cek_lingkungan.'

			DATA YANG DI VERIFIKASI :
			'.$debitur->vertifikasi_data_debitur.'

 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$Rcek_lingkungan,'L R B','L',false);
		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    KETERANGAN CALON DEBITUR',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $keterangan_debitur = '
			KETERANGAN : '.$debitur->ket_calon_debitur.'

 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$keterangan_debitur,'L R B','L',false);
		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    FASILITAS YANG DIMOHON',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $fasilitas_kredit = '
			TUJUAN    : '.$debitur->tujuan_penggunaan.'
			TYPE          : '.$debitur->type_kredit.'

 		';

        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'L R B','L',false);

 		$pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    STRUKTUR FASILITAS KREDIT',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        if ($debitur->realisasi == 0) {
       		$rekomendasi = 'TIDAK MEREKOMENDASIKAN PINJAMAN INI';
        }else{
        	$rekomendasi = 'MEREKOMENDASIKAN PINJAMAN Rp. '.number_format($debitur->realisasi, 2, ".", ".").',-
		TENOR '.$debitur->tenor.' BULAN';

        }
        $fasilitas_kredit = '
			Jenis Fasilitas        : '.$debitur->jenis_fasilitas.'
			Produk                   : '.$debitur->produk.'
			Plafond Kredit       : Rp. '.number_format($debitur->plafon_kredit, 2, ".", ".").'
			Jangka Waktu        : '.$debitur->jangka_waktu.' bulan
			Suku Bunga           : '.$debitur->suku_bunga.'%
			Akad Kredit           : '.$debitur->akad_kredit.'
			Akad Jaminan        : '.$debitur->akad_jaminan.'

 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'L R B','L',false);

		$pdf->SetFont('times','',10);
       	$pdf->MultiCell(0,15,'Bogor, '.$this->changeDate($debitur->create_date).'',0,'R',false);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,0,''.$debitur->AO_ORDER.'',0,'R',false);
        $pdf->Cell(10,4,'',0,1);

       	$pdf->MultiCell(0,0,'ACCOUNT OFFICER',0,'R',false);

        $pdf->Output();
	}

    public function ReportMemoCA($id_order,$jaminan)
    {
        if ($jaminan == 'SERTIFIKAT') {
            redirect(base_url('Report/ReportMemoCAsertifikat/'.$id_order));
        }else if ($jaminan == 'BPKB') {
            redirect(base_url('Report/ReportMemoCAkendaraan/'.$id_order));
            //print_r("MOHON MAAF, REPORT UNTUK INI SEDANG DALAM PEMBUATAN");die();
        }
    }


	public function ReportMemoCAsertifikat($id_order){
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
        $ca = $this->business->DataReportMemoCA($id_order)->row();
        //print_r($ca);die();
        $gambar = 'http://103.31.232.30/webtools-kdpms/assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');

		$pdf->Cell(0,8, " ", "B");
		$pdf->Ln(10);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','BU',12);
        $pdf->Cell(163,6,'LEMBAR PEMERIKSAAN DAN PENILAIAN JAMINAN',0,0,'C');
        $pdf->SetFont('times','BU',9);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',12);
        $pdf->Cell(163,6,'(TANAH DAN BANGUNAN)',0,0,'C');
        $pdf->SetFont('times','B',9);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,0,'Nomor Aplikasi',0,'L',false);
       	$pdf->MultiCell(0,0,'ACC. OFFICER',0,'C',false);
       	$pdf->MultiCell(0,0,'Sumber Aplikasi',0,'R',false);
        $pdf->Cell(10,6,'',0,1);
       	$pdf->MultiCell(0,0,''.$ca->no_aplikasi.'',0,'L',false);
       	$pdf->MultiCell(0,0,''.$ca->AO.'',0,'C',false);
       	$pdf->MultiCell(0,0,''.$ca->sumber_aplikasi.'',0,'R',false);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA CALON DEBITUR',1,0);

        $dataPasangan = $this->business->get_pasangan($ca->id_calon_debitur)->row();
        $jumPas = $this->business->get_pasangan($ca->id_calon_debitur)->num_rows();
        if ($jumPas == 0) {
	        $pasangan = '';
        }else{
        	$pasangan = 'PASANGAN

	 		 Nama                              : '.$dataPasangan->nama_identitas.'
	 		 Tempat, Tanggal Lahir  : '.$dataPasangan->tempat_lahir.','.$dataPasangan->tgl_lahir.'
	 		 No. KTP/No. SIM          : '.$dataPasangan->no_ktp.'';
        }

        $dataPenjamin = $this->business->get_penjamin($ca->id_calon_debitur)->row();
        $jumPen = $this->business->get_penjamin($ca->id_calon_debitur)->num_rows();

        if ($jumPen == 0) {
        	$penjamin = '';
        }else{
	        $penjamin = 'PENJAMIN

	 	  Hubungan                      : '.$dataPenjamin->hubungan_debitur.'
	 		 Nama                             : '.$dataPenjamin->nama_identitas.'
	 		 Alamat                           : '.strtoupper($dataPenjamin->alamat).', RT.'.$dataPenjamin->rt.' RW.'.$dataPenjamin->rw.', KELURAHAN.'.$dataPenjamin->Kelurahan.',
 		 				                                     KECAMATAN.'.$dataPenjamin->Kecamatan.',
 		 				                                     '.$dataPenjamin->Kotakab.',
 		 				                                     PROVINSI '.$dataPenjamin->propinsi.'
	 		 Tempat, Tanggal Lahir  : '.$dataPenjamin->tempat_lahir.', '.$dataPenjamin->tgl_lahir.',
	 		 No. KTP/No. SIM         : '.$dataPenjamin->no_ktp.'';
        }

        $datadebitur = '
   	Nama debitur                 : '.strtoupper($ca->nama_identitas).'
 		 Alamat                           : '.strtoupper($ca->alamat_domisili).', RT.'.$ca->rt_domisili.' RW.'.$ca->rw_domisili.', KELURAHAN '.$ca->Kelurahan_domisili.',
 		 				                                     KECAMATAN '.$ca->Kecamatan_domisili.',
 		 				                                     '.$ca->Kotakab_domisili.',
 		 				                                     PROVINSI '.$ca->propinsi_domisili.'
 		 Tempat, Tanggal Lahir  : '.$ca->tempat_lahir.', '.$ca->tgl_lahir.'
 		 No. KTP/No. SIM         : '.$ca->no_ktp.'

 		 '.$pasangan.'

 		 '.$penjamin.'
 		 ';
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$datadebitur,'L R B','L',false);

		/*$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    DATA PEKERJAAN CALON DEBITUR',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $datapekerjaan = '
    Hubungan                       : Karyawan
 		 Nama Perusahaan           : DELTA GRUP
 		 Posisi                              : IT
 		 Jenis Usaha                     :Pembayaran
 		 Alamat Usaha / Kantor   : KP JATI PARUNG, JL JAKARTA-BOGOR
 		 Masa Kerja / Telp.          : 10 Tahun                                                                 Telp.0251861132
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$datapekerjaan,'L R B','L',false);*/

		/*$pdf->SetFont('times','B',9);
		$pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(163,6,'    DATA PEKERJAAN PASANGAN/PENJAMIN',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $datapekerjaan = '
    Hubungan                       : Karyawan
 		 Nama Perusahaan           : DELTA GRUP
 		 Posisi                              : IT
 		 Jenis Usaha                     :Pembayaran
 		 Alamat Usaha / Kantor   : KP JATI PARUNG, JL JAKARTA-BOGOR
 		 Masa Kerja / Telp.          : 10 Tahun                                                                 Telp.0251861132
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$datapekerjaan,'L R','L',false);*/
		$verifikasi = $this->business->get_where('los_memo_kredit_ca_vertifikasi_data',null,null,array('id_order' => $ca->id_order))->row();
		if ($verifikasi->ktp_cln_debitur == 1) {
			$ktp = 'SUDAH';
		}else{
			$ktp = 'BELUM';
		}

		if ($verifikasi->ktp_pasangan == 1) {
			$ktp_pasangan = 'SUDAH';
		}else{
			$ktp_pasangan = 'BELUM';
		}

		if ($verifikasi->kartu_keluarga == 1) {
			$kartu_keluarga = 'SUDAH';
		}else{
			$kartu_keluarga = 'BELUM';
		}

		if ($verifikasi->surat_nikah == 1) {
			$surat_nikah = 'SUDAH';
		}else{
			$surat_nikah = 'BELUM';
		}

		if ($verifikasi->sertifikat_or_bpkb == 1) {
			$sertifikat_or_bpkb = 'SUDAH';
		}else{
			$sertifikat_or_bpkb = 'BELUM';
		}

		if ($verifikasi->slip_gaji == 1) {
			$slip_gaji = 'SUDAH';
		}else{
			$slip_gaji = 'BELUM';
		}

		if ($verifikasi->data_penjamin == 1) {
			$data_penjamin = 'SUDAH';
		}else{
			$data_penjamin = 'BELUM';
		}

		if ($verifikasi->surat_cerai == 1) {
			$surat_cerai = 'SUDAH';
		}else{
			$surat_cerai = 'BELUM';
		}

		if ($verifikasi->sttp_pbb == 1) {
			$sttp_pbb = 'SUDAH';
		}else{
			$sttp_pbb = 'BELUM';
		}

		if ($verifikasi->imb == 1) {
			$imb = 'SUDAH';
		}else{
			$imb = 'BELUM';
		}

		if ($verifikasi->rekening_tabungan == 1) {
			$rekening_tabungan = 'SUDAH';
		}else{
			$rekening_tabungan = 'BELUM';
        }
        
        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    VERIFIKASI DATA',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $verifdata = '
			KTP cadeb                        : '.$ktp.'
			Kartu keluarga                  : '.$kartu_keluarga.'
			Surat nikah                       : '.$surat_nikah.'
   Sertifikat/BPKB               : '.$sertifikat_or_bpkb.'
			Slip Gaji                           : '.$slip_gaji.'
			Data penjamin                  : '.$data_penjamin.'
			KTP pasangan                  : '.$ktp_pasangan.'
			Surat cerai                        : '.$surat_cerai.'
			STT PBB                          : '.$sttp_pbb.'
			IMB                                  : '.$imb.'
			Rekening tabungan          : '.$rekening_tabungan.'
			Catatan                             : '.$verifikasi->catatan.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$verifdata,'L R B','L',false);

		$ceksurvey = $this->business->get_where('los_memo_kredit_ca_ceklist_survey',null,null,array('id_order' => $ca->id_order))->row();
		//print_r($ceksurvey);die();

		if ($ceksurvey->visit_cln_debitur == 1) {
			$visit_cln_debitur = 'SUDAH';
		}else{
			$visit_cln_debitur = 'BELUM';
		}

		if ($ceksurvey->visit_pasangan == 1) {
			$visit_pasangan = 'SUDAH';
		}else{
			$visit_pasangan = 'BELUM';
		}

		if ($ceksurvey->visit_penjamin == 1) {
			$visit_penjamin = 'SUDAH';
		}else{
			$visit_penjamin = 'BELUM';
		}

		if ($ceksurvey->visit_tmpt_tinggal == 1) {
			$visit_tmpt_tinggal = 'SESUAI DATA';
		}else{
			$visit_tmpt_tinggal = 'TIDAK SESUAI';
		}

		if ($ceksurvey->visit_jaminan == 1) {
			$visit_jaminan = 'SESUAI DATA';
		}else{
			$visit_jaminan = 'TIDAK SESUAI';
		}

		if ($ceksurvey->visit_usaha == 1) {
			$visit_usaha = 'SESUAI DATA';
		}else{
			$visit_usaha = 'TIDAK SESUAI';
		}

		if ($ceksurvey->alamat_domisili == 1) {
			$alamat_domisili = 'SESUAI KTP';
		}else{
			$alamat_domisili = 'TIDAK SESUAI KTP';
		}

		if ($ceksurvey->cek_lingkungan == 1) {
			$cek_lingkungan = 'SESUAI DATA';
		}else{
			$cek_lingkungan = 'TIDAK SESUAI';
		}

		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    CEK PADA SAAT SURVEY',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ceksurvey = '
			Visit Calon Debitur              : '.$visit_cln_debitur.'
			Visit pasangan                      : '.$visit_pasangan.'
			Visit penjamin                      : '.$visit_penjamin.'
			Alamat Domisili                   : '.$alamat_domisili.'
			Visit jaminan                        : '.$visit_jaminan.'
			Visit tempat tinggal              : '.$visit_tmpt_tinggal.'
			Visit Usaha                           : '.$visit_usaha.'
			Cek Lingkungan                   : '.$cek_lingkungan.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$ceksurvey,'L R B','L',false);
		$pdf->SetFont('times','B',9);

		$kondisilokasi = $this->business->get_where('los_memo_kredit_ca_kondisi_dan_lokasi_jaminan',null,null,array('id_order' => $ca->id_order))->row();

        $pdf->Cell(163,6,'    KONDISI LOKASI DAN JAMINAN',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ceksurvey = '
   Alamat Lengkap Objek        :
   Pusat Keramaian                  : '.$kondisilokasi->pusat_keramaian.'
   Jarak Dari Pusat Kota          : '.$kondisilokasi->jarak_keramaian.'
   Lingkungan                          :
   Fasilitas Umum/Social         : '.$ca->fasilitas_umum.'

   Jalan yang dilalui                 :
   Akses jalan                          : '.$kondisilokasi->akses_jalan.'
   Luas Jalan                            : '.$kondisilokasi->luas_jalan.'
   Rawan Bencana                   : '.$kondisilokasi->rawan_bancana.'
   Tingkat Kepadatan              : '.$kondisilokasi->tingkat_kepadatan.'
   Pertumbuhan Lingkungan   : '.$kondisilokasi->pert_lingkungan.'
   Daerah Banjir                      : '.$kondisilokasi->daerah_banjir.'

   Luas Tanah                          : '.$ca->luas_tanah_ca.' M²
   Kondisi / Bentuk Tanah       : '.$ca->kondisi_bentuk_tanah.'
   Luas Bangunan                    : '.$ca->luas_bangunan_ca.' M²
   Dibangun Tahun                  : '.$ca->kegunaan_bangunan.'
   Kegunaan Bangunan            : '.$ca->kegunaan_bangunan.'
   Penguasaan Tanah
   dan Bangunan                      : '.$ca->penguasaan_tanah_bangunan.'
   Kondisi Fisik
   Secara Umum                      : '.$ca->kondisi_fisik.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$ceksurvey,'L R B','L',false);

        $sertifikat = $this->business->DetailMemoAoSetifikat($id_order)->row();

        if ($sertifikat->jenis_sertifikat == 'SHM') {
        	$masa_berlaku = '-';
		}else if ($sertifikat->jenis_sertifikat == 'SHGB') {
        	$masa_berlaku = $sertifikat->masa_berlaku_shgb;
		}else if ($sertifikat->jenis_sertifikat == 'AJB') {
        	$masa_berlaku = '-';
		}else if ($sertifikat->jenis_sertifikat == 'SHMRS') {
        	$masa_berlaku = $sertifikat->masa_berlaku_shmrs;
		}
        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Aspek Hukum Kepemilikan Tanah Dan Batas Batas',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ceksurvey = '
   Jenis Hak / Nomor                : /'.$sertifikat->no_sertifikat.'
   Masa Berlaku Hak                : '.$masa_berlaku.'
   Surat Ukur/Gambar Situasi   : '.$sertifikat->tgl_surat_ukur.' '.$sertifikat->no_surat_ukur.'
   Nama Pemegang Hak            : '.$sertifikat->atas_nama.'
   IMB                                       : '.$sertifikat->imb.'
   Legalitas                                : '.$sertifikat->legalitas.'
   Catatan Lainnya                    : '.$sertifikat->catatan_lainnya.'
   Sebelah Utara                        : '.$ca->sebelah_utara.'
   Sebelah Barat                        : '.$ca->sebelah_barat.'
   Sebelah Timur                       : '.$ca->sebelah_timur.'
   Sebelah Selatan                     : '.$ca->sebelah_selatan.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$ceksurvey,'L R B','L',false);

        // $pdf->AddPage();
        // $pdf->Cell(10,6,'',0,1);
        // $pdf->Cell(10,6,'',0,1);


        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Jalan Dan Lokasi',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ceksurvey = '
   Jalan Depan                         : '.$ca->jalan_didepan.'
   Jalan Lingkungan Terbesar : '.$ca->jalan_lingkungan_terbesar.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$ceksurvey,'L R B','L',false);
		$keadaanBangunan = $this->business->get_where('los_memo_kredit_ca_bangunan',null,null,array('id_order' => $ca->id_order))->row();
        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Keadaan Bangunan',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $keadaan_bangunan = '
   Kontruksi                          : '.$keadaanBangunan->kontruksi.'
   Lantai                                : '.$keadaanBangunan->lantai.'
   Dinding                             : '.$keadaanBangunan->dinding.'
   Kusen                                : '.$keadaanBangunan->kusen.'
   Pintu                                  : '.$keadaanBangunan->pintu.'
   Jendela                              : '.$keadaanBangunan->jendela.'
   Kuda-kuda                        : '.$keadaanBangunan->kuda_kuda.'
   Rangkap Atap                   : '.$keadaanBangunan->rangkap_atap.'
   Langit-langit                     : '.$keadaanBangunan->langit_langit.'
   Atap                                  : '.$keadaanBangunan->atap.'
   Pagar                                 : '.$keadaanBangunan->pagar.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$keadaan_bangunan,'L R B','L',false);
        
        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Fasilitas Bangunan / Situasi Rumah',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $keadaan_bangunan = '
    Lantai 1

   Ruang Tamu                      : '.$keadaanBangunan->ruang_tamu.'
   Kamar Mandi / WC           : '.$keadaanBangunan->kamar_mandi_wc.'
   Ruang Makan                    : '.$keadaanBangunan->ruang_makan.'
   Dapur                                 : '.$keadaanBangunan->dapur.'
   Kamar Pembantu               : '.$keadaanBangunan->kamar_pembantu.'
   Teras                                  : '.$keadaanBangunan->teras.'
   Kamar Tidur                      : '.$keadaanBangunan->kamar_tidur.'
   Garasi                                : '.$keadaanBangunan->garasi.'

   Lantai 2

   Ruang Keluarga                 : '.$keadaanBangunan->ruang_keluarga_l2.'
   Kamar Mandi / WC           : '.$keadaanBangunan->kamar_mandi_wc_l2.'
   Ruang Makan                    : '.$keadaanBangunan->ruang_makan_l2.'
   Dapur                                 : '.$keadaanBangunan->dapur_l2.'
   Kamar                                : '.$keadaanBangunan->kamar_l2.'
   Teras                                  : '.$keadaanBangunan->teras_l2.'
   Listrik                                : '.$keadaanBangunan->listrik_l2.'
   Telepon/Fax/Telex/Dll      : '.$keadaanBangunan->telepon_fax_dll_l2.'
   Air                                      : '.$keadaanBangunan->air_l2.'

        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$keadaan_bangunan,'L R B','L',false);

		$lainlain = $this->business->get_where('los_memo_kredit_ca_lain_lain',null,null,array('id_order' => $ca->id_order))->row();
		//print_r($lainlain);die();
        // $pdf->AddPage();
        // $pdf->Cell(10,6,'',0,1);
        // $pdf->Cell(10,6,'',0,1);

		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    KETERANGAN CALON DEBITUR',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ketcalondebitur = '
			'.$lainlain->ket_calon_debitur_ca.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$ketcalondebitur,'L R B','L',false);
         
		$debitur = $this->business->DataReportMemoAo($id_order)->row();
		//print_r($debitur);die();
		$pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    FASILITAS YANG DIMOHON',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $fasilitas_kredit = '
			TUJUAN    : '.$debitur->tujuan_penggunaan.'
			TYPE         : '.$debitur->type_kredit.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'L R B','L',false);
        
        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        
        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    STRUKTUR FASILITAS KREDIT',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);

        $fasilitas_kredit = '
			Jenis Fasilitas        : '.$debitur->jenis_fasilitas.'
			Produk                   : '.$debitur->produk.'
			Plafond Kredit       : Rp. '.number_format($debitur->plafon_kredit, 2, ".", ".").'
			Jangka Waktu        : '.$debitur->jangka_waktu.' bulan
			Suku Bunga           : '.$debitur->suku_bunga.'%
			
			Akad Kredit           : '.$debitur->akad_kredit.'
			Akad Jaminan        : '.$debitur->akad_jaminan.'
 		';
        //Pby Bunga /bln      : Rp. 2.000.000/BELUM DINAMIS
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'L R B','L',false);

		$total_pend = $debitur->gaji_debitur+$debitur->gaji_pasangan+$debitur->gaji_penjamin+$debitur->pendapatan_lainnya;
		$total_pengeluaran =$debitur->pengeluaran_rumah_tangga+$debitur->pengeluaran_transportasi+$debitur->pengeluaran_pendidikan+$debitur->angsuran_lain+$debitur->pengeluaran_lainya+$debitur->angsuran_kdpms+$ca->pengeluaran_telp_listrik_air;
        
        $Disposible = $total_pend - $total_pengeluaran;
		
        // if(strlen($lainlain->ket_calon_debitur_ca) > 550){
        //     $pdf->AddPage();
        //     $pdf->Cell(10,6,'',0,1);
        //     $pdf->Cell(10,6,'',0,1);
        // }

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    KAPASITAS(BULANAN)',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $kapasitas = '
        PENDAPATAN
			Cadeb                                : Rp. '.number_format($debitur->gaji_debitur, 2, ".", ".").'
			Pasangan                           : Rp. '.number_format($debitur->gaji_pasangan, 2, ".", ".").'
			Penjamin                           : Rp. '.number_format($debitur->gaji_penjamin, 2, ".", ".").'
			Penghasilan lainnya          : Rp. '.number_format($debitur->pendapatan_lainnya, 2, ".", ".").'
   Total Pendapatan              : Rp. '.number_format($total_pend, 2, ".", ".").'

   		PENGELUARAN
			Rumah Tangga                  : Rp. '.number_format($debitur->pengeluaran_rumah_tangga, 2, ".", ".").'
			Transport                           : Rp. '.number_format($debitur->pengeluaran_transportasi, 2, ".", ".").'
			Pendidikan                        : Rp. '.number_format($debitur->pengeluaran_pendidikan, 2, ".", ".").'
			Listrik tlp air                     : Rp. '.number_format($ca->pengeluaran_telp_listrik_air, 2, ".", ".").'
			Angsuran Lain-Lain          : Rp. '.number_format($debitur->angsuran_lain, 2, ".", ".").'
			Angsuran KDPMS            : Rp. '.number_format($debitur->angsuran_kdpms, 2, ".", ".").'
			Biaya Lainnya                   : Rp. '.number_format($debitur->pengeluaran_lainya, 2, ".", ".").'
			Total Pengeluaran             : Rp. '.number_format($total_pengeluaran, 2, ".", ".").'

			Sisa pendapatan                : Rp. '.number_format($Disposible, 2, ".", ".").'
 		';

		$pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$kapasitas,'L R B','L',false);


		$pdf->AddPage();
		$pdf->Cell(10,6,'',0,1);
		$pdf->Cell(10,6,'',0,1);

		$pdf->SetFont('times','B',9);
		$pdf->Cell(163,6,'    PENILAIAN TAKSASI MENURUT KEADAAN SEKARANG',1,0);
		$pdf->Cell(10,6,'',0,1);
		$pdf->SetFont('times','',10);
		$jum_njop_tanah = $ca->luas_tanah_njop * $ca->njop_tanah;
		$jum_njop_bangunan = $ca->luas_bangunan_njop * $ca->njop_bangunan;
		$jumlah_njop = $jum_njop_tanah + $jum_njop_bangunan;

		$jum_hp_tanah = $ca->luas_tanah_ca * $ca->harga_pasar_tanah;
		$jum_hp_bangunan = $ca->luas_bangunan_ca * $ca->harga_pasar_bangunan;
		$jum_hp = $jum_hp_tanah + $jum_hp_bangunan;

		$jum_nilai_taksi = $jum_hp * ($ca->nilai_taksasi/100);

		$penilaian = '
		Luas Tanah berdasarkan NJOP                       							        : '.$ca->luas_tanah_njop.' M²
		Luas Bangunan berdasarkan NJOP                   								     : '.$ca->luas_bangunan_njop.' M²
		Tahun NJOP         					                                                     : '.$ca->tahun_njop.'
		NJOP tanah         														                                              : '.number_format($ca->njop_tanah, 2, ".", ".").'
		NJOP bangunan         														                                       : '.number_format($ca->njop_bangunan, 2, ".", ".").'
		Jumlah NJOP Tanah                                                       : '.number_format($jum_njop_tanah, 2, ".", ".").'
		Jumlah NJOP Bangunan                                                 : '.number_format($jum_njop_bangunan, 2, ".", ".").'
		Jumlah NJOP 										                                                       : '.number_format($jumlah_njop, 2, ".", ".").'


		Luas Tanah berdasarkan harga pasar                             : '.$ca->luas_tanah_ca.' M²
		Luas Bangunan berdasarkan harga pasar                       : '.$ca->luas_bangunan_ca.' M²
		Harga pasar tanah                                                           : '.number_format($ca->harga_pasar_tanah, 2, ".", ".").'
		Harga pasar banguan                                                      : '.number_format($ca->harga_pasar_bangunan, 2, ".", ".").'
		Jumlah Harga pasar Tanah                                             : '.number_format($jum_hp_tanah, 2, ".", ".").'
		Jumlah Harga pasar Bangunan                                       : '.number_format($jum_hp_bangunan, 2, ".", ".").'
		Jumlah Harga Pasar 										                                             : '.number_format($jum_hp, 2, ".", ".").'

		Keterangan :
		'.$ca->keterangan_penilaian.'
		harga pasaran : '.number_format($jum_hp, 2, ".", ".").'

		Jadi nilai taksasinya : '.number_format($jum_hp, 2, ".", ".").' * '.$ca->nilai_taksasi.'% = '.number_format($jum_nilai_taksi, 2, ".", ".").'
		';
		$pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$penilaian,'L R B','L',false);

		$pdf->SetFont('times','B',9);
		$pdf->Cell(163,6,'    BAHAN PERTIMBANGAN PENILAIAN',1,0);
		$pdf->Cell(10,6,'',0,1);
		$pdf->SetFont('times','',10);
		$penilaian = '
		Sumber Informasi dan Besarnya Harga Pasaran Tanah/Bangunan

		Sumber harga 1 :
		'.$ca->sumber_harga.'

		Faktor Yang Dapat Menaikan dan Menurunkan Penilaian

		1. Faktor yang dapat Menaikan
		'.$ca->faktor_menaikan.'

		2 Faktor yang dapat Menurunkan
		'.$ca->faktor_menurunkan.'
		';

    $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$penilaian,'L R B','L',false);

		$lainlain = $this->business->get_where('los_memo_kredit_ca_lain_lain',null,null,array('id_order' => $ca->id_order))->row();
		//print_r($lainlain);die();
        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
		$pdf->SetFont('times','B',11);
    $pdf->Cell(163,6,'    RINGKASAN ANALISA DAN REKOMENDASI',1,0,'C');

		$pdf->SetFont('times','B',10);
    $pdf->Cell(10,6,'',0,1);
    $pdf->Cell(163,6,'    ANALISA KREDIT CHECKING',1,0,'C');
    $pdf->Cell(10,6,'',0,1);
    $pdf->SetFont('times','',10);
    $analisaKC = '
   		'.$lainlain->analisa_bi_checking.'
 		';
    $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$analisaKC,'L R B','L',false);

		$pdf->SetFont('times','B',10);
		$pdf->Cell(163,6,'    TEAM SURVEY DAN PENYIMPANGAN',1,0,'C');
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $teamsurvey = '
   		PUSAT DAN CABANG :
   		'.$lainlain->tim_survey.'

   		JENIS PENYIMPANGAN :
   		'.$lainlain->penyimpangan.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$teamsurvey,'L R B','L',false);

		$pdf->SetFont('times','B',10);
		$pdf->Cell(163,6,'    REKOMENDASI ACCOUNT OFFICER DAN VERIFIKASI DATA',1,0,'C');
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $teamsurvey = '
   		REKOMENDASI :
   		AO merekomendasikan Rp. '.number_format($lainlain->realisasi, 2, ".", ".").' dengan tenor '.$lainlain->tenor.' Bulan.

   		VERIFIKASI :
   		DATA DEBITUR: '.$lainlain->vertifikasi_data_debitur.'

   		DATA PENJAMIN : '.$lainlain->vertifikasi_penjamin.'

   		DATA JAMINAN : '.$lainlain->vertifikasi_jaminan.'
 		';
        $pdf->SetFont('times','',10);
		$pdf->MultiCell(163,5,$teamsurvey,'L R B','L',false);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Pernyataan dan Catatan Khusus Pemeriksaan / Penilai',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ketcalondebitur = '
    Demikian penilaian ini kami buat dengan sebenarnya tanpa ada paksaan ataupun kepentingan pribadi, tidak
    untuk dipublikasikan tetapi semata mata untuk kepentingan Koperasi Mandiri Sejahtera.
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$ketcalondebitur,'L R B','L',false);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Kesimpulan',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ketcalondebitur = '
    Tanah & Bangunan tersebut layak dan dapat diterima sebagai jaminan pinjaman.
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$ketcalondebitur,'L R B','L',false);

		$pdf->SetFont('times','',10);
       	$pdf->MultiCell(0,15,'Dibuat Oleh',0,'R',false);
       	$pdf->MultiCell(0,10,'Bogor, '.$this->changeDate(date('Y-m-d')).'',0,'R',false);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,0,$debitur->AO,0,'R',false);

        $pdf->Output();
	}

    public function ReportMemoCAkendaraan($id_order){
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
        $data = $this->business->DetailMemoAoKendaraan($id_order)->row();
        $suratsuratKendaraan = $this->business->get_where('los_memo_kredit_ca_kendaraan',null,null,array('id_order' => $id_order))->row();
        $fisikkendaraan = $this->business->get_where('los_memo_kredit_ca_fisik_kendaraan',null,null,array('id_order' => $id_order))->row();
        $sumberharga = $this->business->get_where('los_memo_kredit_ca_penilaian_jaminan_kendaraan',null,null,array('id_order' => $id_order))->row();
        //print_r(json_encode($data));die();
        $gambar = 'http://103.31.232.30/webtools-kdpms/assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');

        $pdf->Cell(0,8, " ", "B");
        $pdf->Ln(10);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','BU',12);
        $pdf->Cell(163,6,'LEMBAR PEMERIKSAAN DAN PENILAIAN JAMINAN',0,0,'C');
        $pdf->SetFont('times','BU',9);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',12);
        $pdf->Cell(163,6,'(kendaraan)',0,0,'C');
        $pdf->SetFont('times','B',9);
        $pdf->Cell(10,6,'',0,1);

/*        $pdf->MultiCell(0,0,'Nomor Aplikasi',0,'L',false);
        $pdf->MultiCell(0,0,'ACC. OFFICER',0,'C',false);
        $pdf->MultiCell(0,0,'Sumber Aplikasi',0,'R',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->MultiCell(0,0,'1212121',0,'L',false);
        $pdf->MultiCell(0,0,'1212121',0,'C',false);
        $pdf->MultiCell(0,0,'1212121',0,'R',false);
        $pdf->Cell(10,6,'',0,1);*/


        $pdf->SetFont('times','',11);
        $pdf->MultiCell(163,6,'Pada Hari ini ................ Tanggal ................ Telah dilakukan pemeriksaan atas 1 (satu) unit kendaraan dengan spesifikasi sbb:','',false);
        $pdf->SetFont('times','BU',9);


        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Data Kendaraan',1,0);
            $kendaraan = '
             Merk/Jenis                    : '.$data->nama_merk.' '.$data->type_kendaraan.'/'.$data->jenis_kendaraan.'
             No Rangka/Mesin         : '.$data->no_rangka.'/'.$data->no_mesin.'
             Warna/Tahun                : '.$data->warna.'/'.$data->tahun.'
             Nomor STNK                : '.$data->no_stnk.'
             Nomor Polisi                 : '.$data->no_polisi.'
             Nomor Faktur                : '.$data->no_faktur.'
             Nomor BPKB                : '.$data->no_bpkb.'
             Atas Nama                     : '.$data->atas_nama.'
             Alamat                           : '.$data->alamat_bpkb.'
             ';


        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$kendaraan,'L R','L',false);

        $pdf->SetFont('times','B',9);
        $pdf->Cell(163,6,'    Pemeriksaan Data',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $pemeriksaan = '
        A. Surat-surat :
            STNK                              : '.$suratsuratKendaraan->stnk.'
            Notes Pajak                     : '.$suratsuratKendaraan->notes_pajak.'
            Trayek                             : '.$suratsuratKendaraan->trayek.'
            BPKB                              : '.$suratsuratKendaraan->bpkb.'
            Faktur                              : '.$suratsuratKendaraan->faktur.'
            Kwitansi Blangko            : '.$suratsuratKendaraan->kwitansi_blangko.'

        B. Masa Berlaku :
            STNK                              : '.$suratsuratKendaraan->masa_berlaku_stnk.'
            BPKB                              : '.$suratsuratKendaraan->masa_berlaku_pajak.'

        B. Fisik :
            Chasis                              : '.$fisikkendaraan->chasis.'
            Body                                : '.$fisikkendaraan->body.'
            Kabin                               : '.$fisikkendaraan->kabin.'
            Plafon                               : '.$fisikkendaraan->plafon.'
            Dashboard                        : '.$fisikkendaraan->plafon.'
            Dek/Landasan                  : '.$fisikkendaraan->dek_landasan.'
            Ban                                   : '.$fisikkendaraan->ban.'
            Velg                                 : '.$fisikkendaraan->velg.'
            Jok                                   : '.$fisikkendaraan->jok.'
            Cat                                   : '.$fisikkendaraan->cat.'
            Lampu-lampu                  : '.$fisikkendaraan->lampu_lampu.'
            Klakson                           : '.$fisikkendaraan->klakson.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$pemeriksaan,'L R B','L',false);

        $pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $ceksurvey = '
            Speedometer               : '.$fisikkendaraan->speedometer.'
            Kaca Spion                 : '.$fisikkendaraan->kaca_spion.'
            Kunci Kontak             : '.$fisikkendaraan->kunci_kontak.'

            - Kondisi Mesin (pada saat hidup) : '.$fisikkendaraan->kondisi_mesin_hidup.'

             Perlengkapan yang ada :
             - '.$fisikkendaraan->perlengkapan.'


             I. PENILAIAN JAMINAN
                A. Sumber Informasi Harga :
                1. '.$sumberharga->sumber_informasi1.' Rp. '.number_format($sumberharga->harga1, 2, ".", ".").'
                2. '.$sumberharga->sumber_informasi2.' Rp. '.number_format($sumberharga->harga2, 2, ".", ".").'

            II. KESIMPULAN
                '.$sumberharga->kesimpulan.'
        ';
        $pdf->SetFont('times','',10);
        $pdf->MultiCell(163,5,$ceksurvey,'T L R B','L',false);
        $pdf->SetFont('times','B',9);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'Keadaan tak terduga :',0,1);
        $pdf->SetFont('times','',11);
        $penutup = '
Demikian hasil pemeriksaan dan penilaian atas barang jaminan ini, dibuat dengan sebenarnya
berdasarkan pertimbangan yang obyektif.


                ';
        $pdf->MultiCell(163,5,$penutup,false);

        $pdf->SetFont('times','B',11);
        $pdf->MultiCell(0,0,'Mengetahui,                                                                                            ........ , ........................... '.explode('-',date('Y-m-d'))[0].'
                                         ',0,'L',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->MultiCell(0,0,'                                                                                                             Petugas Pemeriksa/Penilaian
                                         ',0,'R',false);


        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

        $pdf->MultiCell(0,0,'                  ',0,'C',false);
        $pdf->Cell(10,4,'',0,1);
        $pdf->MultiCell(0,0,'(                                     )',0,'L',false);
        $pdf->MultiCell(0,0,'(                                     )',0,'C',false);
        $pdf->MultiCell(0,0,'(                                     ) ',0,'R',false);

        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'',0,1);
        $pdf->SetFont('times','',11);
        $penutup = '
Catatan : Hasil Gesekan Nomor Rangka, Nomor Mesin

A. NOMOR RANGKA : '.$data->no_rangka.'


B. NOMOR MESIN : '.$data->no_mesin.'
                ';
        $pdf->MultiCell(163,5,$penutup,false);

        $pdf->Output();
    }


	public function ReportOfferingLetter($id_order)
	{
		$jum_sert = $this->business->DetailMemoAoSetifikat($id_order)->num_rows();
		$jum_ken = $this->business->DetailMemoAoKendaraan($id_order)->num_rows();

		if ($jum_sert > 0) {
			redirect(base_url('/Report/ReportOfferingLetterSertifikat/'.$id_order));
		}elseif ($jum_ken > 0) {
			redirect(base_url('/Report/ReportOfferingLetterKendaraan/'.$id_order));
		}
	}

	public function ReportOfferingLetterSertifikat($id_order){
    	$data = $this->business->DataReportOfferingLetter($id_order);
		//print_r($data);die();
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
        $gambar = base_url().'assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');
		$pdf->Cell(0,8, " ", "B");
		$pdf->Ln(10);

        $pdf->SetXY(0,25);
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('times','',11);
        $pdf->Cell(0,14,'Nomor    : '.$data->nomor.' ',0,1);

       	$pdf->SetXY(0,25);
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('times','',11);
        $pdf->Cell(0,24,'Perihal    : Surat Pemberitahuan Persetujuan Pinjaman  ',0,1);

        $pdf->SetFont('times','',10);
        $pdf->Cell(0,6,'Bogor, '.$this->changeDate(date('Y-m-d')).'',0,1);

        $pdf->SetFont('times','',10);
        $pdf->Cell(0,10,'Kepada Yth,',0,1);
        $pdf->Cell(0,1,'Bapak/Ibu '.strtoupper($data->nama_calon_debitur).'',0,1);
        $pdf->Cell(0,10,''.strtoupper($data->domisili_alamat).'',0,1);
        $pdf->Cell(0,1,'KEL '.strtoupper($data->Kelurahan_domisili).' KEC '.strtoupper($data->Kecamatan_domisili).' - '.strtoupper($data->Kotakab_domisili),0,1);


        $pdf->SetXY(0,65);
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('times','',11);
        $pdf->Cell(10,10,'',0,1);

       	$pdf->Cell(0,30,'Dengan Hormat,',0,1,'L');

        $pdf->SetXY(0,88);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
       	$pdf->MultiCell(0,5,' Sehubungan dengan permohonan fasilitas pinjaman Bapak/Ibu melalui Surat Pemberitahuan persetujuan Pinjaman tertanggal '.$this->changeDate(date('Y-m-d')).', dengan ini kami beritahukan bahwa pada prinsipnya Koperasi Dana Pinjaman Mandiri Sejahtera Bogor bersedia memberikan fasilitas pinjaman kepada Bapak/Ibu dengan ketentuan sebagai berikut :',0,'J',false);


        $pdf->SetFont('times','B',11);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',11);

        $tenor = $data->approval_tenor;
       	$suku_bunga = $data->suku_bunga;
       	$pinjaman = $data->approval;
       	$angsuran_bunga = ($suku_bunga / 100) * $pinjaman;
       	$angsuran_pokok = $pinjaman / $tenor;
       	$jml_ang_per_bln = $angsuran_pokok + $angsuran_bunga;
       	$pem_ang = round($jml_ang_per_bln,-3);

       	$sertifikat = $this->business->DetailMemoAoSetifikat($id_order)->row();
       	//print_r($sertifikat);die();
        $angunan = '
         Nama Calon Anggota                        : '.$data->nama_calon_debitur.'
			      Tujuan Peminjaman                           : '.$data->tujuan_penggunaan.'
			      Jenis Pinjaman                                   : '.$data->jenis_pinjaman.'
			      Plafond                                               : Rp. '.number_format($data->approval, 2, ".", ".").'
			      Jangka Waktu Fasilitas Kredit           :  '.$data->approval_tenor.' Bulan
			      Suku bunga                                        :  '.$data->suku_bunga.'%
			      Denda                                                 : Rp. '.number_format(0, 2, ".", ".").' //BELUM DINAMIS
			      Penalty                                                : Rp. '.number_format(0, 2, ".", ".").'//BELUM DINAMIS
			      Provisi                                                : Rp. '.number_format($data->provisi, 2, ".", ".").'
			      Administrasi                                       : Rp. '.number_format($data->administrasi, 2, ".", ".").'
			      Asuransi Jiwa 3 tahun                        : Rp. '.number_format($data->premi_ass_jiwa, 2, ".", ".").'
			      Asuransi Fire 3 tahun                         : Rp. '.number_format($data->premi_ass_kebakaran, 2, ".", ".").'
			      Biaya Materai                                     : Rp. '.number_format(0, 2, ".", ".").'//BELUM DINAMIS
			      Notaris                                                : Rp. '.number_format($data->notaris, 2, ".", ".").'
			      Angsuran Per-bulan                            : Rp. '.number_format($pem_ang, 2, ".", ".").'

			      ANGUNAN

			         No. Sertifikat                                    : '.$sertifikat->no_sertifikat.'       tanggal : '.$sertifikat->tgl_sertifikat.'
			         No. Ukur                                           : '.$sertifikat->no_surat_ukur.'       tanggal 24/12/2019/Belum dinamis
			         An                                                     : '.$sertifikat->atas_nama.'          Luas : '.$sertifikat->luas_tanah.' M²
		 		';


		$pdf->MultiCell(163,5,$angunan,false);

        $pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'SYARAT PINJAMAN :',0,1);
        $pdf->SetFont('times','',11);
        $angunan = '
 		 1. Cover asuransi kendaraan tlo
 		 2. Pengikat notaris
 		 3. blokir 1 bulan angsuran
		 		';

		$pdf->MultiCell(163,5,$angunan,false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

		$pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'Pembayaran :',0,1);
        $pdf->SetFont('times','',11);
        $angunan = '
 		 1. Pembayaran angsuran dilakukan setiap tangal jatuh tempo tanpa terputus pada setiap bulannya
 		     tanpa terkecuali sesuai dengan jadwal pembayaran angsuran Peminjam.
 		 2. Apabila tanggal jatuh tempo bertepatan dengan hari libur atau koperasi tidak beropersai makan
 		     pembayaran angsuran dilakukan sebelum tanggal jatuh tempo agar tidak terkena denda.
 		 3. Denda keterlambatan pembayaran angsuran adalah 0,5% (persen) dari angsuran pinjaman harus
 		     dibayar dikali hari keterlambatan.
 		 4. Setiap bulannya / tanggal jatuh tempo Pinjaman, Rekening Tabungan anggota akan didebet
 		     untuk pembayaran pinjaman Apabila Dana Tabungan tidak ada dan angsuran pinjaman jatuh
 		     tempo hari tersebut maka keesokan harinya akan dikenakan denda.
 		 5. Jam operasional kas  /  Teller Hari Senin - Jumat, Jam 08:30 - 15-30 dan Hari Sabtu (Apabila
 		     kantor beroperasi / buka) jam 08:00 - 11:00. Apabila melewati jam tersebut akan masuk sebagai
 		     titipan dan dibukukan pada hari kerja.
 		 6. Pembayaran dapat dilakukan transfer melalui Rekening Koperasi Dana Pinjaman Mandiri
 		     Sejahtera di BCA dengan nomor 427-800-9988 Cabang Siliwangi Dan Melalui Rekening
 		     Koperasi Dana Pinjaman Mandiri Sejahtera Di Rek Mandiri dengan nomor 133-00.1424.1194
 		     Cabang Jalan Baru. Dana-dana tersebut akan dibukukan apabila sudah efektf masuk kedalam
 		     Rekening Koperasi Dana Pinjaman Mandiri Sejahtera.
		 		';
		$pdf->MultiCell(163,5,$angunan,false);

		$pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'Pelunasan :',0,1);
        $pdf->SetFont('times','',11);
        $angunan = '
 		     Setiap percepatan pelunasan pinjaman akan dikenakan biaya penalty sebesar 5% (persen)
 		     dari sisa nilai pokok pinjaman.
		 		';
		$pdf->MultiCell(163,5,$angunan,false);

		$pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'Kondisi :',0,1);
        $pdf->SetFont('times','',11);
        $angunan = '
 		  1. Asuransi
 		     a. Anggota diwajibkan untuk di cover Asuransi Jiwa dan Kebakaran (jaminan sertifikat).
 		     b. Apabila tidak dapat di Asuransikan maka anggota wajib membuat surat permohonan untuk
 		         tidak di cover Asuransi., maka segala resiko yang timbul sehubungan dengan pemberian
 		         pinjaman adalah "Tanggung Jawab Sepenuhnya dari Anggota".
 		  2. Pengikatan Peminjam.
 		     a. Penandatanganan Perjanjian Pinjaman atau Pengakuan  Hutang dan Perjanjian Jaminan
 		         Pinjaman oleh anggota dilakukan di hadapan Notaris yang ditunjuk oleh Koperasi, dimana
 		         saja apabila anggota memiliki  hubungan pernikahan maka Suami dan Istri lah yang
 		         menandatangani
 		         Perjanjian Pinjaman atau Pengakuan Hutang dan Perjanjian Jaminan Pinjaman tersebut.
 		     b. Apabila ada Penjamin harus ikut pula hadir dan menandatangani Perjanjian Pinjaman (apabila
 		         ada).
 		     c. Terkait pengikatan Jaminan Pinjaman / Sertifikat yang membutuhkan waktu dimana Koperasi
 		         tidak dapat menentukan waktu pencairan karena mengikuti peraturan Kantor BPN (Badan
 		          Pertanahan Nasional).
		 		';
		$pdf->MultiCell(163,5,$angunan,false);

		$pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'Persyaratan Lainnya :',0,1);
        $pdf->SetFont('times','',11);
        $angunan = '
 		  1. Koperasi berhak sewaktu-waktu meninjau kembali kelayakan usaha (untuk Peminjam wirausaha)
 		      dan kondisi serta keberadaan barang jaminan.
 		  2. Apabila calon anggota membatalkan proses pinjaman dan jaminan sudah berada ditangan Notaris.
 		      Maka semua biaya yang timbul akan dibebankan kepada calon anggota.


		 		';
		$pdf->MultiCell(163,5,$angunan,false);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

		$pdf->SetFont('times','B',11);
        $pdf->Cell(10,0,'Keadaan tak terduga :',0,1);
        $pdf->SetFont('times','',11);
        $angunan = '
 		  1. Semua biaya yang timbul sehubungan dengan pemberian fasilitas Pinjaman ini menjadi beban
 		      dan tanggung jawab Anggota.
 		  2. Apabila terdapat pelunasan kewajiban pinjaman maka jaminan akan dikeluarkan dengan catatan
 		      harus sudah dibukukan pelunasan pinjamannya dan jaminan pinjaman telah selesai proses
 		      pengurusan nya dengan pihak Notaris
 		  3. Apabila ingkar janji terhadap pembayaran angsuran setelah pemberitahuan sarat peringatan
 		      namun tidak ada pembayaran atau menunggak maka tindakan Koperasi Dana Pinjaman Mandiri
 		      Sejahtera akan melakulan:
 		        a. Memasang pengumuman dilokasi jaminan yang tertulis "Tanah dan Bangunan ini Jaminan
 		            Koperasi Dana Pinjaman Mandiri Sejahtera"
 		        b. Apabila telah dilakukan tindakan point A, tetapi tidak ada pembayaran seluruh kewajiban
 		            angsuran / masih menunggak maka pihak Koperasi Dana Pinjaman Mandiri Sejahtera
 		            akan melakulan tindakan sesuai hukum yang berlaku.

Semua kondisi yang tercantum dalam surat ini merupakan satu kesatuan yang tidak dapat dipisahkan dengan Perjanjian Pinjaman berikut urutan, perubahan, maupun penambahannya yang telah/akan ditanda tangani oleh Peminjam.

Surat ini berlaku 14(empat belas) hari sejak tanda tangan dan secara otomatis tidak berlaku lagi setelah lewatnya tanggal tersebut diatas.

Demikian disampaikan, atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.


		 		';
		$pdf->MultiCell(163,5,$angunan,false);

       	$pdf->SetFont('times','B',11);
       	$pdf->MultiCell(0,0,'Hormat Kami,                                                                                                  Menyetujui, ',0,'L',false);



        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,0,'                                                     ('.$data->nama_calon_debitur.')',0,'C',false);
       	$pdf->MultiCell(0,0,'(                                  )',0,'R',false);
        $pdf->Cell(10,4,'',0,1);

       	$pdf->MultiCell(0,0,'Koperasi Dana Pinjaman Mandiri Sejahtera',0,'L',false);
       	$pdf->MultiCell(0,0,'                                                     Peminjam',0,'C',false);
       	$pdf->MultiCell(0,0,'Pasangan/Penjamin ',0,'R',false);

        $pdf->Cell(10,6,'',0,1);

        $pdf->Output();
    }

	public function ReportOfferingLetterKendaraan($id_order){
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
    	$data = $this->business->DataReportOfferingLetter($id_order);
        //print_r($data);die();
        $gambar = base_url().'/assets/images/logoborder.png';
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');
		$pdf->Cell(0,8, " ", "B");
		$pdf->Ln(10);

        $pdf->SetXY(0,25);
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('times','',11);
        $pdf->Cell(0,14,'Nomor    : '.$data->nomor.' ',0,1);

       	$pdf->SetXY(0,25);
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('times','',11);
        $pdf->Cell(0,24,'Perihal    : Surat Pemberitahuan Persetujuan Pinjaman  ',0,1);

        $pdf->SetFont('times','',10);
        $pdf->Cell(0,6,'Bogor, '.$this->changeDate(date('Y-m-d')).'',0,1);

        $pdf->SetFont('times','',10);
        $pdf->Cell(0,10,'Kepada Yth,',0,1);
        $pdf->Cell(0,1,'Bapak/Ibu '.strtoupper($data->nama_calon_debitur).'',0,1);
        $pdf->Cell(0,10,''.strtoupper($data->domisili_alamat).'',0,1);
        $pdf->Cell(0,1,'KEL '.strtoupper($data->Kelurahan_domisili).' KEC '.strtoupper($data->Kecamatan_domisili).' - '.strtoupper($data->Kotakab_domisili),0,1);

        $pdf->SetXY(0,65);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
        $pdf->SetFont('times','',11);
       	$pdf->Cell(0,30,'Dengan Hormat,',0,1,'L');

        $pdf->SetXY(0,88);
        $pdf->Cell(10,10,'',0,1);
        $pdf->Cell(10,10,'',0,1);
       	$pdf->MultiCell(0,5,' Sehubungan dengan permohonan fasilitas pinjaman Bapak/Ibu melalui Surat Pemberitahuan persetujuan Pinjaman tertanggal '.$this->changeDate(date('Y-m-d')).', dengan ini kami beritahukan bahwa pada prinsipnya Koperasi Dana Pinjaman Mandiri Sejahtera Bogor bersedia memberikan fasilitas pinjaman kepada Bapak/Ibu dengan ketentuan sebagai berikut :',0,'J',false);


        $pdf->SetFont('times','B',10);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);

        $tenor = $data->approval_tenor;
       	$suku_bunga = $data->suku_bunga;
       	$pinjaman = $data->approval;
       	$angsuran_bunga = ($suku_bunga / 100) * $pinjaman;
       	$angsuran_pokok = $pinjaman / $tenor;
       	$jml_ang_per_bln = $angsuran_pokok + $angsuran_bunga;
       	$pem_ang = round($jml_ang_per_bln,-3);

		$kendaraan = $this->business->DetailMemoAoKendaraan($id_order)->row();

        $angunan = '
         Nama Calon Anggota                        : '.strtoupper($data->nama_calon_debitur).'
			      Nama Pemberi Peminjam                  : KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA
			      Jenis Fasilitas                                     : KONSUMTIF
			      Plafond                                               : Rp. '.number_format($data->approval, 2, ".", ".").'
			      Jangka Waktu Fasilitas Kredit           :  '.$data->approval_tenor.' Bulan
			      Suku bunga                                        :  '.$data->suku_bunga.'%
			      Denda                                                 : Rp. '.number_format(0, 2, ".", ".").' //BELUM DINAMIS
			      Provisi                                                : Rp. '.number_format($data->provisi, 2, ".", ".").'
			      Administrasi                                       : Rp. '.number_format($data->administrasi, 2, ".", ".").'
			      Asuransi Jiwa 3 tahun                        : Rp. '.number_format($data->premi_ass_jiwa, 2, ".", ".").'
			      Asuransi Tlo 3 tahun                          : Rp. '.number_format($data->notaris, 2, ".", ".").'//BELUM DINAMIS
			      Biaya Materai                                     : Rp. '.number_format($data->notaris, 2, ".", ".").'//BELUM DINAMIS
			      Notaris                                                : Rp. '.number_format($data->notaris, 2, ".", ".").'
			      Angsuran Per-bulan                            : Rp. '.number_format($pem_ang, 2, ".", ".").'

			      ANGUNAN

			         BPKB                                                : No. '.$kendaraan->no_bpkb.'
			         Merk                                                  : '.$kendaraan->nama_merk.'
			         Type                                                  : '.$kendaraan->type_kendaraan.'
			         No. Rangka  	            	                        : '.$kendaraan->no_rangka.'
			         No. Mesin                                          : '.$kendaraan->no_mesin.'
			         Model                                                 : '.$kendaraan->jenis_kendaraan.', Warna : '.$kendaraan->warna.', Tahun : '.$kendaraan->tahun.'
			         No. Polisi                                           : '.$kendaraan->no_polisi.'
			         Atas Nama                                         : '.strtoupper($data->atas_nama).'
		 		';


		$pdf->MultiCell(163,5,$angunan,false);

		$pdf->AddPage();
        $pdf->SetFont('times','B',10);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','',10);
        $angunan = '
    SYARAT PINJAMAN
 		 1. Cover asuransi kendaraan tlo
 		 2. Pengikat notaris
 		 3. blokir 1 bulan angsuran
		 		';


		$pdf->MultiCell(163,5,$angunan,false);

        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,5,'Semua biaya yang timbul dengan pemberian fasilitas Pinjaman ini menjadi beban dan tanggung jawab Peminjam.

Semua kondisi yang tercantum dalam surat ini merupakan satu kesatuan yang tidak dapat dipisahkan dengan Perjanjian Pinjaman berikut turutan, perubahan, maupun penambahannya yang telah/akan ditanda tangani oleh Peminjam.

Surat ini berlaku 14(empat belas) hari sejak tanda tangan dan secara otomatis tidak berlaku lagi setelah lewatnya tanggal tersebut diatas.
',0,'J',false);
       	$pdf->MultiCell(0,10,'Demikian disampaikan. Atas perhatian dan kerja samanya, kami ucapkan terima kasih',0,'J',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('times','B',11);
       	$pdf->MultiCell(0,0,'Hormat Kami,                                                                                                  Menyetujui, ',0,'L',false);

        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);

       	$pdf->MultiCell(0,0,'                                                     ('.$data->nama_calon_debitur.')',0,'C',false);
       	$pdf->MultiCell(0,0,'(                                  )',0,'R',false);
        $pdf->Cell(10,4,'',0,1);

       	$pdf->MultiCell(0,0,'Koperasi Dana Pinjaman Mandiri Sejahtera',0,'L',false);
       	$pdf->MultiCell(0,0,'                                                     Peminjam',0,'C',false);
       	$pdf->MultiCell(0,0,'Pasangan/Penjamin ',0,'R',false);

        $pdf->Cell(10,6,'',0,1);

        $pdf->Output();
    }

    public function ReportCAA($id_order){
        $pdf = new FPDF('P','mm','A4',true,'UTF-8',false);
        $gambar = base_url().'/assets/images/logoborder.png';
    	$data = $this->business->DataReportCaa($id_order)->row();
    	//print_r($data);die();
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->Image($gambar,11,5,25,25);

        $pdf->SetMargins(25,0,25);
        $pdf->SetFont('times','B',16);
        $pdf->Cell(200,14,'KOPERASI DANA PINJAMAN MANDIRI SEJAHTERA',0,1,'C');

		$pdf->Cell(0,8, " ", "B");
		$pdf->Ln(10);

        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','BU',14);
        $pdf->Cell(163,6,'NOTA USULAN PINJAMAN',0,0,'C');

        $pdf->SetFont('arial','BU',11);
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
       	$pdf->MultiCell(0,0,'Nomor Aplikasi',0,'L',false);
       	$pdf->MultiCell(0,0,'Tanggal',0,'R',false);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','B',9);
       	$pdf->MultiCell(0,0,$data->no_aplikasi,0,'L',false);
       	$pdf->MultiCell(0,0,$this->changeDate(date('Y-m-d')) ,0,'R',false);
        $pdf->Cell(10,6,'',0,1);

        $pdf->SetFont('arial','B',11);
        $pdf->Cell(163,6,'    DATA CALON DEBITUR',1,0);
        $pdf->SetFont('arial','',10);
        $datadebitur = '
   	Nama debitur                 : '.strtoupper($data->nama_identitas).'
 	  Alamat                           :  '.strtoupper($data->alamat_domisili).', RT '.$data->rt_domisili.', RW '.$data->rw_domisili.',
 	                                           KEL '.strtoupper($data->Kelurahan_domisili).' KEC '.strtoupper($data->Kecamatan_domisili).'
 	                                           '.strtoupper($data->Kotakab_domisili).'
 	  NPWP                            : '.strtoupper($data->npwp).'
 	  Tujuan penggunaan       : '.$data->tujuan_penggunaan.'


 		 ';
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','',11);
		$pdf->MultiCell(163,5,$datadebitur,'L R','L',false);

		$pdf->SetFont('arial','B',11);
        $pdf->Cell(163,6,'    SIFAT PINJAMAN   :  NEW',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','B',10);
		$pdf->SetFont('arial','B',11);
        $pdf->Cell(163,6,'    DATA LAIN LAIN',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','B',10);
        	$total = $data->provisi + $data->administrasi;


        	$tenor = $data->tenor_app;
	       	$suku_bunga = $data->suku_bunga;
	       	$pinjaman = $data->plafon_app;
	       	$angsuran_bunga = ($suku_bunga / 100) * $pinjaman;
	       	$angsuran_pokok = $pinjaman / $tenor;
	       	$jml_ang_per_bln = $angsuran_pokok + $angsuran_bunga;
	       	$pem_ang = round($jml_ang_per_bln,-3);
			$jaminan = '
			   JENIS FASILITAS            : '.$data->jenis_fasilitas.'
			   PLAFOND                        : Rp. '.number_format($data->plafon_app, 2, ".", ".").' ('.strtoupper($this->terbilang($data->plafon_app)).')
			   JASA                                : '.$data->suku_bunga.'%
			   ANGSURAN                    : Rp. '.number_format($pem_ang, 2, ".", ".").' ('.strtoupper($this->terbilang($pem_ang)).')
			   JANGKA WAKTU             : '.$data->tenor_app.' Bulan

      PROVISI                           : Rp. '.number_format($data->provisi, 2, ".", ".").' ('.strtoupper($this->terbilang($data->provisi)).')
			   ADM                                  : Rp. '.number_format($data->administrasi, 2, ".", ".").' ('.strtoupper($this->terbilang($data->administrasi)).')
			   TOTAL                              : Rp. '.number_format($total, 2, ".", ".").' ('.strtoupper($this->terbilang($total)).')

 		';

        $pdf->SetFont('arial','',10);
		$pdf->MultiCell(163,5,$jaminan,'L R B','L',false);

		$pdf->SetFont('arial','B',11);
        $pdf->Cell(163,6,'    JAMINAN & NILAI',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','',10);
        $Rcek_lingkungan = '
        BELUM DINAMIS


        ';
        $pdf->SetFont('arial','',10);
		$pdf->MultiCell(163,5,$Rcek_lingkungan,'L R B','L',false);
		$pdf->SetFont('arial','B',9);
        $pdf->Cell(163,6,'    SYARAT KHUSUS',1,0);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','',10);
        $keterangan_debitur = '
        BELUM DINAMIS


        ';
        $pdf->SetFont('arial','',10);
		$pdf->MultiCell(163,5,$keterangan_debitur,'L R B','L',false);
 		$pdf->AddPage();
        $pdf->Cell(10,6,'',0,1);
        $pdf->Cell(10,6,'',0,1);
        $pdf->SetFont('arial','',1,10);
        $fasilitas_kredit = '
			DI USULKAN SEBESAR   : Rp. '.number_format($data->rek_ao_ca, 2, ".", ".").' ('.strtoupper($this->terbilang($data->rek_ao_ca)).') - '.$data->tenor_ao_ca.' BULAN

			REKOMENDASI        : BELUM DINAMIS

			                                                                                                                      ACCOUNT OFFICER



			                                                                                                                          _______________

 		';

        $pdf->SetFont('arial','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'T L R B','L',false);

		$app_manager = $this->Model_business->DataApprovalManager($id_order)->row();
        $fasilitas_kredit = '
   DISETUJUI / DI TOLAK SEBESAR : Rp. '.number_format($app_manager->plafon, 2, ".", ".").' ('.strtoupper($this->terbilang($app_manager->plafon)).') - '.$app_manager->tenor.' BULAN

			ALASAN   : '.$app_manager->alasan.'

			SYARAT   : '.$app_manager->syarat.'

			                                                                                                                                MANAGER



			                                                                                                                          _______________

 		';

        $pdf->SetFont('arial','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'T L R B','L',false);

		$pdf->SetFont('arial','',1,10);
		$app_ketua = $this->Model_business->DataApprovalKetua($id_order)->row();
        $fasilitas_kredit = '
   DISETUJUI / DI TOLAK SEBESAR : Rp. '.number_format($app_ketua->plafon, 2, ".", ".").' ('.strtoupper($this->terbilang($app_ketua->plafon)).') - '.$app_ketua->tenor.' BULAN

			ALASAN   : '.$app_ketua->alasan.'

			SYARAT   : '.$app_ketua->syarat.'

			                                                                                                                                PENGURUS



			                                                                                                                          _______________

 		';

        $pdf->SetFont('arial','',10);
		$pdf->MultiCell(163,5,$fasilitas_kredit,'T L R B','L',false);

        $pdf->Output();
	}

	public function DataReportCaa($id_order)
	{
    	$data = $this->business->DataReportCaa($id_order)->row();
		print_r($data);die();
	}

	public function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp = $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp = $this->penyebut($nilai/10)." puluh". $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" . $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" . $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp = $this->penyebut($nilai/1000000000) . " milyar" . $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp = $this->penyebut($nilai/1000000000000) . " trilyun" . $this->penyebut(fmod($nilai,1000000000000));
		}
		return $temp;
	}

	public function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}
		return $hasil.' rupiah';
	}

    public function changeDate($date)
	{


		$gettgl = explode(' ',$date);
		$dateex = explode('-',$gettgl[0]);
		$return = '';
		switch ($dateex[1]) {
			case '01':
				return $return = $dateex[2]." Januari ".$dateex[0];
			case '02':
				return $return = $dateex[2]." Februari ".$dateex[0];
			case '03':
				return $return = $dateex[2]." Maret ".$dateex[0];
			case '04':
				return $return = $dateex[2]." April ".$dateex[0];
			case '05':
				return $return = $dateex[2]." Mei ".$dateex[0];
			case '06':
				return $return = $dateex[2]." Juni ".$dateex[0];
				break;
			case '07':
				return $return = $dateex[2]." Juli ".$dateex[0];
				break;
			case '08':
				return $return = $dateex[2]." Agustus ".$dateex[0];
				break;
			case '09':
				return $return = $dateex[2]." September ".$dateex[0];
				break;
			case '10':
				return $return = $dateex[2]." Oktober ".$dateex[0];
				break;
			case '11':
				return $return = $dateex[2]." November ".$dateex[0];
				break;
			default:
				return $return = $dateex[2]." Desember ".$dateex[0];
				break;
		}
		echo $return;
	}
}
?>

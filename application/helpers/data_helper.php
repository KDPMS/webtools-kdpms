<?php
    date_default_timezone_set('Asia/Jakarta');

    //membuat format angka menjadi rupiah
    function rupiah($angka){
            
        $hasil = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil;
    }

    // mengubah lending menjadi dalam format juta
    function ubahJuta($angka){

        $nominal = round($angka * 1000000);
        $ubahFormatRupiah = rupiah($nominal);
        return $ubahFormatRupiah;
    }
    
    //menubah nama bulan 
    function ubahBulan($bln){

        $bulan_array = array(
            '01'=>"Januari",
            '02'=>"Februari",
            '03'=>"Maret", 
            '04'=>"April", 
            '05'=>"Mei",
            '06'=>"Juni",
            '07'=>"Juli",
            '08'=>"Agustus",
            '09'=>"September",
            '10'=>"Oktober", 
            '11'=>"November",
            '12'=>"Desember");

        $bulan = $bulan_array[$bln];
        return $bulan;
    }

    //ubah nama kantor berdasarkan id kantor
    function namaKantor($kode){

        $kantor_array = array(
            '01' => "Pusat", 
            '02' => "Cabang Cilodong");

        $kantor = $kantor_array[$kode];
        return $kantor;
    }

    // ubah format date menjadi tanggal-bulan-tahun
    function ubahDate($date){
        
        $ubahDate = date("d F Y", strtotime($date));
        return $ubahDate;
    }

    // mengambil 2 angka setelah koma
    function ambil2Angka($angka){
        
        $ubah = number_format($angka, 2);
        return $ubah;
    }
?>
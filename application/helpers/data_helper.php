<?php

    function rupiah($angka){
            
        $hasil = "Rp " . number_format($angka, 2, ',', '.');
        return $hasil;
    }
    
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

    function namaKantor($kode){
        $kantor_array = array(
            '01' => "Pusat", 
            '02' => "Cabang Cilodong");

        $kantor = $kantor_array[$kode];
        return $kantor;
    }

    function ubahDate($date){
        
        $ubahDate = date("d F Y", strtotime($date));
        return $ubahDate;
    }
?>
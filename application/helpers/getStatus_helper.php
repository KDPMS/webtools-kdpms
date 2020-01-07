<?php

// mengambil status lending cabang
function getStatusLendingCabang($angka, $param1, $param2, $param3){
  
    switch($angka){
        case $angka >= $param3 :
            $status = "Sangat tercapai";
            break;
        case $angka >= $param2 :
            $status = "Tercapai";
            break;
        case $angka >= $param1 :
            $status = "Hampir tercapai";
            break;
        case $angka >= 0 :
            $status = "Tidak tercapai";
            break;
        default :
            $status = "Not valid";
            break;
    }  

    return $status;
}

// mengambil status npl cabang
function getStatusNPLCabang($angka, $param1, $param2, $param3){

    switch($angka){
        case $angka >= $param3 :
            echo "Tidak tercapai";
            break;
        case $angka >= $param2 :
            echo "Hampir tercapai";
            break;
        case $angka >= $param1 :
            echo "Tercapai";
            break;
        case $angka >= 0 :
            echo "Sangat tercapai";
            break;
        default :
            echo 'tidak ada status';
            break;
    }  
}

// mengambil status cr cabang
function getStatusCRCabang($angka){

    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status bz cabang
function getStatusBZCabang($angka){

    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status NS Cabang
function getStatusNSCabang($angka){
  
    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status lending AO
function getStatusLendingAO($angka){
  
    switch($angka){
        case $angka >= 292 :
            $status = "Sangat tercapai";
            break;
        case $angka >= 233 :
            $status = "Tercapai";
            break;
        case $angka >= 175 :
            $status = "Hampir tercapai";
            break;
        case $angka >= 0 :
            $status = "Tidak tercapai";
            break;
        default :
            $status = "Not valid";
            break;
    }  
    return $status;
}

// mengambil status npl kolektor
function getStatusNPLKol($angka){

    if($angka >= 83) {
        $return = "Tidak tercapai";
    }else if($angka >= 67) {
        $return = "Hampir Tercapai";
    }else if($angka >= 50) {
        $return = "Tercapai";
    }else if($angka >= 0) {
        $return = "Sangat tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status cr kolektor
function getStatusCRKol($angka){
  
    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status bz kolektor
function getStatusBZKol($angka){
  
    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status bz kolektor
function getStatusBZAO($angka){
  
    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status NS AO
function getStatusNSAO($angka){
  
    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status kolektibilitas 1
function getStatusKolektibilitas1($angka){

    if($angka >= 83) {
        $return = "Sangat tercapai";
    }else if($angka >= 67) {
        $return = "Tercapai";
    }else if($angka >= 50) {
        $return = "Hampir tercapai";
    }else if($angka >= 0) {
        $return = "Tidak tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}

// mengambil status kolektibilitas 2-5
function getStatusKolektibilitas($angka){

    if($angka >= 83) {
        $return = "Tidak tercapai";
    }else if($angka >= 67) {
        $return = "Hampir Tercapai";
    }else if($angka >= 50) {
        $return = "Tercapai";
    }else if($angka >= 0) {
        $return = "Sangat tercapai";
    }else {
        $return = "Tidak ada status";
    }

    return $return;
}
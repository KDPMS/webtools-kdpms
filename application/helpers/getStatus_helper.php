<?php

// mengambil status lending cabang
function getStatusLendingCabang($angka){
  
    switch($angka){
        case $angka >= 2100 :
            $status = "Sangat tercapai";
            break;
        case $angka >= 1400 :
            $status = "Tercapai";
            break;
        case $angka >= 1050 :
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

// mengambil status lending cabang
function getStatusNPLCabang($angka){

    switch($angka){
        case $angka >= 42 :
            echo "Tidak tercapai";
            break;
        case $angka >= 33 :
            echo "Hampir tercapai";
            break;
        case $angka >= 25 :
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

// mengambil status lending cabang
function getStatusCRCabang($angka){

    switch($angka){
        case $angka >= 2100 :
            echo "sangat tercapai";
            break;
        case $angka >= 1400 :
            echo "tercapai";
            break;
        case $angka >= 1050 :
            echo "hampir tercapai";
            break;
        case $angka >= 0 :
            echo "tidak tercapai";
            break;
        default :
            echo 'tidak ada status';
            break;
    }  
}

// mengambil status lending cabang
function getStatusBZCabang($angka){

    switch($angka){
        case $angka >= 2100 :
            echo "sangat tercapai";
            break;
        case $angka >= 1400 :
            echo "tercapai";
            break;
        case $angka >= 1050 :
            echo "hampir tercapai";
            break;
        case $angka >= 0 :
            echo "tidak tercapai";
            break;
        default :
            echo 'tidak ada status';
            break;
    }  
}
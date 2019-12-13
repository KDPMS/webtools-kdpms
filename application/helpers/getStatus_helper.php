<?php

// mengambil status lending cabang
function getStatusLendingCabang($angka){
  
    switch($angka){
        case $angka >= 1750 :
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

// mengambil status npl cabang
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

// mengambil status cr cabang
function getStatusCRCabang($angka){

    switch($angka){
        case $angka >= 83 :
            echo "Sangat tercapai";
            break;
        case $angka >= 67 :
            echo "Tercapai";
            break;
        case $angka >= 50 :
            echo "Hampir tercapai";
            break;
        case $angka >= 0 :
            echo "Tidak tercapai";
            break;
        default :
            echo 'Tidak ada status';
            break;
    }  
}

// mengambil status bz cabang
function getStatusBZCabang($angka){

    switch($angka){
        case $angka >= 83 :
            echo "Sangat tercapai";
            break;
        case $angka >= 67 :
            echo "Tercapai";
            break;
        case $angka >= 50 :
            echo "Hampir tercapai";
            break;
        case $angka >= 0 :
            echo "Tidak tercapai";
            break;
        default :
            echo 'Tidak ada status';
            break;
    }  
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

    switch($angka){
        case $angka >= 83 :
            echo "Tidak tercapai";
            break;
        case $angka >= 67 :
            echo "Hampir tercapai";
            break;
        case $angka >= 50 :
            echo "Tercapai";
            break;
        case $angka >= 0 :
            echo "Sangat tercapai";
            break;
        default :
            echo 'Tidak ada status';
            break;
    }  
}

// mengambil status cr kolektor
function getStatusCRKol($angka){
  
    switch($angka){
        case $angka >= 83 :
            $status = "Sangat tercapai";
            break;
        case $angka >= 67 :
            $status = "Tercapai";
            break;
        case $angka >= 50 :
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

// mengambil status bz kolektor
function getStatusBZKol($angka){
  
    switch($angka){
        case $angka >= 83 :
            $status = "Sangat tercapai";
            break;
        case $angka >= 67 :
            $status = "Tercapai";
            break;
        case $angka >= 50 :
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

// mengambil status bz kolektor
function getStatusBZAO($angka){
  
    switch($angka){
        case $angka >= 83 :
            $status = "Sangat tercapai";
            break;
        case $angka >= 67 :
            $status = "Tercapai";
            break;
        case $angka >= 50 :
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
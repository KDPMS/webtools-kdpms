
//merubah format angka menjadi rupiah
function rupiah(angka) {

    if (angka == null) {
		rupiah = '0'
	}else {
		var	number_string = angka.toString(),
		sisa 	= number_string.length % 3,
		rupiah 	= number_string.substr(0, sisa),
		ribuan 	= number_string.substr(sisa).match(/\d{3}/g);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}
	}

	return 'Rp. ' + rupiah;
}

// merubah angka menjadi juta di lending
function ubahJuta(angka) {

    let nominal = Math.round(angka * 1000000);
    let ubahFormatRupiah = rupiah(nominal);

    return ubahFormatRupiah;
}

//merubah format date menjandi format date indonesia
function ubahDate(date) {

    let tgl = date.substr(8, 2);
    let bln = date.substr(5, 2);
    let thn = date.substr(0, 4);

    switch (bln) {
        case '01' :
            bln = 'Jan';
            break;
        case '02' :
            bln = 'Feb';
            break;
        case '03' :
            bln = 'Mar';
            break;
        case '04' :
            bln = 'Apr';
            break;
        case '05' :
            bln = 'Mei';
            break;
        case '06' :
            bln = 'Jun';
            break;
        case '07' :
            bln = 'Jul';
            break;
        case '08' :
            bln = 'Agu';
            break;
        case '09' :
            bln = 'Sep';
            break;
        case '10' :
            bln = 'Okt';
            break;
        case '11' :
            bln = 'Nov';
            break;
        case '12' :
            bln = 'Des';
            break;
        default :
            bln = 'unknow';
            break;
    }

    let tanggalIndonesia = tgl + " " + bln + " " + thn;
    return tanggalIndonesia;
} 

// mengambil 2 angka setelah koma
function ambil2Angka(angka) {
    let ubahAngka = Number(angka);
    let ubah = ubahAngka.toFixed(2);

    return ubah;
}

// get kolektibilitas sesuai angka
function getKolektibilitas(angka) {

    let status;

    switch (angka) {
        case 1 :
            status = "Lancar";
            break;
        case 2 :
            status = "Dalam Perhatian Khusus (DPK)";
            break;
        case 3 :
            status = "Kredit Kurang Lancar";
            break;
        case 4 :
            status = "Diragukan";
            break;
        case 5 :
            status = "Macet";
            break;
        default :
            status = "Tidak valid";
            break;
    }

    return status;
}

// fungsi konversi data hari kedalam bulan
function convertDayMonth(hari) {

    let hariPerBulan = 30;
    let hasil;

    let cariBulan = Math.floor(hari / hariPerBulan);
    let sisaHari = hari % hariPerBulan;

    if (cariBulan == 0) {
        hasil = hari + " Hari";
    } else if (sisaHari == 0) {
        hasil = cariBulan + " Bulan " + "(" + hari + " Hari)";
    } else {
        hasil = cariBulan + " Bulan " + sisaHari + " Hari " + "(" + hari + " Hari)";
    }

    return hasil;
}

//ambil data spedo agar dapat mengambil status berdasarkan warna
function getDataSpedo(data) {

    let spedo = data;
    let regex = spedo.replace(/[^\d,-]/g, '');
    let hasil = regex.split(",");

    return hasil;
}

// get all status kecuali npl (sesuai dengan data spedo yg ada didatabase)
function getStatus(angka, param1, param2, param3, param4) {

    let hasil;

    if (angka >= param4) {
        hasil = "Sangat Tercapai";
    } else if (angka >= param3) {
        hasil = "Tercapai";
    } else if (angka >= param2) {
        hasil = "Hampir Tercapai";
    } else if (angka >= param1) {
        hasil = "Tidak Tercapai";
    } else {
        hasil = "status 404";
    }

    return hasil;
}

//get status untuk npl (sesuai dengan data spedo yg ada didatabase)
function getStatusNPL(angka, param1, param2, param3, param4) {

    let hasil;

    if (angka >= param4) {
        hasil = "Tidak Tercapai";
    } else if (angka >= param3) {
        hasil = "Hampir Tercapai";
    } else if (angka >= param2) {
        hasil = "Tercapai";
    } else if (angka >= param1) {
        hasil = "Sangat Tercapai";
    } else {
        hasil = "status 404";
    }

    return hasil;
}

function removeQuotes(param) {

    let data = param.replace(/"([^"]+(?="))"/g, '$1');
    cosnole.log(data);
}


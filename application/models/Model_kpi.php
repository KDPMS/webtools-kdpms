<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Model_kpi extends CI_Model {

	//KPI NPL
	public function npl_cabang($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl"); // GET VIEW NPL PER CABANG
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function npl_kolektor($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ // GET VIEW NPL ALL KOLEKTOR
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_kolektor WHERE kode_kantor = '$kode_kantor'");
	}

	public function npl_per_kolektor($tahun = '', $bulan = '', $kode_group3 = '', $kode_kantor = '', $tanggal = '15'){ // GET VIEW NPL Per KOLEKTOR
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_kolektor WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}

	public function npl_kolektor_detail($tahun = '', $bulan = '', $kode_group3 = '', $kode_kantor = '', $tanggal = '15'){	// GET VIEW NPL PER KOLEKTOR-DETAIL
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_npl WHERE kode_kantor = '$kode_kantor'");
	}
	//END KPI NPL
	

	// KPI LENDING
	public function lending_cabang($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ // GET VIEW LENDING PER CABANG
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function lending_ao($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ // GET VIEW LENDING ALL AO
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_ao WHERE kode_kantor = '$kode_kantor'");
	}

	public function lending_per_ao($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){ // GET VIEW LENDING PER AO
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function lending_ao_detail($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){ // GET VIEW LENDING PER AO-DETAIL
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_lending WHERE kode_kantor = '$kode_kantor'");
	}
	// END KPI LENDING
	

	//KPI COLLECTION RATIO
	// CR KOLEKTOR
	public function cr_cabang_kolektor($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ // GET VIEW COLLECTION RATIO PER CABANG
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function cr_kolektor($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ //GET VIEW COLLECTION RATIO ALL KOLEKTOR
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_kolektor WHERE kode_kantor = '$kode_kantor'");
	}

	public function cr_per_kolektor($tahun = '', $bulan = '', $kode_group3 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW COLLECTION RATIO Per KOLEKTOR
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_kolektor WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}

	public function cr_kolektor_detail($tahun = '', $bulan = '', $kode_group3 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW COLLECTION RATIO PER KOLEKTOR-DETAIL
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_cr WHERE kode_kantor = '$kode_kantor'");
	}

	// CR AO
	public function cr_cabang_ao($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ // GET VIEW COLLECTION RATIO AO PER CABANG
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_ao_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function cr_ao($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ //GET VIEW COLLECTION RATIO ALL AO
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_ao as a LEFT JOIN kms.kre_kode_group2 as b ON a.kode_group2 = b.kode_group2 WHERE a.kode_kantor = '$kode_kantor' AND b.flg_aktif = '1'");
	}

	public function cr_per_ao($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW COLLECTION RATIO Per AO
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function cr_ao_detail($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW COLLECTION RATIO PER KOLEKTOR-DETAIL
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_cr WHERE kode_kantor = '$kode_kantor'");
	}
	//END KPI COLLECTION RATIO

	
	//KPI BUCKET ZERO
	public function bz_cabang_kolektor($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ // GET VIEW BUCKET ZERO PER CABANG
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_cabang WHERE kode_kantor = '$kode_kantor'");
  	}

  	public function bz_kolektor($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ //GET VIEW BUCKET ZERO ALL KOLEKTOR
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_kolektor WHERE kode_kantor = '$kode_kantor'");
	}

	public function bz_per_kolektor($tahun = '', $bulan = '', $kode_group3 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW BUCKET ZERO Per KOLEKTOR
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_kolektor WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}
	
	public function bz_kolektor_detail($tahun = '', $bulan = '', $kode_group3 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW BUCKET ZERO PER KOLEKTOR-DETAIL
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_bucket_zero  WHERE kode_kantor = $kode_kantor");
	}

	public function bz_per_ao($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor, $tanggal = '15'){ //GET VIEW BUCKET ZERO PER AO
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function bz_ao_detail($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW BUCKET ZERO PER AO-DETAIL
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_bucket_zero WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}
	//END KPI BUCKET ZERO

	
	//KPI NON STARTER
	public function ns_cabang($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl"); // GET VIEW NPL PER CABANG
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_fid_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function ns_ao($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_fid_ao WHERE kode_kantor = '$kode_kantor'");
	}

	public function ns_per_ao($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_fid_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function ns_ao_detail($tahun = '', $bulan = '', $kode_group2 = '', $kode_kantor = '', $tanggal = '15'){ //GET VIEW NS DETAIL AO
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_fid WHERE kode_kantor = '$kode_kantor'");
	}
	//END KPI NON STARTER
	

	//KOLEKTIBILITAS
	public function kolektibilitas($tahun = '', $bulan = '', $kode_kantor = '', $tanggal ='15'){ //GET VIEW KOLEKTIBILITAS
		$this->db->query("SELECT LAST_DAY('$tahun-$bulan-$tanggal') INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_kolektibilitas WHERE kode_kantor = '$kode_kantor' ORDER BY kolektibilitas ASC");
	}
	//END KOLEKTIBILITAS

}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Model_kpi extends CI_Model {

	//KPI NPL
	public function datakpi_npl($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl"); // GET VIEW NPL PER CABANG
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_npl_Kol($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ // GET VIEW NPL ALL KOLEKTOR
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_kolektor WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_npl_Per_Kol($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){ // GET VIEW NPL Per KOLEKTOR
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_kolektor WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}

	public function datakpi_npl_Kol_detail($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){	// GET VIEW NPL PER KOLEKTOR-DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_npl WHERE kode_kantor = '$kode_kantor'");
	}
	//END KPI NPL
	

	// KPI LENDING
	public function datakpi_lending($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ // GET VIEW LENDING PER CABANG
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_lending_AO($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ // GET VIEW LENDING ALL AO
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_ao WHERE kode_kantor = '$kode_kantor' ORDER BY jml_value DESC");
	}

	public function datakpi_lending_Per_AO($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor = ''){ // GET VIEW LENDING PER AO
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function datakpi_lending_AO_detail($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor = ''){ // GET VIEW LENDING PER AO-DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_lending WHERE kode_kantor = '$kode_kantor'");
	}
	// END KPI LENDING
	

	//KPI COLLECTION RATIO
	public function datakpi_CR($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ // GET VIEW COLLECTION RATIO PER CABANG
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_CR_Kol($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ //GET VIEW COLLECTION RATIO ALL KOLEKTOR
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_kolektor WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_CR_Per_Kol($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){ //GET VIEW COLLECTION RATIO Per KOLEKTOR
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_kolektor WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}

	public function datakpi_CR_Kol_detail($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){ //GET VIEW COLLECTION RATIO PER KOLEKTOR-DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_cr WHERE kode_kantor = '$kode_kantor'");
	}
	//END KPI COLLECTION RATIO

	
	//KPI BUCKET ZERO
	public function datakpi_BZ($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ // GET VIEW BUCKET ZERO PER CABANG
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_cabang WHERE kode_kantor = '$kode_kantor'");
  	}

  	public function datakpi_BZ_Kol($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ //GET VIEW BUCKET ZERO ALL KOLEKTOR
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_kolektor WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_BZ_Per_Kol($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){ //GET VIEW BUCKET ZERO Per KOLEKTOR
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_kolektor WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}
	
	public function datakpi_BZ_Kol_detail($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){ //GET VIEW BUCKET ZERO PER KOLEKTOR-DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_bucket_zero  WHERE kode_kantor = $kode_kantor");
	}

	public function datakpi_BZ_Per_AO($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor){ //GET VIEW BUCKET ZERO PER AO
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function datakpi_BZ_AO_detail($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor = ''){ //GET VIEW BUCKET ZERO PER AO-DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_bucket_zero WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}
	//END KPI BUCKET ZERO


	//KPI MITRA
	public function datakpi_Mitra_AOdetail($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor = ''){ // GET VIEW MITRA DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_mitra WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}
	//END KPI MITRA

	
	//KPI NON STARTER
	public function datakpi_NS($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl"); // GET VIEW NPL PER CABANG
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_fid_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_NS_AO($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_fid_ao WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpi_NS_Per_AO($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor = ''){
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_fid_ao WHERE kode_group2 = '$kode_group2' AND kode_kantor = '$kode_kantor'");
	}

	public function datakpi_NS_AOdetail($tahun = '', $bulan = '', $tanggal = '', $kode_group2 = '', $kode_kantor = ''){ //GET VIEW NS DETAIL AO
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_fid WHERE kode_kantor = '$kode_kantor'");
	}
	//END KPI NON STARTER


	//KPI SP RETURN
	public function datakpi_SPreturn_Kol_detail($tahun = '', $bulan = '', $tanggal = '', $kode_group3 = '', $kode_kantor = ''){ //GET VIEW SP-RETURN PER KOLEKTOR-DETAIL
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_kolektor_sp_return WHERE kode_group3 = '$kode_group3' AND kode_kantor = '$kode_kantor'");
	}
	//END KPI SP RETURN

	//KOLEKTIBILITAS
	public function dataKolektibilitas($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = ''){ //GET VIEW KOLEKTIBILITAS
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_kolektibilitas WHERE kode_kantor = '$kode_kantor' ORDER BY kolektibilitas ASC");
	}
	//END KOLEKTIBILITAS

}
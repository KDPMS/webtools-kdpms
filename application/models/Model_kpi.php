<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
class Model_kpi extends CI_Model {

	public function datakpinpl($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = '01'){
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl"); // GET VIEW NPL PER CABANG
			return $this->db->query("SELECT * FROM kms_kpi.v_kpi_npl_cabang WHERE kode_kantor = '$kode_kantor'");
	}
	
	// KPI LENDING
	public function datakpilending($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = '01'){ // GET VIEW LENDING PER CABANG
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_cabang WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpilendingAO($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = '01'){ // GET VIEW LENDING PER AO
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_lending_ao WHERE kode_kantor = '$kode_kantor'");
	}

	public function datakpilendingAOdetail($tahun = '', $bulan = '', $tanggal = '', $kode_group2){ // GET VIEW DETAIL LENDING PER AO
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		$this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_ao_lending");
	}
	// END KPI LENDING
	
	public function datakpiCR($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = '01'){ // GET VIEW COLLECTION REATIO PER CABANG
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_cr_cabang WHERE kode_kantor = '$kode_kantor'");
	}
	
	public function datakpiBZ($tahun = '', $bulan = '', $tanggal = '', $kode_kantor = '01'){ // GET VIEW BUCKET ZERO PER CABANG
		$this->db->query("SELECT '$tahun-$bulan-$tanggal' INTO @pv_per_tgl");
		return $this->db->query("SELECT * FROM kms_kpi.v_kpi_bz_cabang WHERE kode_kantor = '$kode_kantor'");
  }
  
}
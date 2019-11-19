<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	exit;
}

class Kpi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('Model_business','business');
		$this->load->model('Model_kpi','kpi');
	}

	public function index()
	{
		if (empty($this->session->userdata('id'))) {
			redirect('/','refresh');
		}else{
			$this->load->view('index-npl');
		}
	}
	
	public function dashboard_kpi(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$kantor = $this->input->post('kantor');
		$tanggal = date('d');
		
		if(empty($tahun)){
			$tahun = date('Y');
		}

		if(empty($bulan)){
			$bulan = date('m');
		}

		if(empty($kantor)){
			$kantor = "01";
		}

		if($kantor == "01") {
			$data['kantor'] = "Pusat";	
		}else{
			$data['kantor'] = "Cabang Cilodong";
		}
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['ubahBulan'] = array('01'=>"Januari",'02'=>"Februari",'03'=>"Maret", '04'=>"April", '05'=>"Mei",'06'=>"Juni",'07'=>"Juli",'08'=>"Agustus",'09'=>"September",'10'=>"Oktober", '11'=>"November",'12'=>"Desember");
		
		$data['dataKpiNpl'] = $this->kpi->datakpinpl($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiLending'] = $this->kpi->datakpilending($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiCR'] = $this->kpi->datakpiCR($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiBZ'] = $this->kpi->datakpiBZ($tahun, $bulan, $tanggal, $kantor)->result();
		$data['datakpilendingAO'] = $this->kpi->datakpilendingAO($tahun, $bulan, $tanggal, $kantor)->result();
		$data['datakpilendingAOdetail'] = $this->kpi->datakpilendingAOdetail($tahun, $bulan, $tanggal, '15')->result();
		
		$this->load->view('dashboard_kpi',$data);
	}

	public function dashboard_kpi_ao(){
		$this->load->view('dashboard_kpi_ao');
	}

	public function dashboard_kpi_col(){
		$this->load->view('dashboard_kpi_col');
	}

}

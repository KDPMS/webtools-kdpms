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

		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['kantor'] = $kantor;
		
		$data['dataKpiNpl'] = $this->kpi->datakpi_npl($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiNplKol'] = $this->kpi->datakpi_npl_Kol($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiNplKoldetail'] = $this->kpi->datakpi_npl_Kol_detail($tahun, $bulan, $tanggal, '09',$kantor)->result();
		$data['dataKpiLending'] = $this->kpi->datakpi_lending($tahun, $bulan, $tanggal, $kantor)->result();
		$data['datakpilendingAO'] = $this->kpi->datakpi_lending_AO($tahun, $bulan, $tanggal, $kantor)->result();
		$data['datakpilendingAOdetail'] = $this->kpi->datakpi_lending_AOdetail($tahun, $bulan, $tanggal, '15')->result();
		$data['dataKpiCR'] = $this->kpi->datakpi_CR($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiCRKol'] = $this->kpi->datakpi_CR_Kol($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiCRKoldetail'] = $this->kpi->datakpi_CR_Kol_detail($tahun, $bulan, $tanggal, '09',$kantor)->result();
		$data['dataKpiBZ'] = $this->kpi->datakpi_BZ($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiBZKol'] = $this->kpi->datakpi_BZ_Kol($tahun, $bulan, $tanggal, $kantor)->result();
		$data['dataKpiBZKoldetail'] = $this->kpi->datakpi_BZ_Kol_detail($tahun, $bulan, $tanggal, '09',$kantor)->result();
		
		
		$this->load->helper('data');
		$this->load->view('dashboard_kpi',$data);
	}

	public function dashboard_kpi_ao(){
		$this->load->view('dashboard_kpi_ao');
	}

	public function dashboard_kpi_col(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tanggal = date('d');
		$kantor = $this->session->userdata('kantor');
		
		if(empty($tahun)){
			$tahun = date('Y');
		}

		if(empty($bulan)){
			$bulan = date('m');
		}


		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['date'] = $tahun."-".$bulan."-".$tanggal;

		$data['dataKpiBZKol'] = $this->kpi->datakpi_BZ_Per_Kol($tahun, $bulan, $tanggal, '09', $kantor)->result();
		$data['dataKpiBZKoldetail'] = $this->kpi->datakpi_BZ_Kol_detail($tahun, $bulan, $tanggal, '09', $kantor)->result();

		$data['dataKpiCRKol'] = $this->kpi->datakpi_CR_Per_Kol($tahun, $bulan, $tanggal, '09', $kantor)->result();
		$data['dataKpiCRKoldetail'] = $this->kpi->datakpi_CR_Kol_detail($tahun, $bulan, $tanggal, '09', $kantor)->result();

		$data['dataKpiNplKol'] = $this->kpi->datakpi_npl_Per_Kol($tahun, $bulan, $tanggal, '09', $kantor)->result();
		$data['dataKpiNplKoldetail'] = $this->kpi->datakpi_npl_Kol_detail($tahun, $bulan, $tanggal, '09', $kantor)->result();

		$this->load->helper('data');
		$this->load->view('dashboard_kpi_col', $data);
	}
	

}

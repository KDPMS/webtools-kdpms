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
		$this->load->helper('data');
		$this->load->helper('getStatus');
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

		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{

			$bulan   = $this->input->post('bulan');
			$tahun   = $this->input->post('tahun');
			$kantor  = $this->input->post('kantor');
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
			
			$data['bulan']   = $bulan;
			$data['tahun']   = $tahun;
			$data['tanggal'] = $tanggal;
			$data['date'] = $tahun."-".$bulan."-".$tanggal;
			$data['kantor']  = $kantor;
			
			$data['dataKpiNpl'] = $this->kpi->datakpi_npl($tahun, $bulan, $tanggal, $kantor)->result();
			$data['dataKpiNplKol'] = $this->kpi->datakpi_npl_Kol($tahun, $bulan, $tanggal, $kantor)->result();
			$data['dataKpiNplKoldetail'] = $this->kpi->datakpi_npl_Kol_detail($tahun, $bulan, $tanggal, '09', $kantor)->result();

			$data['dataKpiLending'] = $this->kpi->datakpi_lending($tahun, $bulan, $tanggal, $kantor)->result();
			$data['datakpilendingAO'] = $this->kpi->datakpi_lending_AO($tahun, $bulan, $tanggal, $kantor)->result();
			$data['datakpilendingAOdetail'] = $this->kpi->datakpi_lending_AO_detail($tahun, $bulan, $tanggal, '15', $kantor)->result();
			
			$data['dataKpiCR'] = $this->kpi->datakpi_CR($tahun, $bulan, $tanggal, $kantor)->result();
			$data['dataKpiCRKol'] = $this->kpi->datakpi_CR_Kol($tahun, $bulan, $tanggal, $kantor)->result();
			$data['dataKpiCRKoldetail'] = $this->kpi->datakpi_CR_Kol_detail($tahun, $bulan, $tanggal, '09', $kantor)->result();
			
			$data['dataKpiBZ'] = $this->kpi->datakpi_BZ($tahun, $bulan, $tanggal, $kantor)->result();
			$data['dataKpiBZKol'] = $this->kpi->datakpi_BZ_Kol($tahun, $bulan, $tanggal, $kantor)->result();
			$data['dataKpiBZKoldetail'] = $this->kpi->datakpi_BZ_Kol_detail($tahun, $bulan, $tanggal, '09', $kantor)->result();
			
			$this->load->view('include/headerkpi');
			$this->load->view('dashboard_kpi',$data);
			$this->load->view('include/footerkpi');
		}
	}


	public function dashboard_kpi_ao(){
		
		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{

			$bulan       = $this->input->post('bulan');
			$tahun       = $this->input->post('tahun');
			$tanggal     = date('d');
			$kantor      = $this->session->userdata('kantor');
			$kode_group2 = '05';
			
			if(empty($tahun)){
				$tahun = date('Y');
			}

			if(empty($bulan)){
				$bulan = date('m');
			}

			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['date']  = $tahun."-".$bulan."-".$tanggal;

			$data['dataKpiLendingAO'] = $this->kpi->datakpi_lending_Per_AO($tahun, $bulan, $tanggal, $kode_group2, $kantor)->result();
			$data['dataKpiLendingAOdetail'] = $this->kpi->datakpi_lending_AO_detail($tahun, $bulan, $tanggal, $kode_group2, $kantor)->result();

			$data['dataKpiBZ_AO'] = $this->kpi->datakpi_BZ_Per_AO($tahun, $bulan, $tanggal, $kode_group2, $kantor)->result();
			$data['dataKpiBZ_AOdetail'] = $this->kpi->datakpi_BZ_AO_detail($tahun, $bulan, $tanggal, $kode_group2, $kantor)->result();

			$data['dataKpiNS_AOdetail'] = $this->kpi->datakpi_NS_AOdetail($tahun, $bulan, $tanggal, $kode_group2, $kantor)->result();

			$data['dataKpiMitra_AOdetail'] = $this->kpi->datakpi_Mitra_AOdetail($tahun, $bulan, $tanggal, $kode_group2, $kantor)->result();

			$this->load->view('include/headerkpi');
			$this->load->view('dashboard_kpi_ao', $data);
			$this->load->view('include/footerkpi');
		}
	}


	public function dashboard_kpi_col(){

		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{

			$bulan       = $this->input->post('bulan');
			$tahun       = $this->input->post('tahun');
			$tanggal     = date('d');
			$kantor      = $this->session->userdata('kantor');
			$kode_group3 = '09';
			
			if(empty($tahun)){
				$tahun = date('Y');
			}

			if(empty($bulan)){
				$bulan = date('m');
			}


			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			$data['date']  = $tahun."-".$bulan."-".$tanggal;

			$data['dataKpiBZKol'] = $this->kpi->datakpi_BZ_Per_Kol($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();
			$data['dataKpiBZKoldetail'] = $this->kpi->datakpi_BZ_Kol_detail($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();

			$data['dataKpiCRKol'] = $this->kpi->datakpi_CR_Per_Kol($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();
			$data['dataKpiCRKoldetail'] = $this->kpi->datakpi_CR_Kol_detail($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();

			$data['dataKpiNplKol'] = $this->kpi->datakpi_npl_Per_Kol($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();
			$data['dataKpiNplKoldetail'] = $this->kpi->datakpi_npl_Kol_detail($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();
			
			$data['dataKpiSpReturnKoldetail'] = $this->kpi->datakpi_SPreturn_Kol_detail($tahun, $bulan, $tanggal, $kode_group3, $kantor)->result();

			$this->load->view('include/headerkpi');
			$this->load->view('dashboard_kpi_col', $data);
			$this->load->view('include/footerkpi');
		}
	}

}

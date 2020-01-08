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
			if($this->session->userdata('jabatan') == 'ketua' || $this->session->userdata('jabatan') == 'manager'){
				$bulan   = $this->input->post('bulan');
				$tahun   = $this->input->post('tahun');
				$kantor  = $this->input->post('kantor');
				// $tanggal = 28;
				
				if(empty($tahun)){
					$tahun = date('Y');
				}

				if(empty($bulan)){
					$bulan = date('m');
				}

				if($this->session->userdata('kantor') == '02'){
					$kantor = "02";
				}else{
					if(empty($kantor)){
						$kantor = "01";
					}
				}
				
				$data['bulan']   = $bulan;
				$data['tahun']   = $tahun;
				// $data['tanggal'] = $tanggal;
				// $data['date'] = $tahun."-".$bulan."-".$tanggal;
				$data['kantor']  = $kantor;
				
				//data npl
				$data['dataKpiNpl'] = $this->kpi->datakpi_npl($tahun, $bulan,$kantor)->result();
				$data['dataKpiNplKol'] = $this->kpi->datakpi_npl_Kol($tahun, $bulan,$kantor)->result();
				$data['dataKpiNplKoldetail'] = $this->kpi->datakpi_npl_Kol_detail($tahun, $bulan,'09', $kantor)->result();

				//data lending
				$data['dataKpiLending'] = $this->kpi->datakpi_lending($tahun, $bulan,$kantor)->result();
				$data['datakpilendingAO'] = $this->kpi->datakpi_lending_AO($tahun, $bulan,$kantor)->result();
				$data['datakpilendingAOdetail'] = $this->kpi->datakpi_lending_AO_detail($tahun, $bulan,'15', $kantor)->result();
				
				//data cr
				$data['dataKpiCR'] = $this->kpi->datakpi_CR($tahun, $bulan,$kantor)->result();
				$data['dataKpiCRKol'] = $this->kpi->datakpi_CR_Kol($tahun, $bulan,$kantor)->result();
				$data['dataKpiCRKoldetail'] = $this->kpi->datakpi_CR_Kol_detail($tahun, $bulan,'09', $kantor)->result();
				
				//data bz
				$data['dataKpiBZ'] = $this->kpi->datakpi_BZ($tahun, $bulan,$kantor)->result();
				$data['dataKpiBZKol'] = $this->kpi->datakpi_BZ_Kol($tahun, $bulan,$kantor)->result();
				$data['dataKpiBZKoldetail'] = $this->kpi->datakpi_BZ_Kol_detail($tahun, $bulan,'09', $kantor)->result();

				//data ns
				$data['dataKpiNS'] = $this->kpi->datakpi_NS($tahun, $bulan,$kantor)->result();
				$data['dataKpiNS_AO'] = $this->kpi->datakpi_NS_AO($tahun, $bulan,$kantor)->result();
				$data['dataKpiNS_AOdetail'] = $this->kpi->datakpi_NS_AOdetail($tahun, $bulan,'15', $kantor)->result();

				//data kolektibilitas
				$data['dataKolektibilitas'] = $this->kpi->dataKolektibilitas($tahun, $bulan,$kantor)->result();
				
				$this->load->view('include/headerkpi');
				$this->load->view('dashboard_kpi', $data);
				$this->load->view('include/footerkpi');
			}else{
				redirect(base_url('tools'));
			}
		}
	}


	public function dashboard_kpi_ao(){
		
		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{
			if($this->session->userdata('jabatan') == 'marketing'){
				$bulan       = $this->input->post('bulan');
				$tahun       = $this->input->post('tahun');
				// $tanggal     = 28;
				$kantor      = $this->session->userdata('kantor');
				$kode_group2 = $this->session->userdata('kode_group2');
				// $kode_group2 = 02;
				
				if(empty($tahun)){
					$tahun = date('Y');
				}

				if(empty($bulan)){
					$bulan = date('m');
				}

				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;
				// $data['date']  = $tahun."-".$bulan."-".$tanggal;

				$data['dataKpiLendingAO'] = $this->kpi->datakpi_lending_Per_AO($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['dataKpiLendingAOdetail'] = $this->kpi->datakpi_lending_AO_detail($tahun, $bulan, $kode_group2, $kantor)->result();

				$data['dataKpiBZ_AO'] = $this->kpi->datakpi_BZ_Per_AO($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['dataKpiBZ_AOdetail'] = $this->kpi->datakpi_BZ_AO_detail($tahun, $bulan, $kode_group2, $kantor)->result();
				
				$data['dataKpiNS_AO'] = $this->kpi->datakpi_NS_Per_AO($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['dataKpiNS_AOdetail'] = $this->kpi->datakpi_NS_AOdetail($tahun, $bulan, $kode_group2, $kantor)->result();

				// $data['dataKpiMitra_AOdetail'] = $this->kpi->datakpi_Mitra_AOdetail($tahun, $bulan, $kode_group2, $kantor)->result();

				$data['dataKpiMap'] = $this->kpi->datakpi_lending_AO_detail($tahun, $bulan, $kode_group2, $kantor)->num_rows();

				$this->load->view('include/headerkpi');
				$this->load->view('dashboard_kpi_ao', $data);
				$this->load->view('include/footerkpi');
			}else{
				redirect(base_url('tools'));
			}
		}
	}


	public function dashboard_kpi_col(){

		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{

			$bulan       = $this->input->post('bulan');
			$tahun       = $this->input->post('tahun');
			// $tanggal     = 28;
			$kantor      = $this->session->userdata('kantor');
			// $kode_group3 = $this->session->userdata('kode_group3');
			$kode_group3 = '09';
			
			if(empty($tahun)){
				$tahun = date('Y');
			}

			if(empty($bulan)){
				$bulan = date('m');
			}


			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;
			// $data['date']  = $tahun."-".$bulan."-".$tanggal;

			$data['dataKpiBZKol'] = $this->kpi->datakpi_BZ_Per_Kol($tahun, $bulan, $kode_group3, $kantor)->result();
			$data['dataKpiBZKoldetail'] = $this->kpi->datakpi_BZ_Kol_detail($tahun, $bulan, $kode_group3, $kantor)->result();

			$data['dataKpiCRKol'] = $this->kpi->datakpi_CR_Per_Kol($tahun, $bulan, $kode_group3, $kantor)->result();
			$data['dataKpiCRKoldetail'] = $this->kpi->datakpi_CR_Kol_detail($tahun, $bulan, $kode_group3, $kantor)->result();

			$data['dataKpiNplKol'] = $this->kpi->datakpi_npl_Per_Kol($tahun, $bulan, $kode_group3, $kantor)->result();
			$data['dataKpiNplKoldetail'] = $this->kpi->datakpi_npl_Kol_detail($tahun, $bulan, $kode_group3, $kantor)->result();
			
			// $data['dataKpiSpReturnKoldetail'] = $this->kpi->datakpi_SPreturn_Kol_detail($tahun, $bulan, $kode_group3, $kantor)->result();

			$this->load->view('include/headerkpi');
			$this->load->view('dashboard_kpi_col', $data);
			$this->load->view('include/footerkpi');
		}
	}

}

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
		//load library pdf
		$this->load->library('pdf');

		//load model yg dipakai
		$this->load->model('Model_business','business');
		$this->load->model('Model_kpi','kpi');

		// load helper yg berisi fungsi yang dibuat dan ingin dipakai
		$this->load->helper('data');
	}

	public function index()
	{
		if (empty($this->session->userdata('id'))) {
			redirect('/','refresh');
		}else{
			$this->load->view('halamantool');
		}
	}
	
	// method untuk dashboar kpi ketua dan manager
	public function dashboard_kpi(){

		//cek login
		if($this->session->userdata('id') == null){
			//lempar ke login jika belum login atau session sudah habis
			redirect(base_url('login'));
		}else{
			// kondisi untuk akses yang diijinkan (ketua dan manager yg dapat mengakses ini)
			if($this->session->userdata('jabatan') == 'ketua' || $this->session->userdata('jabatan') == 'manager'){
				$bulan   = $this->input->post('bulan');
				$tahun   = $this->input->post('tahun');
				$kantor  = $this->input->post('kantor');
				// $tanggal = 28;
				
				//jika $tahun kosong maka diisi dengan tahun saat ini
				if(empty($tahun)){
					$tahun = date('Y');
				}

				//jika $bulan kosong maka diisi dengan tahun saat ini
				if(empty($bulan)){
					$bulan = date('m');
				}

				// jika user berasal dari kantor 2 maka hanya bisa melihat kantor sendiri 
				if($this->session->userdata('kantor') == '02'){
					$kantor = "02";
				}else{
					if(empty($kantor)){
						$kantor = "01";
					}
				}
				
				$data['bulan']   = $bulan;
				$data['tahun']   = $tahun;
				$data['kantor']  = $kantor;
				
				//data npl
				$data['npl_cabang'] = $this->kpi->npl_cabang($tahun, $bulan, $kantor)->result();
				$data['npl_kolektor'] = $this->kpi->npl_kolektor($tahun, $bulan, $kantor)->result();
				$data['dataKpiNplKoldetail'] = $this->kpi->npl_kolektor_detail($tahun, $bulan,'09', $kantor)->result();

				//data lending
				$data['lending_cabang'] = $this->kpi->lending_cabang($tahun, $bulan, $kantor)->result();
				$data['lending_ao'] = $this->kpi->lending_ao($tahun, $bulan, $kantor)->result();
				$data['datakpilendingAOdetail'] = $this->kpi->lending_ao_detail($tahun, $bulan,'15', $kantor)->result();
				
				//data cr kolektor
				$data['cr_cabang'] = $this->kpi->cr_cabang_kolektor($tahun, $bulan, $kantor)->result();
				$data['cr_kolektor'] = $this->kpi->cr_kolektor($tahun, $bulan, $kantor)->result();
				$data['dataKpiCRKoldetail'] = $this->kpi->cr_kolektor_detail($tahun, $bulan,'09', $kantor)->result();
				
				// data cr ao
				$data['cr_cabang_ao'] = $this->kpi->cr_cabang_ao($tahun, $bulan, $kantor)->result();
				$data['cr_ao'] = $this->kpi->cr_ao($tahun, $bulan, $kantor)->result();
				$data['cr_ao_detail'] = $this->kpi->cr_ao_detail($tahun, $bulan,'02', $kantor)->result();

				//data bz
				$data['bz_cabang'] = $this->kpi->bz_cabang($tahun, $bulan,$kantor)->result();
				$data['bz_kolektor'] = $this->kpi->bz_kolektor($tahun, $bulan,$kantor)->result();
				$data['dataKpiBZKoldetail'] = $this->kpi->bz_kolektor_detail($tahun, $bulan,'09', $kantor)->result();

				//data ns
				$data['ns_cabang'] = $this->kpi->ns_cabang($tahun, $bulan,$kantor)->result();
				$data['ns_ao'] = $this->kpi->ns_ao($tahun, $bulan,$kantor)->result();
				$data['dataKpiNS_AOdetail'] = $this->kpi->ns_ao_detail($tahun, $bulan,'15', $kantor)->result();

				//data kolektibilitas
				$data['dataKolektibilitas'] = $this->kpi->kolektibilitas($tahun, $bulan,$kantor)->result();
				
				$this->load->view('include/headerkpi');
				$this->load->view('dashboard_kpi', $data);

			// jika user bukan memiliki jabatan ketua atau manager maka user akan dilempar ke controller tools
			}else{
				redirect(base_url('tools'));
			}
		}
	}

	// method untuk dashboar ao (marketing)
	public function dashboard_kpi_ao(){
		
		// cek login
		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{
			// cek jabatan, hanya jabatan ao yg bisa mengakses ini 
			if($this->session->userdata('jabatan') == 'marketing'){
				$bulan       = $this->input->post('bulan');
				$tahun       = $this->input->post('tahun');
				$kantor      = $this->session->userdata('kantor');
				$kode_group2 = $this->session->userdata('kode_group2');
				// $kode_group2 = 02;
				
				// jika $tahun kosong maka diisi dengan tahun saat ini
				if(empty($tahun)){
					$tahun = date('Y');
				}

				// jika $bulan kosong maka diisi dengan tahun saat ini
				if(empty($bulan)){
					$bulan = date('m');
				}

				//lempar tahun dan bulan ke view
				$data['bulan'] = $bulan;
				$data['tahun'] = $tahun;

				// data lending per ao
				$data['lending_ao'] = $this->kpi->lending_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['lending_detail'] = $this->kpi->lending_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();

				// data cr per ao
				$data['cr_per_ao'] = $this->kpi->cr_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['cr_ao_detail'] = $this->kpi->cr_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();

				// data bz per ao
				$data['bz_ao'] = $this->kpi->bz_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['bz_detail'] = $this->kpi->bz_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();
				
				// data fid-ns per ao
				$data['ns_ao'] = $this->kpi->ns_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
				$data['ns_detail'] = $this->kpi->ns_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();

				// jumlah data lending
				$data['jml_map'] = $this->kpi->lending_ao_detail($tahun, $bulan, $kode_group2, $kantor)->num_rows();

				$this->load->view('include/headerkpi');
				$this->load->view('dashboard_kpi_ao', $data);

			// jika user bukan memiliki jabatan ketua atau manager maka user akan dilempar ke controller tools
			}else{
				redirect(base_url('tools'));
			}
		}
	}


	public function dashboard_kpi_col(){

		// cek login
		if($this->session->userdata('id') == null){
			redirect(base_url('login'));
		}else{

			$bulan       = $this->input->post('bulan');
			$tahun       = $this->input->post('tahun');
			$kantor      = $this->session->userdata('kantor');
			// $kode_group3 = $this->session->userdata('kode_group3');
			$kode_group3 = '09';
			
			// jika $tahun tidak ada maka tahun akan diisi tahun sekarang
			if(empty($tahun)){
				$tahun = date('Y');
			}

			// jika $bulan tidak ada maka tahun akan diisi bulan sekarang
			if(empty($bulan)){
				$bulan = date('m');
			}

			$data['bulan'] = $bulan;
			$data['tahun'] = $tahun;

			// data bz per kolektor
			$data['bz_kolektor'] = $this->kpi->bz_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->result();
			$data['bz_detail'] = $this->kpi->bz_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)->result();

			// data cr per kolektor
			$data['cr_kolektor'] = $this->kpi->cr_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->result();
			$data['cr_detail'] = $this->kpi->cr_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)->result();

			// data npl per kolektor
			$data['npl_kolektor'] = $this->kpi->npl_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->result();
			$data['npl_detail'] = $this->kpi->npl_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)->result();

			$this->load->view('include/headerkpi');
			$this->load->view('dashboard_kpi_col', $data);
		}
	}

}

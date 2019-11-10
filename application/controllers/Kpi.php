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
    $data['dataKpiNpl'] = $this->kpi->datakpinpl()->result();
    $data['dataKpiLending'] = $this->kpi->datakpilending()->result();
    $data['dataKpiCR'] = $this->kpi->datakpiCR()->result();
    $data['dataKpiBZ'] = $this->kpi->datakpiBZ()->result();
    $data['datakpilendingAO'] = $this->kpi->datakpilendingAO()->result();
    $data['datakpilendingAOdetail'] = $this->kpi->datakpilendingAOdetail('03')->result();
		//print_r($data['dataKpiNpl']);die();
		//print_r($data['dataKpiLending']);die();
		//print_r($data['dataKpiCR']);die();
		//print_r($data['dataKpiBZ']);die();
		// echo "<pre>";
		// print_r($data['datakpilendingAO']);die();
		// echo "<pre>";
		// echo "<pre>";
		// print_r($data['datakpilendingAOdetail']);die();
		// echo "<pre>";
		$this->load->view('dashboard_kpi',$data);
	}

	public function dashboard_kpi_ao(){
		$this->load->view('dashboard_kpi_ao');
	}
	public function dashboard_kpi_col(){
		$this->load->view('dashboard_kpi_col');
	}
}

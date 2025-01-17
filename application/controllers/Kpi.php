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
			if($this->session->userdata('jabatan') == 'ketua' || $this->session->userdata('jabatan') == 'manager' || $this->session->userdata('jabatan') == 'admin'){
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
				$data['npl_cabang'] = $this->kpi->npl_cabang($tahun, $bulan, $kantor)->num_rows();
				$data['npl_kolektor'] = $this->kpi->npl_kolektor($tahun, $bulan, $kantor)->result();
				// $data['dataKpiNplKoldetail'] = $this->kpi->npl_kolektor_detail($tahun, $bulan,'09', $kantor)->result();

				//data lending
				$data['lending_cabang'] = $this->kpi->lending_cabang($tahun, $bulan, $kantor)->num_rows();
				$data['lending_ao'] = $this->kpi->lending_ao($tahun, $bulan, $kantor)->result();
				// $data['datakpilendingAOdetail'] = $this->kpi->lending_ao_detail($tahun, $bulan,'15', $kantor)->result();
				
				//data cr kolektor
				$data['cr_cabang_kolektor'] = $this->kpi->cr_cabang_kolektor($tahun, $bulan, $kantor)->num_rows();
				$data['cr_kolektor'] = $this->kpi->cr_kolektor($tahun, $bulan, $kantor)->result();
				// $data['dataKpiCRKoldetail'] = $this->kpi->cr_kolektor_detail($tahun, $bulan,'09', $kantor)->result();
				
				// data cr ao
				$data['cr_cabang_ao'] = $this->kpi->cr_cabang_ao($tahun, $bulan, $kantor)->num_rows();
				$data['cr_ao'] = $this->kpi->cr_ao($tahun, $bulan, $kantor)->result();
				// $data['cr_ao_detail'] = $this->kpi->cr_ao_detail($tahun, $bulan,'02', $kantor)->result();

				//data bz
				$data['bz_cabang_kolektor'] = $this->kpi->bz_cabang_kolektor($tahun, $bulan,$kantor)->num_rows();
				$data['bz_kolektor'] = $this->kpi->bz_kolektor($tahun, $bulan,$kantor)->result();
				// $data['dataKpiBZKoldetail'] = $this->kpi->bz_kolektor_detail($tahun, $bulan,'09', $kantor)->result();

				//data ns
				$data['ns_cabang'] = $this->kpi->ns_cabang($tahun, $bulan,$kantor)->num_rows();
				$data['ns_ao'] = $this->kpi->ns_ao($tahun, $bulan,$kantor)->result();
				// $data['dataKpiNS_AOdetail'] = $this->kpi->ns_ao_detail($tahun, $bulan,'15', $kantor)->result();

				//data kolektibilitas
				$data['dataKolektibilitas'] = $this->kpi->kolektibilitas($tahun, $bulan,$kantor)->result();

				// data screening
				$data['screening'] = $this->kpi->screening($kantor)->result();
				
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
				$data['lending_ao'] = $this->kpi->lending_per_ao($tahun, $bulan, $kode_group2, $kantor)->num_rows();
				// $data['lending_detail'] = $this->kpi->lending_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();

				// data cr per ao
				$data['cr_per_ao'] = $this->kpi->cr_per_ao($tahun, $bulan, $kode_group2, $kantor)->num_rows();
				// $data['cr_ao_detail'] = $this->kpi->cr_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();

				// data bz per ao
				$data['bz_ao'] = $this->kpi->bz_per_ao($tahun, $bulan, $kode_group2, $kantor)->num_rows();
				$data['bz_detail'] = $this->kpi->bz_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();
				
				// data fid-ns per ao
				$data['ns_ao'] = $this->kpi->ns_per_ao($tahun, $bulan, $kode_group2, $kantor)->num_rows();
				// $data['ns_detail'] = $this->kpi->ns_ao_detail($tahun, $bulan, $kode_group2, $kantor)->result();

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
			if($this->session->userdata('jabatan') == 'collector'){
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
				$data['bz_kolektor'] = $this->kpi->bz_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->num_rows();
				// $data['bz_detail'] = $this->kpi->bz_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)->result();

				// data cr per kolektor
				$data['cr_kolektor'] = $this->kpi->cr_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->num_rows();
				// $data['cr_detail'] = $this->kpi->cr_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)->result();

				// data npl per kolektor
				$data['npl_kolektor'] = $this->kpi->npl_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->num_rows();
				// $data['npl_detail'] = $this->kpi->npl_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)->result();

				$this->load->view('include/headerkpi');
				$this->load->view('dashboard_kpi_col', $data);
			}else{
				redirect(base_url('tools'));
			}
		}
	}

	// data json untuk spedo kpi (cabang)

	public function spedo_lending_cabang($tahun, $bulan, $kantor) {

		$data = $this->kpi->lending_cabang($tahun, $bulan, $kantor)->result();

		echo json_encode($data);
	}

	public function spedo_npl_cabang($tahun, $bulan, $kantor) {

		$data = $this->kpi->npl_cabang($tahun, $bulan, $kantor)->result();

		echo json_encode($data);
	}

	public function spedo_cr_cabang_kolektor($tahun, $bulan, $kantor) {

		$data = $this->kpi->cr_cabang_kolektor($tahun, $bulan, $kantor)->result();

		echo json_encode($data);
	}

	public function spedo_cr_cabang_ao($tahun, $bulan, $kantor) {

		$data = $this->kpi->cr_cabang_ao($tahun, $bulan, $kantor)->result();

		echo json_encode($data);
	}

	public function spedo_bz_cabang_kolektor($tahun, $bulan, $kantor) {

		$data = $this->kpi->bz_cabang_kolektor($tahun, $bulan,$kantor)->result();

		echo json_encode($data);
	}

	public function spedo_ns_cabang($tahun, $bulan, $kantor) {

		$data = $this->kpi->ns_cabang($tahun, $bulan,$kantor)->result();

		echo json_encode($data);
	}
	// data json untuk spedo kpi (cabang)


	// data json untuk spedo kpi_col

	public function spedo_npl_kolektor($tahun, $bulan, $kode_group3, $kantor, $status) {

		if ($status == 'kpi') {
			$data = $this->kpi->npl_kolektor($tahun, $bulan, $kantor)->result();
		} else if ($status == 'kpi_col') {
			$data = $this->kpi->npl_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->result();
		}

		echo json_encode($data);
	}

	public function spedo_cr_kolektor($tahun, $bulan, $kode_group3, $kantor, $status) {

		if ($status == 'kpi') {
			$data = $this->kpi->cr_kolektor($tahun, $bulan, $kantor)->result();
		} else if ($status == 'kpi_col') {
			$data = $this->kpi->cr_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->result();
		}

		echo json_encode($data);
	}

	public function spedo_bz_kolektor($tahun, $bulan, $kode_group3, $kantor, $status) {
		
		if ($status == 'kpi') {
			$data = $this->kpi->bz_kolektor($tahun, $bulan,$kantor)->result();
		} else if ($status == 'kpi_col') {
			$data = $this->kpi->bz_per_kolektor($tahun, $bulan, $kode_group3, $kantor)->result();
		}

		echo json_encode($data);
	}
	// data json untuk spedo kpi_col


	// data json untuk spedo kpi_ao

	public function spedo_lending_ao($tahun, $bulan, $kode_group2, $kantor, $status) {

		if ($status == 'kpi') {
			$data = $this->kpi->lending_ao($tahun, $bulan, $kantor)->result();
		} else if ($status == 'kpi_ao') {
			$data = $this->kpi->lending_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
		}

		echo json_encode($data);
	}

	public function spedo_cr_ao($tahun, $bulan, $kode_group2, $kantor, $status) {

		if ($status == 'kpi') {
			$data = $this->kpi->cr_ao($tahun, $bulan, $kantor)->result();
		} else if ($status == 'kpi_ao') {
			$data = $this->kpi->cr_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
		}

		echo json_encode($data);
	}

	public function spedo_bz_ao($tahun, $bulan, $kode_group2, $kantor, $status) {

		if ($status == 'kpi') {
			$data = $this->kpi->bz_ao($tahun, $bulan, $kantor)->result();
		} else if ($status == 'kpi_ao') {
			$data = $this->kpi->bz_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
		}

		echo json_encode($data);
	}

	public function spedo_ns_ao($tahun, $bulan, $kode_group2, $kantor, $status) {

		if ($status == 'kpi') {
			$data = $this->kpi->ns_ao($tahun, $bulan, $kantor)->result();
		} else if ($status == 'kpi_ao') {
			$data = $this->kpi->ns_per_ao($tahun, $bulan, $kode_group2, $kantor)->result();
		}

		echo json_encode($data);
	}
	// data json untuk spedo kpi_ao


	// DATA DETAIL

	// Membuat data json untuk detail_lending
	function lending_detail($tahun, $bulan, $kode_group2, $kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        $this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
        $where = array('kode_kantor' => $kantor);
		$this->db->where($where);
		
        $table = 'kms_kpi.v_kpi_ao_lending';
        $column_order = array('no_rekening', 'nama_nasabah', 'deskripsi_group5', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'jml_lending', 'baki_debet', 'jml_pinjaman', 'alamat'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'deskripsi_group5', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'jml_lending', 'baki_debet', 'jml_pinjaman', 'alamat'); //field yang diizin untuk pencarian 
        $order = array('no_rekening' => 'desc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = ($field->deskripsi_group5 != null ? ucfirst($field->deskripsi_group5) : " - ");
            $row[] = ubahDate($field->tgl_realisasi);
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->jml_lending);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
			$row[] = $field->alamat;
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk detail_lending

	// Membuat data json untuk cr_detail_ao
	function cr_ao_detail($tahun, $bulan, $kode_group2, $kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        $this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
        $where = array('kode_kantor' => $kantor);
		$this->db->where($where);
		
        $table = 'kms_kpi.v_kpi_ao_cr';
        $column_order = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang diizin untuk pencarian 
        $order = array('no_rekening' => 'desc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = $field->alamat;
            $row[] = ubahDate($field->tgl_realisasi);
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
            $row[] = rupiah($field->jml_lending);
            $row[] = rupiah($field->jml_tagihan_turun);
			$row[] = rupiah($field->jml_tunggakan);
            $row[] = rupiah($field->total_tagihan);
            $row[] = rupiah($field->sisa_tunggakan);
            $row[] = rupiah($field->jml_denda);
			$row[] = rupiah($field->jml_tagihan_bayar);
			$row[] = $field->ft_pokok . " Bulan";
			$row[] = $field->ft_bunga . " Bulan";
			$row[] = $field->ft_hari_awal . " Hari";
			$row[] = $field->ft_hari . " Hari";
			$row[] = $field->kolektibilitas . " - " . getKolektibilitas($field->kolektibilitas);
			$row[] = ($field->last_payment !== null ? ubahDate($field->last_payment) : " - ");
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk cr_detail_ao

	// Membuat data json untuk bz_detail_ao
	// function bz_ao_detail($tahun, $bulan, $kode_group2, $kantor)
    // {
    //     $length = intval($this->input->post("length"));
    //     $draw = intval($this->input->post("draw"));
	// 	$start = intval($this->input->post("start"));
	// 	$search= $this->input->post("search");
    //     $search = $search['value'];
		
    //     $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
    //     $this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
    //     $where = array('kode_kantor' => $kantor, 'kode_group2' => $kode_group2);
	// 	$this->db->where($where);
		
    //     $table = 'kms_kpi.v_kpi_ao_bucket_zero';
    //     $column_order = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'ft_pokok', 'ft_bunga', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang ada di table user
    //     $column_search = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'ft_pokok', 'ft_bunga', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang diizin untuk pencarian 
    //     $order = array('no_rekening' => 'desc'); // default order by
        
    //     $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start);
    //     $data = array();
    //     $no = $start;
    //     foreach ($list as $field) {
    //         $no++;
    //         $row = array();
    //         $row[] = $field->no_rekening;
    //         $row[] = $field->nama_nasabah;
    //         $row[] = $field->alamat;
    //         $row[] = ubahDate($field->tgl_realisasi);
    //         $row[] = $field->jkw . " Bulan";
    //         $row[] = ubahDate($field->tgl_jatuh_tempo);
    //         $row[] = rupiah($field->baki_debet);
    //         $row[] = rupiah($field->jml_pinjaman);
    //         $row[] = rupiah($field->jml_lending);
    //         $row[] = rupiah($field->jml_tagihan_turun);
	// 		$row[] = rupiah($field->jml_tunggakan);
    //         $row[] = rupiah($field->jml_denda);
	// 		$row[] = rupiah($field->jml_tagihan_bayar);
	// 		$row[] = $field->ft_pokok . " Bulan";
	// 		$row[] = $field->ft_bunga . " Bulan";
	// 		$row[] = $field->ft_hari . " Hari";
	// 		$row[] = $field->kolektibilitas . " - " . getKolektibilitas($field->kolektibilitas);
	// 		$row[] = ($field->last_payment !== null ? ubahDate($field->last_payment) : " - ");
			
    //         $data[] = $row;
    //     }
 
    //     $output = array(
    //         "draw" => $draw,
    //         "recordsTotal" => $this->kpi->count_all($table),
    //         "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search),
    //         "data" => $data,
	// 	);
		
    //     //output dalam format JSON
    //     echo json_encode($output);
	// }
	// Membuat data json untuk bz_detail_ao

	// Membuat data json untuk detail_nonstarter
	function ns_detail($tahun, $bulan, $kode_group2, $kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        $this->db->query("SELECT '$kode_group2' INTO @pv_kode_ao");
        $where = array('kode_kantor' => $kantor);
		$this->db->where($where);
		
        $table = 'kms_kpi.v_kpi_ao_fid';
        $column_order = array('no_rekening', 'nama_nasabah', 'deskripsi_group5', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'ft_hari', 'total_tagihan', 'jml_tagihan_bayar', 'alamat'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'deskripsi_group5', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'ft_hari', 'total_tagihan', 'jml_tagihan_bayar', 'alamat'); //field yang diizin untuk pencarian 
        $order = array('no_rekening' => 'desc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = ($field->deskripsi_group5 != null ? ucfirst($field->deskripsi_group5) : " - ");
            $row[] = ubahDate($field->tgl_realisasi);
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
            $row[] = rupiah($field->jml_lending);
			$row[] = $field->ft_hari . " Hari";
			$row[] = rupiah($field->total_tagihan);
			$row[] = rupiah($field->jml_tagihan_bayar);
			$row[] = $field->alamat;
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk detail_nonstarter

	// Membuat data json untuk cr_koelktor detail
	function cr_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        $this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
        $where = array('kode_kantor' => $kantor);
		$this->db->where($where);
		
        $table = 'kms_kpi.v_kpi_kolektor_cr';
        $column_order = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'jml_sp_assign', 'jml_sp_return', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'jml_sp_assign', 'jml_sp_return', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang diizin untuk pencarian 
        $order = array('no_rekening' => 'desc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = $field->alamat;
            $row[] = ubahDate($field->tgl_realisasi);
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
            $row[] = rupiah($field->jml_lending);
            $row[] = rupiah($field->jml_tagihan_turun);
			$row[] = rupiah($field->jml_tunggakan);
            $row[] = rupiah($field->total_tagihan);
            $row[] = rupiah($field->sisa_tunggakan);
            $row[] = rupiah($field->jml_denda);
			$row[] = rupiah($field->jml_tagihan_bayar);
			$row[] = $field->jml_sp_assign . " Surat";
			$row[] = $field->jml_sp_return . " Surat";
			$row[] = $field->ft_pokok . " Bulan";
			$row[] = $field->ft_bunga . " Bulan";
			$row[] = $field->ft_hari_awal . " Hari";
			$row[] = $field->ft_hari . " Hari";
			$row[] = $field->kolektibilitas . " - " . getKolektibilitas($field->kolektibilitas);
			$row[] = ($field->last_payment !== null ? ubahDate($field->last_payment) : " - ");
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk cr_koelktor detail

	// Membuat data json untuk bz_kolektor detail
	function bz_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        $this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
        $where = array('kode_kantor' => $kantor);
		$this->db->where($where);
		
        $table = 'kms_kpi.v_kpi_kolektor_bucket_zero';
        $column_order = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'jml_sp_assign', 'jml_sp_return', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'jml_sp_assign', 'jml_sp_return', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang diizin untuk pencarian 
        $order = array('no_rekening' => 'desc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = $field->alamat;
            $row[] = ubahDate($field->tgl_realisasi);
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
            $row[] = rupiah($field->jml_lending);
            $row[] = rupiah($field->jml_tagihan_turun);
			$row[] = rupiah($field->jml_tunggakan);
            $row[] = rupiah($field->total_tagihan);
            $row[] = rupiah($field->sisa_tunggakan);
            $row[] = rupiah($field->jml_denda);
			$row[] = rupiah($field->jml_tagihan_bayar);
			$row[] = $field->jml_sp_assign . " Surat";
			$row[] = $field->jml_sp_return . " Surat";
			$row[] = $field->ft_pokok . " Bulan";
			$row[] = $field->ft_bunga . " Bulan";
			$row[] = $field->ft_hari_awal . " Hari";
			$row[] = $field->ft_hari . " Hari";
			$row[] = $field->kolektibilitas . " - " . getKolektibilitas($field->kolektibilitas);
			$row[] = ($field->last_payment !== null ? ubahDate($field->last_payment) : " - ");
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk bz_kolektor detail

	// Membuat data json untuk npl_kolektor detail
	function npl_kolektor_detail($tahun, $bulan, $kode_group3, $kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        $this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
        $where = array('kode_kantor' => $kantor);
		$this->db->where($where);
		
        $table = 'kms_kpi.v_kpi_kolektor_npl';
        $column_order = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'jml_sp_assign', 'jml_sp_return', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'alamat', 'tgl_realisasi', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_lending', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'jml_sp_assign', 'jml_sp_return', 'ft_pokok', 'ft_bunga', 'ft_hari_awal', 'ft_hari', 'kolektibilitas', 'last_payment'); //field yang diizin untuk pencarian 
        $order = array('no_rekening' => 'desc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = $field->alamat;
            $row[] = ubahDate($field->tgl_realisasi);
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
            $row[] = rupiah($field->jml_lending);
            $row[] = rupiah($field->jml_tagihan_turun);
			$row[] = rupiah($field->jml_tunggakan);
            $row[] = rupiah($field->total_tagihan);
            $row[] = rupiah($field->sisa_tunggakan);
            $row[] = rupiah($field->jml_denda);
			$row[] = rupiah($field->jml_tagihan_bayar);
			$row[] = $field->jml_sp_assign . " Surat";
			$row[] = $field->jml_sp_return . " Surat";
			$row[] = $field->ft_pokok . " Bulan";
			$row[] = $field->ft_bunga . " Bulan";
			$row[] = $field->ft_hari_awal . " Hari";
			$row[] = $field->ft_hari . " Hari";
			$row[] = $field->kolektibilitas . " - " . getKolektibilitas($field->kolektibilitas);
			$row[] = ($field->last_payment !== null ? ubahDate($field->last_payment) : " - ");
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk npl_kolektor detail

	// Membuat data json untuk screening detail
	function screening($kantor)
    {
        $length = intval($this->input->post("length"));
        $draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$search= $this->input->post("search");
        $search = $search['value'];
		
        // $this->db->query("SELECT LAST_DAY('$tahun-$bulan-20') INTO @pv_per_tgl");
        // $this->db->query("SELECT '$kode_group3' INTO @pv_kode_kolektor");
		$this->db->where('kode_kantor', $kantor);
		
        $table = 'kms_kpi.v_kpi_kredit_all';
        $column_order = array('no_rekening', 'nama_nasabah', 'tgl_realisasi', 'deskripsi_group2', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'ft_pokok', 'ft_bunga', 'kolektibilitas', 'last_payment', 'tgl_tagihan'); //field yang ada di table user
        $column_search = array('no_rekening', 'nama_nasabah', 'tgl_realisasi', 'deskripsi_group2', 'jkw', 'tgl_jatuh_tempo', 'baki_debet', 'jml_pinjaman', 'jml_tagihan_turun', 'jml_tunggakan', 'total_tagihan', 'sisa_tunggakan', 'jml_denda', 'jml_tagihan_bayar', 'ft_pokok', 'ft_bunga', 'kolektibilitas', 'last_payment', 'tgl_tagihan'); //field yang diizin untuk pencarian 
        $order = array('tgl_tagihan' => 'asc'); // default order by
        
        $list = $this->kpi->get_datatables($table, $column_order, $column_search, $order, $search, $length, $start, $kantor);
        $data = array();
        $no = $start;
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $field->tgl_tagihan;
            $row[] = $field->no_rekening;
            $row[] = $field->nama_nasabah;
            $row[] = $field->deskripsi_group2;
            $row[] = $field->jkw . " Bulan";
            $row[] = ubahDate($field->tgl_jatuh_tempo);
            $row[] = rupiah($field->baki_debet);
            $row[] = rupiah($field->jml_pinjaman);
            $row[] = rupiah($field->jml_tagihan_turun);
			$row[] = rupiah($field->jml_tunggakan);
            $row[] = rupiah($field->total_tagihan);
            $row[] = rupiah($field->sisa_tunggakan);
            $row[] = rupiah($field->jml_denda);
			$row[] = rupiah($field->jml_tagihan_bayar);
			$row[] = $field->ft_pokok . " Bulan";
			$row[] = $field->ft_bunga . " Bulan";
			$row[] = $field->kolektibilitas . " - " . getKolektibilitas($field->kolektibilitas);
			$row[] = ($field->last_payment !== null ? ubahDate($field->last_payment) : " - ");
			
            $data[] = $row;
        }
 
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $this->kpi->count_all($table, $kantor),
            "recordsFiltered" => $this->kpi->count_filtered($table, $column_order, $column_search, $order, $search, $kantor),
            "data" => $data,
		);
		
        //output dalam format JSON
        echo json_encode($output);
	}
	// Membuat data json untuk screening detail
	
	// DATA DETAIL

}

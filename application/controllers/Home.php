<?php
defined('BASEPATH') OR exit('No direct script access allowed');
date_default_timezone_set('Asia/Jakarta');
if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
	header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: Content-Type');
	exit;
}

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('Model_business','business');
	}

	public function index()
	{
		if (empty($this->session->userdata('id'))) {
			redirect('/','refresh');
		}else{
			$this->load->view('index');
		}
	}

	/*DASHBOOARD*/
	public function getTotalNasabah($value='')
	{
		$data = $this->business->get('los_calon_nasabah',null)->num_rows();
		echo json_encode(array('total_nasabah' => $data));
	}

	public function getTotalOrder($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_order' => $data));
	}

	public function getTotalAllOrder($value='')
	{
		$data = $this->business->get('los_order',null)->num_rows();
		echo json_encode(array('total_order' => $data));
	}

	public function getTotalTrackingOrder($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_or.verifikasi' => 1);
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_or.verifikasi' => 1);
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_tracking' => $data));
	}

	public function getTotalAllTrackingOrder($value='')
	{
		$data = $this->business->get('los_order_tracking',null)->num_rows();
		echo json_encode(array('total_tracking' => $data));
	}

	public function getTotalOrderSukses($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_or.verifikasi' => 1);
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_or.verifikasi' => 1);
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_order' => $data));
	}

	/*public function getTotalOrderPending($value='')
	{
		$where = array('verifikasi' => 0);
		$data = $this->business->get_where('los_order',null,null,$where)->num_rows();
		echo json_encode(array('total_order' => $data));
	}*/

	public function getTotalPengajuan($session_kantor)
	{
		$data = $this->business->get_total_pengajuan($session_kantor)->result();
		echo json_encode($data);
	}

	/*public function getTotalPengajuanVerifikasi($value='')
	{
		$data = $this->business->get_total_pengajuan_verifikasi()->result();
		echo json_encode($data);
	}*/

	/*public function getTotalPengajuanBVerifikasi($value='')
	{
		$data = $this->business->get_total_pengajuan_belum_verifikasi()->result();
		echo json_encode($data);
	}*/

	public function getTotalKredit($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_kredit_checking AS los_kc','los_or.id = los_kc.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_kredit' => $data));
	}

	public function getTotalAllKredit($value='')
	{
		$data = $this->business->get('los_kredit_checking',null)->num_rows();
		echo json_encode(array('total_kredit' => $data));
	}

	public function getTotalKreditOnProg($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'status' => 'ON PROGRESS');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'status' => 'ON PROGRESS');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_kredit_checking AS los_kc','los_or.id = los_kc.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_kredit' => $data));
	}

	public function getTotalKreditDone($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'status' => 'DONE');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'status' => 'DONE');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_kredit_checking AS los_kc','los_or.id = los_kc.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_kredit' => $data));
	}

	public function getTotalMemoAo($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'status' => 'DONE','flg_survey' => '2');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'status' => 'DONE','flg_survey' => '2');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_kredit_checking AS los_kc','los_or.id = los_kc.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_ao' => $data));
	}

	public function getTotalAllAo($value='')
	{
		$data = $this->business->get('los_memo_kredit_ao',null)->num_rows();
		echo json_encode(array('total_all_ao' => $data));
	}

	public function getTotalMemoAoOut($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_ao.verifikasi' => '1');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_ao.verifikasi' => '1');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_memo_kredit_ao AS los_ao','los_or.id = los_ao.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_ao' => $data));
	}

	public function getTotalMemoCa($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_ao.verifikasi' => '1');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_ao.verifikasi' => '1');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_memo_kredit_ao AS los_ao','los_or.id = los_ao.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_ca' => $data));
	}

	public function getTotalAllCa($value='')
	{
		$data = $this->business->get('los_memo_kredit_ca',null)->num_rows();
		echo json_encode(array('total_all_ca' => $data));
	}

	public function getTotalMemoCaOut($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_memo_kredit_ca AS los_ca','los_or.id = los_ca.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_ca' => $data));
	}

	public function getInApproval($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor);
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_memo_kredit_ca AS los_ca','los_or.id = los_ca.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_ca' => $data));
	}

	public function getPushnotif($value='')
	{
		$where = array('status_app' => '0','flg_notif' => '0');
		$data = $this->business->get_where('los_caa',null,null,$where)->num_rows();
		echo json_encode(array('total_push' => $data));
	}

	public function UpdatePushNotif($value='')
	{
		$where = array('status_app' => '0','flg_notif' => '0');
		$data = array('flg_notif' => '1');
		$query = $this->business->update_data('los_caa',$data,$where);
		if ($query) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function getPushnotifKetua($value='')
	{
		$where = array('jabatan' => 'manager','flg_notif' => '0');
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->num_rows();
		echo json_encode(array('total_push' => $data));
	}

	public function UpdatePushNotifKetua($value='')
	{
		$where = array('jabatan' => 'manager','flg_notif' => '0');
		$data = array('flg_notif' => '1');
		$query = $this->business->update_data('los_caa_approval',$data,$where);
		if ($query) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function testpush($value='')
	{
		$where = array('status_app' => '0','flg_notif' => '1');
		$data = array('flg_notif' => '0');
		$query = $this->business->update_data('los_caa',$data,$where);
		if ($query) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function testpushketua($value='')
	{
		$where = array('jabatan' => 'manager','flg_notif' => '1');
		$data = array('flg_notif' => '0');
		$query = $this->business->update_data('los_caa_approval',$data,$where);
		if ($query) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function getTotalWaiting($value='')
	{
		$where = array('los_caa.status_app' => '0','los_cn.kode_kantor' => $this->session->userdata('kantor'));
		$data = $this->db->select('*')
					 ->from('los_calon_nasabah AS los_cn')
					 ->join('los_order AS los_or', 'los_cn.id_calon_debitur = los_or.id_calon_debitur')
					 ->join('los_caa', 'los_or.id = los_caa.id_order')
		  			 ->where($where)
		  			 ->get()
		  			 ->num_rows();
		echo json_encode(array('total_memo_app' => $data));
	}

	public function dataWaitingApprove($value='')
	{
		$where = array('los_caa.status_app' => '0','los_cn.kode_kantor' => $this->session->userdata('kantor'));
		$data = $this->db->select('los_caa.*,user.nama AS pengirim,los_or.id_calon_debitur')
				->from('los_calon_nasabah AS los_cn')
				->join('los_order AS los_or', 'los_cn.id_calon_debitur = los_or.id_calon_debitur')
				->join('los_caa', 'los_or.id = los_caa.id_order')
				->join('user','los_caa.user_id = user.user_id')
				->where($where)
				->limit(6)
				->order_by('tgl_buat','DESC')
				->get()
				->result();
		echo json_encode($data);
	}

	public function getTotalWaitingAppKetua($value='')
	{
		$where = array(
			'los_caa.status_app' => '0',
			'los_caa_approval.status_app' => '1',
			'los_caa_approval.jabatan' => 'manager'
		);
		$data = $this->db->select('los_caa.status_app')
				->from('los_caa')
				->join('los_caa_approval','los_caa.id_order = los_caa_approval.id_order')
				->where($where)
				->get()
				->num_rows();
		echo json_encode(array('total_memo_app' => $data));
	}

	public function dataWaitingAppKetua($value='')
	{
		$where = array(
			'los_caa.status_app' => '0',
			'los_caa_approval.status_app' => '1',
			'los_caa_approval.jabatan' => 'manager'
		);
		$data = $this->db->select('los_caa_approval.*,user.nama AS pengirim,los_order.id_calon_debitur')
				->from('los_caa_approval')
				->join('los_order','los_caa_approval.id_order = los_order.id')
				->join('los_caa','los_caa_approval.id_order = los_caa.id_order')
				->join('user','los_caa_approval.user_id = user.user_id')
				->where($where)
				->limit(6)
				->order_by('tgl_app','DESC')
				->get()
				->result();
		echo json_encode($data);
	}

	public function getTotalAppove($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_caa.status_app' => '1');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_caa.status_app' => '1');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_caa','los_or.id = los_caa.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_app' => $data));
	}

	public function getTotalReject($session_kantor)
	{
		if ($session_kantor == 01) {
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_caa.status_app' => '2');
		}else if ($session_kantor == 02){
			$where = array('los_cn.kode_kantor' => $session_kantor,'los_caa.status_app' => '2');
		}
		$data = $this->db->select('*')
						 ->from('los_calon_nasabah AS los_cn')
						 ->join('los_order AS los_or','los_cn.id_calon_debitur = los_or.id_calon_debitur')
						 ->join('los_caa','los_or.id = los_caa.id_order')
						 ->where($where)
						 ->get()
						 ->num_rows();
		echo json_encode(array('total_memo_reject' => $data));
	}

	public function getAllCaa($value='')
	{
		$data = $this->business->get('los_caa',null)->num_rows();
		echo json_encode(array('total_caa' => $data));
	}

	public function getTotalDisetujui($session_kantor)
	{
		$data = $this->business->get_total_disetujui($session_kantor)->result();
		echo json_encode($data);
	}

	public function getAllOffering($value='')
	{
		$data = $this->business->get('los_offering_letter',null)->num_rows();
		echo json_encode(array('total_off' => $data));
	}

	public function sendEmail($toemail,$subject,$msg)
	{

	    $this->load->library('email');
	    $config = array();
	    $config['charset'] = 'utf-8';
	    $config['protocol']= "smtp";
	    $config['mailtype']= "html";
	    $config['smtp_host']= "ssl://smtp.googlemail.com";//pengaturan smtp
	    $config['smtp_port']= 465;
	    $config['smtp_user']= "dpmsejahtera@gmail.com"; // isi dengan email kamu
	    $config['smtp_pass']= "mod3.1.1.1"; // isi dengan password kamu
	    $config['crlf']="\r\n";
	    $config['newline']="\r\n";
	    $config['wordwrap'] = TRUE;
	    //memanggil library email dan set konfigurasi untuk pengiriman email
	    $this->email->initialize($config);
	    //konfigurasi pengiriman
	    $this->email->from($config['smtp_user'],'KDPMS BISNIS');
	    $this->email->to($toemail);
	    $this->email->subject($subject);
	    $this->email->message($msg);

	    if(!$this->email->send())
	    {
	       show_error($this->email->print_debugger());
	    }
	}
	/*-----------------------*/

	public function data_nasabah()
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'manager' || $jabatan == 'ketua') {
			$ao = null;
		}else{
			$ao = $this->session->userdata('id');
		}

		$data = $this->business->data_c_nasabah($areakerja,$startlimit,$keysearch,$ao)->result();
		$hit = $this->business->data_c_nasabah($areakerja,$startlimit,$keysearch,$ao)->num_rows();
		if ($hit == 0) {
			echo json_encode(array('amount' => $hit));
		}else{
			echo json_encode(array('total_nasabah' => $hit, 'data' => $data));
		}
	}

	public function seacrhNasabah($value='')
	{
		$keysearch = $this->input->post('keyword');
		$startlimit = 0;
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$areakerja = 'semua';
			$ao = null;
		}else if($jabatan == 'manager') {
			$areakerja = $this->session->userdata('kantor');
			$ao = null;
		}else{
			$areakerja = $this->session->userdata('kantor');
			$ao = $this->session->userdata('id');
		}

		$data = $this->business->data_c_nasabah($areakerja,$startlimit,$keysearch,$ao)->result();
		$hit = $this->business->data_c_nasabah($areakerja,$startlimit,$keysearch,$ao)->num_rows();
		if ($hit == 0) {
			echo json_encode(array('amount' => $hit));
		}else{
			echo json_encode(array('total_nasabah' => $hit, 'data' => $data));
		}
	}

	public function data_jaminan()
	{
		$data = $this->business->get('los_jenis_jaminan',null)->result();
		$hit = $this->business->get('los_jenis_jaminan',null)->num_rows();
		if ($hit == 0) {
			echo json_encode(array('amount' => $hit));
		}else{
			echo json_encode($data);
		}
	}

	public function ao($value='')
	{
		$data = $this->business->get('kre_kode_group2',null)->result();
		echo json_encode($data);
	}

	public function kantor($value='')
	{
		$data = $this->business->get('app_kode_kantor',null)->result();
		echo json_encode($data);
	}

	public function agama($value='')
	{
		$data = $this->business->get('css_kode_agama',null)->result();
		echo json_encode($data);
	}

	public function Pekerjaan($value='')
	{
		$data = $this->business->get('css_kode_pekerjaan',null)->result();
		echo json_encode($data);
	}

	public function pendidikan($value='')
	{
		$data = $this->business->get('los_pendidikan',null)->result();
		echo json_encode($data);
	}

	public function sumberPenghasilan($value='')
	{
		$data = $this->business->get('css_sumber_penghasilan',null)->result();
		echo json_encode($data);
	}

	public function kepemilikanRumah($value='')
	{
		$data = $this->business->get('los_kepemilikan_rumah',null)->result();
		echo json_encode($data);
	}

	public function provinsi($value='')
	{
		$data = $this->business->get('los_propinsi','propinsi_id')->result();
		echo json_encode($data);
	}

	public function kotakab($value='')
	{
		$propinsi_id = $this->uri->segment(3);
		$where = array('propinsi_id' => $propinsi_id);
		$data = $this->business->get_where('los_kotakab','name','ASC',$where)->result();
		echo json_encode($data);
	}

	public function kecamatan($value='')
	{
		$kotakab_id = $this->uri->segment(3);
		$where = array('kotakab_id' => $kotakab_id);
		$data = $this->business->get_where('los_kecamatan','name','ASC',$where)->result();
		echo json_encode($data);
	}

	public function kelurahan($value='')
	{
		$kecamatan_id = $this->uri->segment(3);
		$where = array('kecamatan_id' => $kecamatan_id);
		$data = $this->business->get_where('los_kelurahan','name','ASC',$where)->result();
		echo json_encode($data);
	}
	/*CALON NASABAH*/

	public function checkNasabahExist($value='')
	{
		$no_ktp = $this->uri->segment(3);
		$where = array('no_ktp' => $no_ktp);
		$query = $this->business->get_where('los_calon_nasabah',null,null,$where)->num_rows();
		if ($query > 0) {
			echo json_encode(array('amount' => $query));
		}else{
			echo json_encode(array('amount' => $query));
		}
	}

	public function checkNokkNasabah($value='')
	{
		$no_ktp = $this->uri->segment(3);
		$where = array('no_kk' => $no_ktp);
		$query = $this->business->get_where('los_calon_nasabah',null,null,$where)->num_rows();
		if ($query > 0) {
			echo json_encode(array('amount' => $query));
		}else{
			echo json_encode(array('amount' => $query));
		}
	}


	public function checkPasanganExist($value='')
	{
		$no_ktp = $this->uri->segment(3);
		$where = array('no_ktp' => $no_ktp);
		$query = $this->business->get_where('los_calon_nasabah_pasangan',null,null,$where)->num_rows();
		if ($query > 0) {
			echo json_encode(array('amount' => $query));
		}else{
			echo json_encode(array('amount' => $query));
		}
	}

	public function getIdnasabah($value='')
	{
		$noktp = $this->uri->segment(3);
		$query = 'SELECT id_calon_debitur FROM los_calon_nasabah WHERE no_ktp ='.$noktp;
		$db = $this->db->query($query)->result();
		foreach ($db as $h) {
			$id = $h->id_calon_debitur;
		}
		echo json_encode(array('id_calon_debitur' => $id));
	}

	public function getIdpasangan($value='')
	{
		$noktp = $this->uri->segment(3);
		$query = 'SELECT id_calon_debitur FROM los_calon_nasabah_pasangan WHERE no_ktp ='.$noktp;
		$db = $this->db->query($query)->result();
		foreach ($db as $h) {
			$id = $h->id_calon_debitur;
		}
		echo json_encode(array('id_calon_debitur' => $id));
	}

	public function add_nasabah()
	{
		/*POST CALON NASABAH*/
		$kantor = $this->input->post('kantor');
		$ao = $this->input->post('ao');
		//$nama_lengkap_calon_nasabah = $this->input->post('nama_lengkap_cn');
		$nama_identitas_calon_nasabah = $this->input->post('nama_identitas_cn');
		$nama_panggilan_calon_nasabah = $this->input->post('nama_panggilan_cn');
		$no_ktp_calon_nasabah = $this->input->post('no_ktp_cn');
		$npwp_calon_nasabah = $this->input->post('npwp_cn');
		$kelamin_calon_nasabah = $this->input->post('kelamin_cn');
		$nama_gadis_ibu_kandung_calon_nasabah =  $this->input->post('nama_gadis_ibu_kandung_cn');
		$no_kk_calon_nasabah = $this->input->post('no_kk_cn');
		$jenis_debitur_calon_nasabah = $this->input->post('jenis_debitur_cn');
		$status_nikah_calon_nasabah = $this->input->post('status_nikah_cn');
		$tempat_lahir_calon_nasabah = $this->input->post('tempat_lahir_cn');
		$tgl_lahir_calon_nasabah = $this->input->post('tgl_lahir_cn');
		$agama_calon_nasabah = $this->input->post('agama_cn');
		$pekerjaan_calon_nasabah = $this->input->post('pekerjaan_cn');
		$kewarganegaraan_calon_nasabah = $this->input->post('kewarganegaraan_cn');
		$pen_terakhir_calon_nasabah = $this->input->post('pen_terakhir_cn');
		$sumber_peng_calon_nasabah = $this->input->post('sumber_peng_cn');
		$status_kep_rumah_calon_nasabah = $this->input->post('status_kep_rumah_cn');
		$tinggal_sejak_calon_nasabah = $this->input->post('tinggal_sejak_cn');
		//$jum_tanah_calon_nasabah = $this->input->post('jum_tanah_cn');
		$jum_tanah_bangunan_calon_nasabah = $this->input->post('jum_tanah_bangunan_cn');
		$jum_motor_calon_nasabah = $this->input->post('jum_motor_cn');
		$jum_mobil_calon_nasabah = $this->input->post('jum_mobil_cn');
		$telp_rumah_calon_nasabah = $this->input->post('telp_rumah_cn');
		$telp_kantor_calon_nasabah = $this->input->post('telp_kantor_cn');
		$telp_hp_calon_nasabah = $this->input->post('telp_hp_cn');
		$email_calon_nasabah = $this->input->post('email_cn');
		$alamat_calon_nasabah = $this->input->post('alamat_cn');
		$propinsi_calon_nasabah = $this->input->post('propinsi_cn');
		$kabkota_calon_nasabah = $this->input->post('kabkota_cn');
		$kecamatan_calon_nasabah = $this->input->post('kecamatan_cn');
		$kelurahan_calon_nasabah = $this->input->post('kelurahan_cn');
		$rt_calon_nasabah = $this->input->post('rt_cn');
		$rw_calon_nasabah = $this->input->post('rw_cn');
		$alamat_dom_calon_nasabah = $this->input->post('alamat_dom_cn');
		$propinsi_dom_calon_nasabah = $this->input->post('propinsi_dom_cn');
		$kabkota_dom_calon_nasabah = $this->input->post('kabkota_dom_cn');
		$kecamatan_dom_calon_nasabah = $this->input->post('kecamatan_dom_cn');
		$kelurahan_dom_calon_nasabah = $this->input->post('kelurahan_dom_cn');
		$rt_dom_calon_nasabah = $this->input->post('rt_dom_cn');
		$rw_dom_calon_nasabah = $this->input->post('rw_dom_cn');

		$penjamin = $this->input->post('penjamin');
		/*------------*/

		/*POST PASANGAN*/
		//$nama_lengkap_pasangan = $this->input->post('nama_lengkap_pasangan');
		$nama_identitas_pasangan = $this->input->post('nama_identitas_pasangan');
		$nama_panggilan_pasangan = $this->input->post('nama_panggilan_pasangan');
		$no_ktp_pasangan = $this->input->post('no_ktp_pasangan');
		$npwp_pasangan = $this->input->post('npwp_pasangan');
		$kelamin_pasangan = $this->input->post('kelamin_pasangan');
		$nama_gadis_ibu_kandung_pasangan =  $this->input->post('nama_gadis_ibu_kandung_pasangan');
		$no_kk_pasangan = $this->input->post('no_kk_pasangan');
		$status_nikah_pasangan = $this->input->post('status_nikah_pasangan');
		$tempat_lahir_pasangan = $this->input->post('tempat_lahir_pasangan');
		$tgl_lahir_pasangan = $this->input->post('tgl_lahir_pasangan');
		$agama_pasangan = $this->input->post('agama_pasangan');
		$pekerjaan_pasangan = $this->input->post('pekerjaan_pasangan');
		$kewarganegaraan_pasangan = $this->input->post('kewarganegaraan_pasangan');
		$pendidikan_pasangan = $this->input->post('pen_terakhir_pasangan');
		$sumber_peng_pasangan = $this->input->post('sumber_peng_pasangan');
		$telp_rumah_pasangan = $this->input->post('telp_rumah_pasangan');
		$telp_kantor_pasangan = $this->input->post('telp_kantor_pasangan');
		$telp_hp_pasangan = $this->input->post('telp_hp_pasangan');
		$email_pasangan = $this->input->post('email_pasangan');
		$alamat_pasangan = $this->input->post('alamat_pasangan');
		$propinsi_pasangan = $this->input->post('propinsi_pasangan');
		$kabkota_pasangan = $this->input->post('kabkota_pasangan');
		$kecamatan_pasangan = $this->input->post('kecamatan_pasangan');
		$kelurahan_pasangan = $this->input->post('kelurahan_pasangan');
		$rt_pasangan = $this->input->post('rt_pasangan');
		$rw_pasangan = $this->input->post('rw_pasangan');
		$alamat_dom_pasangan = $this->input->post('alamat_dom_pasangan');
		$propinsi_dom_pasangan = $this->input->post('propinsi_dom_pasangan');
		$kabkota_dom_pasangan = $this->input->post('kabkota_dom_pasangan');
		$kecamatan_dom_pasangan = $this->input->post('kecamatan_dom_pasangan');
		$kelurahan_dom_pasangan = $this->input->post('kelurahan_dom_pasangan');
		$rt_dom_pasangan = $this->input->post('rt_dom_pasangan');
		$rw_dom_pasangan = $this->input->post('rw_dom_pasangan');
		/*------------*/

		/*POST PENJAMIN*/
		//$nama_lengkap_penjamin = $this->input->post('nama_lengkap_penjamin');
		$nama_identitas_penjamin = $this->input->post('nama_identitas_penjamin');
		$no_ktp_penjamin = $this->input->post('no_ktp_penjamin');
		$npwp_penjamin = $this->input->post('npwp_penjamin');
		$kelamin_penjamin = $this->input->post('kelamin_penjamin');
		$nama_gadis_ibu_kandung_penjamin =  $this->input->post('nama_gadis_ibu_kandung_penjamin');
		$no_kk_penjamin = $this->input->post('no_kk_penjamin');
		$jenis_debitur_penjamin = $this->input->post('jenis_debitur_penjamin');
		$status_nikah_penjamin = $this->input->post('status_nikah_penjamin');
		$tempat_lahir_penjamin = $this->input->post('tempat_lahir_penjamin');
		$tgl_lahir_penjamin = $this->input->post('tgl_lahir_penjamin');
		$agama_penjamin = $this->input->post('agama_penjamin');
		$pekerjaan_penjamin = $this->input->post('pekerjaan_penjamin');
		$hub_debitur = $this->input->post('hub_debitur');
		$kewarganegaraan_penjamin = $this->input->post('kewarganegaraan_penjamin');
		$alamat_penjamin = $this->input->post('alamat_penjamin');
		$propinsi_penjamin = $this->input->post('propinsi_penjamin');
		$kabkota_penjamin = $this->input->post('kabkota_penjamin');
		$kecamatan_penjamin = $this->input->post('kecamatan_penjamin');
		$kelurahan_penjamin = $this->input->post('kelurahan_penjamin');
		$rt_penjamin = $this->input->post('rt_penjamin');
		$rw_penjamin = $this->input->post('rw_penjamin');
		/*-----------*/

		$dataCalonNasabah = array(
			'id_calon_debitur' => null,
			'kode_kantor' => $kantor,
			'kode_ao' => $ao,
			'nama_lengkap' => $nama_identitas_calon_nasabah,
			'nama_panggilan' => $nama_panggilan_calon_nasabah,
			'nama_identitas' => $nama_identitas_calon_nasabah,
			'no_ktp' => $no_ktp_calon_nasabah,
			'npwp' => $npwp_calon_nasabah,
			'kelamin' => $kelamin_calon_nasabah,
			'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_calon_nasabah,
			'no_kk' => $no_kk_calon_nasabah,
			'jenis_debitur' => $jenis_debitur_calon_nasabah,
			'status_nikah' => $status_nikah_calon_nasabah,
			'tempat_lahir' => $tempat_lahir_calon_nasabah,
			'tgl_lahir' => $tgl_lahir_calon_nasabah,
			'kode_agama' => $agama_calon_nasabah,
			'pekerjaan' => $pekerjaan_calon_nasabah,
			'kewarganegaraan' => $kewarganegaraan_calon_nasabah,
			'pendidikan' => $pen_terakhir_calon_nasabah,
			'sumber_penghasilan' => $sumber_peng_calon_nasabah,
			'kepemilikan_rumah' => $status_kep_rumah_calon_nasabah,
			'tinggal_sejak' => $tinggal_sejak_calon_nasabah,
			// 'jumlah_kepemilikan_tanah' => $jum_tanah_calon_nasabah,
			'jumlah_kepemilikan_tanah_bangunan' => $jum_tanah_bangunan_calon_nasabah,
			'jumlah_kendaraan_motor' => $jum_motor_calon_nasabah,
			'jumlah_kendaraan_mobil' => $jum_mobil_calon_nasabah,
			'flag_ektp' => 1,
			'ktp_expired' => null,
			'alamat' => $alamat_calon_nasabah,
			'propinsi_id' => $propinsi_calon_nasabah,
			'kotakab_id' => $kabkota_calon_nasabah,
			'kecamatan_id' => $kecamatan_calon_nasabah,
			'kelurahan_id' => $kelurahan_calon_nasabah,
			'rt' => $rt_calon_nasabah,
			'rw' => $rw_calon_nasabah,
			'telp_rumah' => $telp_rumah_calon_nasabah,
			'telp_kantor' => $telp_kantor_calon_nasabah,
			'telp_hp' => $telp_hp_calon_nasabah,
			'domisili_alamat' => $alamat_dom_calon_nasabah,
			'domisili_propinsi_id' => $propinsi_dom_calon_nasabah,
			'domisili_kotakab_id' => $kabkota_dom_calon_nasabah,
			'domisili_kecamatan_id' => $kecamatan_dom_calon_nasabah,
			'domisili_kelurahan_id' => $kelurahan_dom_calon_nasabah,
			'domisili_rt' => $rt_dom_calon_nasabah,
			'domisili_rw' => $rw_dom_calon_nasabah,
			'email' => $email_calon_nasabah,
			'nama_kerabat' => $this->input->post('nama_kerabat'),
			'hubungan_dengan_calon' => $this->input->post('hubungan_dengan_calon'),
			'no_telp_kerabat' => $this->input->post('no_telp_kerabat'),
			'alamat_kerabat' => $this->input->post('alamat_kerabat'),
			'propinsi_kerabat' => $this->input->post('propinsi_kerabat'),
			'kabupaten_kerabat' => $this->input->post('kabupaten_kerabat'),
			'kecamatan_kerabat' => $this->input->post('kecamatan_kerabat'),
			'rt_kerabat' => $this->input->post('rt_kerabat'),
			'rw_kerabat' => $this->input->post('rw_kerabat'),
			'kode_pos_Kerabat' => $this->input->post('kode_pos_Kerabat'),
			'tgl_register' => date('Y-m-d H:i:s'),
			'verifikasi' => 1,
			'create_date' => date('Y-m-d H:i:s'),
			'create_by' => $this->session->userdata('id'),
			'last_update' => null,
			'update_by' => null,
			'flg_aktif' =>1

		);

		if ($status_nikah_calon_nasabah == 'KAWIN' && $penjamin == 'ya_penjamin') {
			$id = $this->business->add_data_nasabah('los_calon_nasabah',$dataCalonNasabah);

			$dataPasangan = array(
				'id_calon_debitur' => $id,
				'no_ktp' => $no_ktp_pasangan,
				'nama_lengkap' => $nama_identitas_pasangan,
				'nama_panggilan' => $nama_panggilan_pasangan,
				'nama_identitas' => $nama_identitas_pasangan,
				'npwp' => $npwp_pasangan,
				'kelamin' => $kelamin_pasangan,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_pasangan,
				'no_kk' => $no_kk_pasangan,
				'tempat_lahir' => $tempat_lahir_pasangan,
				'tgl_lahir' => $tgl_lahir_pasangan,
				'kode_agama' => $agama_pasangan,
				'pekerjaan' => $pekerjaan_pasangan,
				'kewarganegaraan' => $kewarganegaraan_pasangan,
				'pendidikan' => $pendidikan_pasangan,
				'sumber_penghasilan' => $sumber_peng_pasangan,
				'flag_ektp' => 1,
				'ktp_expired' => null,
				'alamat' => $alamat_pasangan,
				'propinsi_id' => $propinsi_pasangan,
				'kotakab_id' => $kabkota_pasangan,
				'kecamatan_id' => $kecamatan_pasangan,
				'kelurahan_id' => $kelurahan_pasangan,
				'rt' => $rt_pasangan,
				'rw' => $rw_pasangan,
				'telp_rumah' => $telp_rumah_pasangan,
				'telp_kantor' => $telp_kantor_pasangan,
				'telp_hp' => $telp_hp_pasangan,
				'domisili_alamat' => $alamat_dom_pasangan,
				'domisili_propinsi_id' => $propinsi_dom_pasangan,
				'domisili_kotakab_id' => $kabkota_dom_pasangan,
				'domisili_kecamatan_id' => $kecamatan_dom_pasangan,
				'domisili_kelurahan_id' => $kelurahan_dom_pasangan,
				'domisili_rt' => $rt_dom_pasangan,
				'domisili_rw' => $rw_dom_pasangan,
				'email' => $email_pasangan,
				'tgl_register' => date('Y-m-d H:i:s'),
				'verifikasi' => 1,
				'create_date' => date('Y-m-d H:i:s'),
				'create_by' => $this->session->userdata('id'),
				'last_update' => null,
				'update_by' => null,
				'flg_aktif' => 1,
			);

			$dataPenjamin = array(
				'id_calon_debitur' => $id,
				'no_ktp' => $no_ktp_penjamin,
				'nama_lengkap' => $nama_identitas_penjamin,
				'nama_identitas' => $nama_identitas_penjamin,
				'npwp' => $npwp_penjamin,
				'kelamin' => $kelamin_penjamin,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_penjamin,
				'no_kk' => $no_kk_penjamin,
				'hubungan_debitur' => $hub_debitur,
				'status_nikah' => $status_nikah_penjamin,
				'tempat_lahir' => $tempat_lahir_penjamin,
				'tgl_lahir' => $tgl_lahir_penjamin,
				'kode_agama' => $agama_penjamin,
				'pekerjaan' => $pekerjaan_penjamin,
				'kewarganegaraan' => $kewarganegaraan_penjamin,
				'flag_ektp' => 1,
				'ktp_expired' => null,
				'alamat' => $alamat_penjamin,
				'propinsi_id' => $propinsi_penjamin,
				'kotakab_id' => $kabkota_penjamin,
				'kecamatan_id' => $kecamatan_penjamin,
				'kelurahan_id' => $kelurahan_penjamin,
				'rt' => $rt_penjamin,
				'rw' => $rw_penjamin,
				'tgl_register' => date('Y-m-d H:i:s'),
				'verifikasi' => 1,
				'create_date' => date('Y-m-d H:i:s'),
				'create_by' => $this->session->userdata('id'),
				'last_update' => null,
				'update_by' => null,
				'flg_aktif' => 1

			);

			$addPasangan = $this->business->add_data('los_calon_nasabah_pasangan',$dataPasangan);
			$addPenjamin = $this->business->add_data('los_calon_nasabah_penjamin',$dataPenjamin);

			if ($id AND $addPasangan AND $addPenjamin) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}

		}else if ($status_nikah_calon_nasabah == 'KAWIN' && $penjamin == 'tidak_penjamin') {
			$id = $this->business->add_data_nasabah('los_calon_nasabah',$dataCalonNasabah);

			$dataPasangan = array(
				'id_calon_debitur' => $id,
				'no_ktp' => $no_ktp_pasangan,
				'nama_lengkap' => $nama_identitas_pasangan,
				'nama_panggilan' => $nama_panggilan_pasangan,
				'nama_identitas' => $nama_identitas_pasangan,
				'npwp' => $npwp_pasangan,
				'kelamin' => $kelamin_pasangan,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_pasangan,
				'no_kk' => $no_kk_pasangan,
				'tempat_lahir' => $tempat_lahir_pasangan,
				'tgl_lahir' => $tgl_lahir_pasangan,
				'kode_agama' => $agama_pasangan,
				'pekerjaan' => $pekerjaan_pasangan,
				'kewarganegaraan' => $kewarganegaraan_pasangan,
				'pendidikan' => $pendidikan_pasangan,
				'sumber_penghasilan' => $sumber_peng_pasangan,
				'flag_ektp' => 1,
				'ktp_expired' => null,
				'alamat' => $alamat_pasangan,
				'propinsi_id' => $propinsi_pasangan,
				'kotakab_id' => $kabkota_pasangan,
				'kecamatan_id' => $kecamatan_pasangan,
				'kelurahan_id' => $kelurahan_pasangan,
				'rt' => $rt_pasangan,
				'rw' => $rw_pasangan,
				'telp_rumah' => $telp_rumah_pasangan,
				'telp_kantor' => $telp_kantor_pasangan,
				'telp_hp' => $telp_hp_pasangan,
				'domisili_alamat' => $alamat_dom_pasangan,
				'domisili_propinsi_id' => $propinsi_dom_pasangan,
				'domisili_kotakab_id' => $kabkota_dom_pasangan,
				'domisili_kecamatan_id' => $kecamatan_dom_pasangan,
				'domisili_kelurahan_id' => $kelurahan_dom_pasangan,
				'domisili_rt' => $rt_dom_pasangan,
				'domisili_rw' => $rw_dom_pasangan,
				'email' => $email_pasangan,
				'tgl_register' => date('Y-m-d H:i:s'),
				'verifikasi' => 1,
				'create_date' => date('Y-m-d H:i:s'),
				'create_by' => $this->session->userdata('id'),
				'last_update' => null,
				'update_by' => null,
				'flg_aktif' => 1,
			);

			$addPasangan = $this->business->add_data('los_calon_nasabah_pasangan',$dataPasangan);
			if ($id AND $addPasangan) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}else if ($penjamin == 'ya_penjamin') {
			$id = $this->business->add_data_nasabah('los_calon_nasabah',$dataCalonNasabah);

			$dataPenjamin = array(
				'id_calon_debitur' => $id,
				'no_ktp' => $no_ktp_penjamin,
				'nama_lengkap' => $nama_identitas_penjamin,
				'nama_identitas' => $nama_identitas_penjamin,
				'npwp' => $npwp_penjamin,
				'kelamin' => $kelamin_penjamin,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_penjamin,
				'no_kk' => $no_kk_penjamin,
				'hubungan_debitur' => $hub_debitur,
				'status_nikah' => $status_nikah_penjamin,
				'tempat_lahir' => $tempat_lahir_penjamin,
				'tgl_lahir' => $tgl_lahir_penjamin,
				'kode_agama' => $agama_penjamin,
				'pekerjaan' => $pekerjaan_penjamin,
				'kewarganegaraan' => $kewarganegaraan_penjamin,
				'flag_ektp' => 1,
				'ktp_expired' => null,
				'alamat' => $alamat_penjamin,
				'propinsi_id' => $propinsi_penjamin,
				'kotakab_id' => $kabkota_penjamin,
				'kecamatan_id' => $kecamatan_penjamin,
				'kelurahan_id' => $kelurahan_penjamin,
				'rt' => $rt_penjamin,
				'rw' => $rw_penjamin,
				'tgl_register' => date('Y-m-d H:i:s'),
				'verifikasi' => 1,
				'create_date' => date('Y-m-d H:i:s'),
				'create_by' => $this->session->userdata('id'),
				'last_update' => null,
				'update_by' => null,
				'flg_aktif' => 1

			);

			$addPenjamin = $this->business->add_data('los_calon_nasabah_penjamin',$dataPenjamin);

			if ($id AND $addPenjamin) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}else{
			$id = $this->business->add_data_nasabah('los_calon_nasabah',$dataCalonNasabah);
			if ($id) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}
	}

	public function save_edit_c_nasabah($value='')
	{
		$verifikasi = $this->input->post('verifikasi');
		$id_calon_debitur = $this->input->post('id_calon_debitur');
		$status_pasangan = $this->input->post('status_pasangan');
		$status_penjamin = $this->input->post('status_penjamin');
		$where = array('id_calon_debitur' => $id_calon_debitur);

		$kantor = $this->input->post('kantor');
		$ao = $this->input->post('ao');
		$nama_lengkap_calon_nasabah = $this->input->post('nama_lengkap_cn');
		$nama_identitas_calon_nasabah = $this->input->post('nama_identitas_cn');
		$nama_panggilan_calon_nasabah = $this->input->post('nama_panggilan_cn');
		$no_ktp_calon_nasabah = $this->input->post('no_ktp_cn');
		$npwp_calon_nasabah = $this->input->post('npwp_cn');
		$kelamin_calon_nasabah = $this->input->post('kelamin_cn');
		$nama_gadis_ibu_kandung_calon_nasabah =  $this->input->post('nama_gadis_ibu_kandung_cn');
		$no_kk_calon_nasabah = $this->input->post('no_kk_cn');
		$jenis_debitur_calon_nasabah = $this->input->post('jenis_debitur_cn');
		$status_nikah_calon_nasabah = $this->input->post('status_nikah_cn');
		$tempat_lahir_calon_nasabah = $this->input->post('tempat_lahir_cn');
		$tgl_lahir_calon_nasabah = $this->input->post('tgl_lahir_cn');
		$agama_calon_nasabah = $this->input->post('agama_cn');
		$pekerjaan_calon_nasabah = $this->input->post('pekerjaan_cn');
		$kewarganegaraan_calon_nasabah = $this->input->post('kewarganegaraan_cn');
		$pen_terakhir_calon_nasabah = $this->input->post('pen_terakhir_cn');
		$sumber_peng_calon_nasabah = $this->input->post('sumber_peng_cn');
		$status_kep_rumah_calon_nasabah = $this->input->post('status_kep_rumah_cn');
		$tinggal_sejak_calon_nasabah = $this->input->post('tinggal_sejak_cn');
		$jum_tanah_calon_nasabah = $this->input->post('jum_tanah_cn');
		$jum_tanah_bangunan_calon_nasabah = $this->input->post('jum_tanah_bangunan_cn');
		$jum_motor_calon_nasabah = $this->input->post('jum_motor_cn');
		$jum_mobil_calon_nasabah = $this->input->post('jum_mobil_cn');
		$telp_rumah_calon_nasabah = $this->input->post('telp_rumah_cn');
		$telp_kantor_calon_nasabah = $this->input->post('telp_kantor_cn');
		$telp_hp_calon_nasabah = $this->input->post('telp_hp_cn');
		$email_calon_nasabah = $this->input->post('email_cn');
		$alamat_calon_nasabah = $this->input->post('alamat_cn');
		$propinsi_calon_nasabah = $this->input->post('propinsi_cn');
		$kabkota_calon_nasabah = $this->input->post('kabkota_cn');
		$kecamatan_calon_nasabah = $this->input->post('kecamatan_cn');
		$kelurahan_calon_nasabah = $this->input->post('kelurahan_cn');
		$rt_calon_nasabah = $this->input->post('rt_cn');
		$rw_calon_nasabah = $this->input->post('rw_cn');
		$alamat_dom_calon_nasabah = $this->input->post('alamat_dom_cn');
		$propinsi_dom_calon_nasabah = $this->input->post('propinsi_dom_cn');
		$kabkota_dom_calon_nasabah = $this->input->post('kabkota_dom_cn');
		$kecamatan_dom_calon_nasabah = $this->input->post('kecamatan_dom_cn');
		$kelurahan_dom_calon_nasabah = $this->input->post('kelurahan_dom_cn');
		$rt_dom_calon_nasabah = $this->input->post('rt_dom_cn');
		$rw_dom_calon_nasabah = $this->input->post('rw_dom_cn');


		$nama_lengkap_pasangan = $this->input->post('nama_lengkap_pasangan');
		$nama_identitas_pasangan = $this->input->post('nama_identitas_pasangan');
		$nama_panggilan_pasangan = $this->input->post('nama_panggilan_pasangan');
		$no_ktp_pasangan = $this->input->post('no_ktp_pasangan');
		$npwp_pasangan = $this->input->post('npwp_pasangan');
		$kelamin_pasangan = $this->input->post('kelamin_pasangan');
		$nama_gadis_ibu_kandung_pasangan =  $this->input->post('nama_gadis_ibu_kandung_pasangan');
		$no_kk_pasangan = $this->input->post('no_kk_pasangan');
		$status_nikah_pasangan = $this->input->post('status_nikah_pasangan');
		$tempat_lahir_pasangan = $this->input->post('tempat_lahir_pasangan');
		$tgl_lahir_pasangan = $this->input->post('tgl_lahir_pasangan');
		$agama_pasangan = $this->input->post('agama_pasangan');
		$pekerjaan_pasangan = $this->input->post('pekerjaan_pasangan');
		$kewarganegaraan_pasangan = $this->input->post('kewarganegaraan_pasangan');
		$pendidikan_pasangan = $this->input->post('pen_terakhir_pasangan');
		$sumber_peng_pasangan = $this->input->post('sumber_peng_pasangan');
		$telp_rumah_pasangan = $this->input->post('telp_rumah_pasangan');
		$telp_kantor_pasangan = $this->input->post('telp_kantor_pasangan');
		$telp_hp_pasangan = $this->input->post('telp_hp_pasangan');
		$email_pasangan = $this->input->post('email_pasangan');
		$alamat_pasangan = $this->input->post('alamat_pasangan');
		$propinsi_pasangan = $this->input->post('propinsi_pasangan');
		$kabkota_pasangan = $this->input->post('kabkota_pasangan');
		$kecamatan_pasangan = $this->input->post('kecamatan_pasangan');
		$kelurahan_pasangan = $this->input->post('kelurahan_pasangan');
		$rt_pasangan = $this->input->post('rt_pasangan');
		$rw_pasangan = $this->input->post('rw_pasangan');
		$alamat_dom_pasangan = $this->input->post('alamat_dom_pasangan');
		$propinsi_dom_pasangan = $this->input->post('propinsi_dom_pasangan');
		$kabkota_dom_pasangan = $this->input->post('kabkota_dom_pasangan');
		$kecamatan_dom_pasangan = $this->input->post('kecamatan_dom_pasangan');
		$kelurahan_dom_pasangan = $this->input->post('kelurahan_dom_pasangan');
		$rt_dom_pasangan = $this->input->post('rt_dom_pasangan');
		$rw_dom_pasangan = $this->input->post('rw_dom_pasangan');

		$nama_lengkap_penjamin = $this->input->post('nama_lengkap_penjamin');
		$nama_identitas_penjamin = $this->input->post('nama_identitas_penjamin');
		$no_ktp_penjamin = $this->input->post('no_ktp_penjamin');
		$npwp_penjamin = $this->input->post('npwp_penjamin');
		$kelamin_penjamin = $this->input->post('kelamin_penjamin');
		$nama_gadis_ibu_kandung_penjamin =  $this->input->post('nama_gadis_ibu_kandung_penjamin');
		$no_kk_penjamin = $this->input->post('no_kk_penjamin');
		$jenis_debitur_penjamin = $this->input->post('jenis_debitur_penjamin');
		$status_nikah_penjamin = $this->input->post('status_nikah_penjamin');
		$tempat_lahir_penjamin = $this->input->post('tempat_lahir_penjamin');
		$tgl_lahir_penjamin = $this->input->post('tgl_lahir_penjamin');
		$agama_penjamin = $this->input->post('agama_penjamin');
		$pekerjaan_penjamin = $this->input->post('pekerjaan_penjamin');
		$hub_debitur = $this->input->post('hub_debitur');
		$kewarganegaraan_penjamin = $this->input->post('kewarganegaraan_penjamin');
		$alamat_penjamin = $this->input->post('alamat_penjamin');
		$propinsi_penjamin = $this->input->post('propinsi_penjamin');
		$kabkota_penjamin = $this->input->post('kabkota_penjamin');
		$kecamatan_penjamin = $this->input->post('kecamatan_penjamin');
		$kelurahan_penjamin = $this->input->post('kelurahan_penjamin');
		$rt_penjamin = $this->input->post('rt_penjamin');
		$rw_penjamin = $this->input->post('rw_penjamin');
		//verifikasi
		if ($verifikasi == '1') {
			$dataCalonNasabah = array(
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_calon_nasabah,
				'nama_lengkap' => $nama_lengkap_calon_nasabah,
				'nama_panggilan' => $nama_panggilan_calon_nasabah,
				'nama_identitas' => $nama_identitas_calon_nasabah,
				//'status_nikah' => $status_nikah_calon_nasabah,
				'kode_agama' => $agama_calon_nasabah,
				'pekerjaan' => $pekerjaan_calon_nasabah,
				'pendidikan' => $pen_terakhir_calon_nasabah,
				'sumber_penghasilan' => $sumber_peng_calon_nasabah,
				'kepemilikan_rumah' => $status_kep_rumah_calon_nasabah,
				'tinggal_sejak' => $tinggal_sejak_calon_nasabah,
				'jumlah_kepemilikan_tanah' => $jum_tanah_calon_nasabah,
				'jumlah_kepemilikan_tanah_bangunan' => $jum_tanah_bangunan_calon_nasabah,
				'jumlah_kendaraan_motor' => $jum_motor_calon_nasabah,
				'jumlah_kendaraan_mobil' => $jum_mobil_calon_nasabah,
				'alamat' => $alamat_calon_nasabah,
				'propinsi_id' => $propinsi_calon_nasabah,
				'kotakab_id' => $kabkota_calon_nasabah,
				'kecamatan_id' => $kecamatan_calon_nasabah,
				'kelurahan_id' => $kelurahan_calon_nasabah,
				'rt' => $rt_calon_nasabah,
				'rw' => $rw_calon_nasabah,
				'telp_rumah' => $telp_rumah_calon_nasabah,
				'telp_kantor' => $telp_kantor_calon_nasabah,
				'telp_hp' => $telp_hp_calon_nasabah,
				'domisili_alamat' => $alamat_dom_calon_nasabah,
				'domisili_propinsi_id' => $propinsi_dom_calon_nasabah,
				'domisili_kotakab_id' => $kabkota_dom_calon_nasabah,
				'domisili_kecamatan_id' => $kecamatan_dom_calon_nasabah,
				'domisili_kelurahan_id' => $kelurahan_dom_calon_nasabah,
				'domisili_rt' => $rt_dom_calon_nasabah,
				'domisili_rw' => $rw_dom_calon_nasabah,
				'email' => $email_calon_nasabah,
				'nama_kerabat' => $this->input->post('nama_kerabat'),
				'hubungan_dengan_calon' => $this->input->post('hubungan_dengan_calon'),
				'no_telp_kerabat' => $this->input->post('no_telp_kerabat'),
				'alamat_kerabat' => $this->input->post('alamat_kerabat'),
				'propinsi_kerabat' => $this->input->post('propinsi_kerabat'),
				'kabupaten_kerabat' => $this->input->post('kabupaten_kerabat'),
				'kecamatan_kerabat' => $this->input->post('kecamatan_kerabat'),
				'rt_kerabat' => $this->input->post('rt_kerabat'),
				'rw_kerabat' => $this->input->post('rw_kerabat'),
				'kode_pos_Kerabat' => $this->input->post('kode_pos_Kerabat'),
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);

			$dataPasangan = array(
				'nama_lengkap' => $nama_lengkap_pasangan,
				'nama_panggilan' => $nama_panggilan_pasangan,
				'nama_identitas' => $nama_identitas_pasangan,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_pasangan,
				'kode_agama' => $agama_pasangan,
				'pekerjaan' => $pekerjaan_pasangan,
				'pendidikan' => $pendidikan_pasangan,
				'sumber_penghasilan' => $sumber_peng_pasangan,
				'alamat' => $alamat_pasangan,
				'propinsi_id' => $propinsi_pasangan,
				'kotakab_id' => $kabkota_pasangan,
				'kecamatan_id' => $kecamatan_pasangan,
				'kelurahan_id' => $kelurahan_pasangan,
				'rt' => $rt_pasangan,
				'rw' => $rw_pasangan,
				'telp_rumah' => $telp_rumah_pasangan,
				'telp_kantor' => $telp_kantor_pasangan,
				'telp_hp' => $telp_hp_pasangan,
				'domisili_alamat' => $alamat_dom_pasangan,
				'domisili_propinsi_id' => $propinsi_dom_pasangan,
				'domisili_kotakab_id' => $kabkota_dom_pasangan,
				'domisili_kecamatan_id' => $kecamatan_dom_pasangan,
				'domisili_kelurahan_id' => $kelurahan_dom_pasangan,
				'domisili_rt' => $rt_dom_pasangan,
				'domisili_rw' => $rw_dom_pasangan,
				'email' => $email_pasangan,
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);

			$dataPenjamin = array(
				'nama_lengkap' => $nama_lengkap_penjamin,
				'nama_identitas' => $nama_identitas_penjamin,
				'status_nikah' => $status_nikah_penjamin,
				'kode_agama' => $agama_penjamin,
				'pekerjaan' => $pekerjaan_penjamin,
				'alamat' => $alamat_penjamin,
				'propinsi_id' => $propinsi_penjamin,
				'kotakab_id' => $kabkota_penjamin,
				'kecamatan_id' => $kecamatan_penjamin,
				'kelurahan_id' => $kelurahan_penjamin,
				'rt' => $rt_penjamin,
				'rw' => $rw_penjamin,
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);
			if ($status_penjamin == 'tidakada') {
				$queryPasangan = $this->business->update_data('los_calon_nasabah_pasangan',$dataPasangan,$where);
				$query = $this->business->update_data('los_calon_nasabah',$dataCalonNasabah,$where);
				if ($query AND $queryPasangan) {
					echo json_encode(array('msg' => 'success' ));
				}else{
					echo json_encode(array('msg' => 'failed' ));
				}
			}else if ($status_pasangan == 'tidakada') {
				$queryPenjamin = $this->business->update_data('los_calon_nasabah_penjamin',$dataPenjamin,$where);
				$query = $this->business->update_data('los_calon_nasabah',$dataCalonNasabah,$where);
				if ($query AND $queryPenjamin) {
					echo json_encode(array('msg' => 'success' ));
				}else{
					echo json_encode(array('msg' => 'failed' ));
				}
			}else if ($status_penjamin == 'tidakada' && $status_pasangan == 'tidakada') {
				$query = $this->business->update_data('los_calon_nasabah',$dataCalonNasabah,$where);
				if ($query) {
					echo json_encode(array('msg' => 'success' ));
				}else{
					echo json_encode(array('msg' => 'failed' ));
				}
			}
		}else if($verifikasi == '0'){
				$dataCalonNasabah = array(
					'kode_ao' => $ao,
					'nama_lengkap' => $nama_lengkap_calon_nasabah,
					'nama_panggilan' => $nama_panggilan_calon_nasabah,
					'nama_identitas' => $nama_identitas_calon_nasabah,
					'no_ktp' => $no_ktp_calon_nasabah,
					'npwp' => $npwp_calon_nasabah,
					'kelamin' => $kelamin_calon_nasabah,
					'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_calon_nasabah,
					'no_kk' => $no_kk_calon_nasabah,
					'jenis_debitur' => $jenis_debitur_calon_nasabah,
					//'status_nikah' => $status_nikah_calon_nasabah,
					'tempat_lahir' => $tempat_lahir_calon_nasabah,
					'tgl_lahir' => $tgl_lahir_calon_nasabah,
					'kode_agama' => $agama_calon_nasabah,
					'pekerjaan' => $pekerjaan_calon_nasabah,
					'pendidikan' => $pen_terakhir_calon_nasabah,
					'sumber_penghasilan' => $sumber_peng_calon_nasabah,
					'kepemilikan_rumah' => $status_kep_rumah_calon_nasabah,
					'tinggal_sejak' => $tinggal_sejak_calon_nasabah,
					'jumlah_kepemilikan_tanah' => $jum_tanah_calon_nasabah,
					'jumlah_kepemilikan_tanah_bangunan' => $jum_tanah_bangunan_calon_nasabah,
					'jumlah_kendaraan_motor' => $jum_motor_calon_nasabah,
					'jumlah_kendaraan_mobil' => $jum_mobil_calon_nasabah,
					'alamat' => $alamat_calon_nasabah,
					'propinsi_id' => $propinsi_calon_nasabah,
					'kotakab_id' => $kabkota_calon_nasabah,
					'kecamatan_id' => $kecamatan_calon_nasabah,
					'kelurahan_id' => $kelurahan_calon_nasabah,
					'rt' => $rt_calon_nasabah,
					'rw' => $rw_calon_nasabah,
					'telp_rumah' => $telp_rumah_calon_nasabah,
					'telp_kantor' => $telp_kantor_calon_nasabah,
					'telp_hp' => $telp_hp_calon_nasabah,
					'domisili_alamat' => $alamat_dom_calon_nasabah,
					'domisili_propinsi_id' => $propinsi_dom_calon_nasabah,
					'domisili_kotakab_id' => $kabkota_dom_calon_nasabah,
					'domisili_kecamatan_id' => $kecamatan_dom_calon_nasabah,
					'domisili_kelurahan_id' => $kelurahan_dom_calon_nasabah,
					'domisili_rt' => $rt_dom_calon_nasabah,
					'domisili_rw' => $rw_dom_calon_nasabah,
					'email' => $email_calon_nasabah,
					'nama_kerabat' => $this->input->post('nama_kerabat'),
					'hubungan_dengan_calon' => $this->input->post('hubungan_dengan_calon'),
					'no_telp_kerabat' => $this->input->post('no_telp_kerabat'),
					'alamat_kerabat' => $this->input->post('alamat_kerabat'),
					'propinsi_kerabat' => $this->input->post('propinsi_kerabat'),
					'kabupaten_kerabat' => $this->input->post('kabupaten_kerabat'),
					'kecamatan_kerabat' => $this->input->post('kecamatan_kerabat'),
					'rt_kerabat' => $this->input->post('rt_kerabat'),
					'rw_kerabat' => $this->input->post('rw_kerabat'),
					'kode_pos_Kerabat' => $this->input->post('kode_pos_Kerabat'),
					'last_update' => date('Y-m-d H:i:s'),
					'update_by' => $this->session->userdata('id'),
				);

				$dataPasangan = array(
					'no_ktp' => $no_ktp_pasangan,
					'nama_lengkap' => $nama_lengkap_pasangan,
					'nama_panggilan' => $nama_panggilan_pasangan,
					'nama_identitas' => $nama_identitas_pasangan,
					'npwp' => $npwp_pasangan,
					'kelamin' => $kelamin_pasangan,
					'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_pasangan,
					'no_kk' => $no_kk_pasangan,
					'tempat_lahir' => $tempat_lahir_pasangan,
					'tgl_lahir' => $tgl_lahir_pasangan,
					'kode_agama' => $agama_pasangan,
					'pekerjaan' => $pekerjaan_pasangan,
					'kewarganegaraan' => $kewarganegaraan_pasangan,
					'pendidikan' => $pendidikan_pasangan,
					'sumber_penghasilan' => $sumber_peng_pasangan,
					'alamat' => $alamat_pasangan,
					'propinsi_id' => $propinsi_pasangan,
					'kotakab_id' => $kabkota_pasangan,
					'kecamatan_id' => $kecamatan_pasangan,
					'kelurahan_id' => $kelurahan_pasangan,
					'rt' => $rt_pasangan,
					'rw' => $rw_pasangan,
					'telp_rumah' => $telp_rumah_pasangan,
					'telp_kantor' => $telp_kantor_pasangan,
					'telp_hp' => $telp_hp_pasangan,
					'domisili_alamat' => $alamat_dom_pasangan,
					'domisili_propinsi_id' => $propinsi_dom_pasangan,
					'domisili_kotakab_id' => $kabkota_dom_pasangan,
					'domisili_kecamatan_id' => $kecamatan_dom_pasangan,
					'domisili_kelurahan_id' => $kelurahan_dom_pasangan,
					'domisili_rt' => $rt_dom_pasangan,
					'domisili_rw' => $rw_dom_pasangan,
					'email' => $email_pasangan,
					'nama_kerabat' => $this->input->post('nama_kerabat'),
					'hubungan_dengan_calon' => $this->input->post('hubungan_dengan_calon'),
					'no_telp_kerabat' => $this->input->post('no_telp_kerabat'),
					'alamat_kerabat' => $this->input->post('alamat_kerabat'),
					'propinsi_kerabat' => $this->input->post('propinsi_kerabat'),
					'kabupaten_kerabat' => $this->input->post('kabupaten_kerabat'),
					'kecamatan_kerabat' => $this->input->post('kecamatan_kerabat'),
					'rt_kerabat' => $this->input->post('rt_kerabat'),
					'rw_kerabat' => $this->input->post('rw_kerabat'),
					'kode_pos_Kerabat' => $this->input->post('kode_pos_Kerabat'),
					'last_update' => date('Y-m-d H:i:s'),
					'update_by' => $this->session->userdata('id'),
				);

				$dataPenjamin = array(
					'no_ktp' => $no_ktp_penjamin,
					'nama_lengkap' => $nama_lengkap_penjamin,
					'nama_identitas' => $nama_identitas_penjamin,
					'npwp' => $npwp_penjamin,
					'kelamin' => $kelamin_penjamin,
					'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_penjamin,
					'no_kk' => $no_kk_penjamin,
					'hubungan_debitur' => $hub_debitur,
					'status_nikah' => $status_nikah_penjamin,
					'tempat_lahir' => $tempat_lahir_penjamin,
					'tgl_lahir' => $tgl_lahir_penjamin,
					'kode_agama' => $agama_penjamin,
					'pekerjaan' => $pekerjaan_penjamin,
					'kewarganegaraan' => $kewarganegaraan_penjamin,
					'alamat' => $alamat_penjamin,
					'propinsi_id' => $propinsi_penjamin,
					'kotakab_id' => $kabkota_penjamin,
					'kecamatan_id' => $kecamatan_penjamin,
					'kelurahan_id' => $kelurahan_penjamin,
					'rt' => $rt_penjamin,
					'rw' => $rw_penjamin,
					'last_update' => date('Y-m-d H:i:s'),
					'update_by' => $this->session->userdata('id'),
				);
			if ($status_penjamin == 'tidakada') {
				$queryPasangan = $this->business->update_data('los_calon_nasabah_pasangan',$dataPasangan,$where);
				$query = $this->business->update_data('los_calon_nasabah',$dataCalonNasabah,$where);
				if ($query AND $queryPasangan) {
					echo json_encode(array('msg' => 'success' ));
				}else{
					echo json_encode(array('msg' => 'failed' ));
				}
			}else if ($status_pasangan == 'tidakada') {
				$queryPasangan = $this->business->update_data('los_calon_nasabah_penjamin',$dataPenjamin,$where);
				$query = $this->business->update_data('los_calon_nasabah',$dataCalonNasabah,$where);
				if ($query AND $queryPasangan) {
					echo json_encode(array('msg' => 'success' ));
				}else{
					echo json_encode(array('msg' => 'failed' ));
				}
			}else if ($status_penjamin == 'tidakada' && $status_pasangan == 'tidakada') {
				$query = $this->business->update_data('los_calon_nasabah',$dataCalonNasabah,$where);
				if ($query AND $queryPasangan) {
					echo json_encode(array('msg' => 'success' ));
				}else{
					echo json_encode(array('msg' => 'failed' ));
				}
			}
		}else{
			echo json_encode(array('msg' => 'ada yang tidak beres'));
		}
	}

	/*public function save_edit_pasangan_nasabah($value='')
	{
		$verifikasi = $this->input->post('verifikasi');
		$id_calon_debitur = $this->input->post('id_calon_debitur');
		$where = array('id_calon_debitur' => $id_calon_debitur);

		$nama_lengkap_pasangan = $this->input->post('nama_lengkap_pasangan');
		$nama_identitas_pasangan = $this->input->post('nama_identitas_pasangan');
		$nama_panggilan_pasangan = $this->input->post('nama_panggilan_pasangan');
		$no_ktp_pasangan = $this->input->post('no_ktp_pasangan');
		$npwp_pasangan = $this->input->post('npwp_pasangan');
		$kelamin_pasangan = $this->input->post('kelamin_pasangan');
		$nama_gadis_ibu_kandung_pasangan =  $this->input->post('nama_gadis_ibu_kandung_pasangan');
		$no_kk_pasangan = $this->input->post('no_kk_pasangan');
		$status_nikah_pasangan = $this->input->post('status_nikah_pasangan');
		$tempat_lahir_pasangan = $this->input->post('tempat_lahir_pasangan');
		$tgl_lahir_pasangan = $this->input->post('tgl_lahir_pasangan');
		$agama_pasangan = $this->input->post('agama_pasangan');
		$pekerjaan_pasangan = $this->input->post('pekerjaan_pasangan');
		$kewarganegaraan_pasangan = $this->input->post('kewarganegaraan_pasangan');
		$pendidikan_pasangan = $this->input->post('pen_terakhir_pasangan');
		$sumber_peng_pasangan = $this->input->post('sumber_peng_pasangan');
		$telp_rumah_pasangan = $this->input->post('telp_rumah_pasangan');
		$telp_kantor_pasangan = $this->input->post('telp_kantor_pasangan');
		$telp_hp_pasangan = $this->input->post('telp_hp_pasangan');
		$email_pasangan = $this->input->post('email_pasangan');
		$alamat_pasangan = $this->input->post('alamat_pasangan');
		$propinsi_pasangan = $this->input->post('propinsi_pasangan');
		$kabkota_pasangan = $this->input->post('kabkota_pasangan');
		$kecamatan_pasangan = $this->input->post('kecamatan_pasangan');
		$kelurahan_pasangan = $this->input->post('kelurahan_pasangan');
		$rt_pasangan = $this->input->post('rt_pasangan');
		$rw_pasangan = $this->input->post('rw_pasangan');
		$alamat_dom_pasangan = $this->input->post('alamat_dom_pasangan');
		$propinsi_dom_pasangan = $this->input->post('propinsi_dom_pasangan');
		$kabkota_dom_pasangan = $this->input->post('kabkota_dom_pasangan');
		$kecamatan_dom_pasangan = $this->input->post('kecamatan_dom_pasangan');
		$kelurahan_dom_pasangan = $this->input->post('kelurahan_dom_pasangan');
		$rt_dom_pasangan = $this->input->post('rt_dom_pasangan');
		$rw_dom_pasangan = $this->input->post('rw_dom_pasangan');

		if ($verifikasi == 1) {
			$dataPasangan = array(
				'nama_lengkap' => $nama_lengkap_pasangan,
				'nama_panggilan' => $nama_panggilan_pasangan,
				'nama_identitas' => $nama_identitas_pasangan,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_pasangan,
				'kode_agama' => $agama_pasangan,
				'pekerjaan' => $pekerjaan_pasangan,
				'pendidikan' => $pendidikan_pasangan,
				'sumber_penghasilan' => $sumber_peng_pasangan,
				'alamat' => $alamat_pasangan,
				'propinsi_id' => $propinsi_pasangan,
				'kotakab_id' => $kabkota_pasangan,
				'kecamatan_id' => $kecamatan_pasangan,
				'kelurahan_id' => $kelurahan_pasangan,
				'rt' => $rt_pasangan,
				'rw' => $rw_pasangan,
				'telp_rumah' => $telp_rumah_pasangan,
				'telp_kantor' => $telp_kantor_pasangan,
				'telp_hp' => $telp_hp_pasangan,
				'domisili_alamat' => $alamat_dom_pasangan,
				'domisili_propinsi_id' => $propinsi_dom_pasangan,
				'domisili_kotakab_id' => $kabkota_dom_pasangan,
				'domisili_kecamatan_id' => $kecamatan_dom_pasangan,
				'domisili_kelurahan_id' => $kelurahan_dom_pasangan,
				'domisili_rt' => $rt_dom_pasangan,
				'domisili_rw' => $rw_dom_pasangan,
				'email' => $email_pasangan,
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);

			$query = $this->business->update_data('los_calon_nasabah_pasangan',$dataPasangan,$where);
			if ($query) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}else{
			$dataPasangan = array(
				'no_ktp' => $no_ktp_pasangan,
				'nama_lengkap' => $nama_lengkap_pasangan,
				'nama_panggilan' => $nama_panggilan_pasangan,
				'nama_identitas' => $nama_identitas_pasangan,
				'npwp' => $npwp_pasangan,
				'kelamin' => $kelamin_pasangan,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_pasangan,
				'no_kk' => $no_kk_pasangan,
				'tempat_lahir' => $tempat_lahir_pasangan,
				'tgl_lahir' => $tgl_lahir_pasangan,
				'kode_agama' => $agama_pasangan,
				'pekerjaan' => $pekerjaan_pasangan,
				'kewarganegaraan' => $kewarganegaraan_pasangan,
				'pendidikan' => $pendidikan_pasangan,
				'sumber_penghasilan' => $sumber_peng_pasangan,
				'alamat' => $alamat_pasangan,
				'propinsi_id' => $propinsi_pasangan,
				'kotakab_id' => $kabkota_pasangan,
				'kecamatan_id' => $kecamatan_pasangan,
				'kelurahan_id' => $kelurahan_pasangan,
				'rt' => $rt_pasangan,
				'rw' => $rw_pasangan,
				'telp_rumah' => $telp_rumah_pasangan,
				'telp_kantor' => $telp_kantor_pasangan,
				'telp_hp' => $telp_hp_pasangan,
				'domisili_alamat' => $alamat_dom_pasangan,
				'domisili_propinsi_id' => $propinsi_dom_pasangan,
				'domisili_kotakab_id' => $kabkota_dom_pasangan,
				'domisili_kecamatan_id' => $kecamatan_dom_pasangan,
				'domisili_kelurahan_id' => $kelurahan_dom_pasangan,
				'domisili_rt' => $rt_dom_pasangan,
				'domisili_rw' => $rw_dom_pasangan,
				'email' => $email_pasangan,
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);

			$query = $this->business->update_data('los_calon_nasabah_pasangan',$dataPasangan,$where);
			if ($query) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}
	}

	public function save_edit_penjamin_nasabah($value='')
	{
		$verifikasi = $this->input->post('verifikasi');
		$id_calon_debitur = $this->input->post('id_calon_debitur');
		$where = array('id_calon_debitur' => $id_calon_debitur);

		$nama_lengkap_penjamin = $this->input->post('nama_lengkap_penjamin');
		$nama_identitas_penjamin = $this->input->post('nama_identitas_penjamin');
		$no_ktp_penjamin = $this->input->post('no_ktp_penjamin');
		$npwp_penjamin = $this->input->post('npwp_penjamin');
		$kelamin_penjamin = $this->input->post('kelamin_penjamin');
		$nama_gadis_ibu_kandung_penjamin =  $this->input->post('nama_gadis_ibu_kandung_penjamin');
		$no_kk_penjamin = $this->input->post('no_kk_penjamin');
		$jenis_debitur_penjamin = $this->input->post('jenis_debitur_penjamin');
		$status_nikah_penjamin = $this->input->post('status_nikah_penjamin');
		$tempat_lahir_penjamin = $this->input->post('tempat_lahir_penjamin');
		$tgl_lahir_penjamin = $this->input->post('tgl_lahir_penjamin');
		$agama_penjamin = $this->input->post('agama_penjamin');
		$pekerjaan_penjamin = $this->input->post('pekerjaan_penjamin');
		$hub_debitur = $this->input->post('hub_debitur');
		$kewarganegaraan_penjamin = $this->input->post('kewarganegaraan_penjamin');
		$alamat_penjamin = $this->input->post('alamat_penjamin');
		$propinsi_penjamin = $this->input->post('propinsi_penjamin');
		$kabkota_penjamin = $this->input->post('kabkota_penjamin');
		$kecamatan_penjamin = $this->input->post('kecamatan_penjamin');
		$kelurahan_penjamin = $this->input->post('kelurahan_penjamin');
		$rt_penjamin = $this->input->post('rt_penjamin');
		$rw_penjamin = $this->input->post('rw_penjamin');

		if ($verifikasi == 1) {
			$dataPenjamin = array(
				'nama_lengkap' => $nama_lengkap_penjamin,
				'nama_identitas' => $nama_identitas_penjamin,
				'status_nikah' => $status_nikah_penjamin,
				'kode_agama' => $agama_penjamin,
				'pekerjaan' => $pekerjaan_penjamin,
				'alamat' => $alamat_penjamin,
				'propinsi_id' => $propinsi_penjamin,
				'kotakab_id' => $kabkota_penjamin,
				'kecamatan_id' => $kecamatan_penjamin,
				'kelurahan_id' => $kelurahan_penjamin,
				'rt' => $rt_penjamin,
				'rw' => $rw_penjamin,
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);

			$query = $this->business->update_data('los_calon_nasabah_penjamin',$dataPenjamin,$where);
			if ($query) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}else{
			$dataPenjamin = array(
				'no_ktp' => $no_ktp_penjamin,
				'nama_lengkap' => $nama_lengkap_penjamin,
				'nama_identitas' => $nama_identitas_penjamin,
				'npwp' => $npwp_penjamin,
				'kelamin' => $kelamin_penjamin,
				'nama_gadis_ibu_kandung' => $nama_gadis_ibu_kandung_penjamin,
				'no_kk' => $no_kk_penjamin,
				'hubungan_debitur' => $hub_debitur,
				'status_nikah' => $status_nikah_penjamin,
				'tempat_lahir' => $tempat_lahir_penjamin,
				'tgl_lahir' => $tgl_lahir_penjamin,
				'kode_agama' => $agama_penjamin,
				'pekerjaan' => $pekerjaan_penjamin,
				'kewarganegaraan' => $kewarganegaraan_penjamin,
				'alamat' => $alamat_penjamin,
				'propinsi_id' => $propinsi_penjamin,
				'kotakab_id' => $kabkota_penjamin,
				'kecamatan_id' => $kecamatan_penjamin,
				'kelurahan_id' => $kelurahan_penjamin,
				'rt' => $rt_penjamin,
				'rw' => $rw_penjamin,
				'last_update' => date('Y-m-d H:i:s'),
				'update_by' => $this->session->userdata('id'),
			);

			$query = $this->business->update_data('los_calon_nasabah_penjamin',$dataPenjamin,$where);
			if ($query) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}
	}*/

	public function verifikasi_calon_nasabah($value='')
	{
		$id = $this->uri->segment(3);
		$where = array('id_calon_debitur' => $id);

		$data =array(
			'verifikasi' => 1
		);

		$queryCNasabah = $this->business->update_data('los_calon_nasabah',$data,$where);
		$queryPasangan = $this->business->update_data('los_calon_nasabah_pasangan',$data,$where);
		$queryPenjamin = $this->business->update_data('los_calon_nasabah_penjamin',$data,$where);

		if ($queryCNasabah AND $queryPasangan AND $queryPenjamin) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}

	}

	public function get_detail_calon_nasabah($value='')
	{
		$id_calon_debitur = $this->uri->segment(3);
		$query = $this->business->get_calon_nasabah($id_calon_debitur)->result();
		$lengh = $this->business->get_calon_nasabah($id_calon_debitur)->num_rows();
		if ($lengh > 0) {
			echo json_encode($query);
		}else{
			echo json_encode(array('msg' => 'Data tidak ditemukan'));
		}
	}

	public function get_detail_pasangan($value='')
	{
		$id_calon_debitur = $this->uri->segment(3);
		$query = $this->business->get_pasangan($id_calon_debitur)->result();
		$lengh = $this->business->get_pasangan($id_calon_debitur)->num_rows();
		if ($lengh > 0) {
			echo json_encode($query);
		}else{
			echo json_encode(array('msg' => 'Data tidak ditemukan'));
		}
	}

	public function get_detail_penjamin($value='')
	{
		$id_calon_debitur = $this->uri->segment(3);
		$query = $this->business->get_penjamin($id_calon_debitur)->result();
		$lengh = $this->business->get_penjamin($id_calon_debitur)->num_rows();
		if ($lengh > 0) {
			echo json_encode($query);
		}else{
			echo json_encode(array('msg' => 'Data tidak ditemukan'));
		}
	}

	public function delete_nasabah($value='')
	{
		$id = $this->uri->segment(3);
		//echo $id;
		$where = array('id_calon_debitur' => $id);
		$query = $this->business->delete_data('los_calon_nasabah',$where);
		if ($query) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}
	/*-------------------*/
	/*APLIAKSI ORDER*/

	public function sumberAplikasi($value='')
	{
		$data = $this->business->get('kre_kode_group4',null)->result();
		echo json_encode($data);
	}

	public function jenisPinjaman($value='')
	{
		$data = $this->business->get('los_jenis_pinjaman',null)->result();
		echo json_encode($data);
	}

	public function NasabahReadyOrder()
	{
		$where = array('verifikasi' => 1, 'create_by' => $this->session->userdata('id'));
		$data = $this->business->get_where('los_calon_nasabah','id_calon_debitur','DESC',$where)->result();
		$hit = $this->business->get_where('los_calon_nasabah','id_calon_debitur','DESC',$where)->num_rows();
		if ($hit == 0) {
			echo json_encode(array('amount' => $hit));
		}else{
			echo json_encode($data);
		}
	}

	public function get_order($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'manager' || $jabatan == 'ketua') {
			$ao = null;
		}else{
			$ao = $this->session->userdata('id');
		}
		$data = $this->business->get_order($areakerja,$startlimit,$keysearch,$ao)->result();
		$lengh = $this->business->get_order($areakerja,$startlimit,$keysearch,$ao)->num_rows();
		if ($lengh > 0) {
			echo json_encode($data);
		}else{
			echo json_encode(array('amount' => $lengh));
		}
	}

	public function seacrhOrder($value='')
	{
		$keysearch = $this->input->post('keyword');
		$startlimit = 0;
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$areakerja = 'semua';
			$ao = null;
		}else if($jabatan == 'manager') {
			$areakerja = $this->session->userdata('kantor');
			$ao = null;
		}else{
			$areakerja = $this->session->userdata('kantor');
			$ao = $this->session->userdata('id');
		}

		$data = $this->business->get_order($areakerja,$startlimit,$keysearch,$ao)->result();
		$hit = $this->business->get_order($areakerja,$startlimit,$keysearch,$ao)->num_rows();
		if ($hit == 0) {
			echo json_encode(array('amount' => $hit));
		}else{
			echo json_encode($data);
		}
	}

	public function get_detail_order($value='')
	{
		$id = $this->uri->segment(3);
		$query = $this->business->get_detail_order($id)->result();
		$lengh = $this->business->get_detail_order($id)->num_rows();
		if ($lengh > 0) {
			echo json_encode($query);
		}else{
			echo json_encode(array('amount' => $lengh));
		}
	}

	public function add_data_order($value='')
	{
		$jumfile = count($_FILES['lampiran']['name']);
		$upload =  $this->MultiUpload($jumfile,'lampiran','./assets/lampiran','LAMP_');
		$dataFile = json_encode(array('file' => $upload));
        $data = array(
        	'kode_ao' => $this->input->post('ao'),
        	'kode_mitra' => 1, // belum dinamis
        	'id_calon_debitur' => $this->input->post('id_calon_debitur'),
			'plafond' => str_replace(".","",$this->input->post('plafond')),
			'tenor' => $this->input->post('tenor'),
			'jenis_pinjaman' => $this->input->post('jenis_pinjaman'),
			'tujuan_penggunaan' => $this->input->post('tujuan_penggunaan'),
			'cara_pembayaran' => $this->input->post('cara_pembayaran'),
			'jenis_jaminan' => $this->input->post('jenis_jaminan'),
			'file_lampiran' => $dataFile,
			'ket_jaminan' => $this->input->post('ket_jaminan'),
			'sumber_aplikasi' => $this->input->post('sumber_aplikasi'),
			'verifikasi' => 1,
			'verifikasi_by' => $this->session->userdata('id'),
			'verifikasi_date' => date('Y-m-d H:i:s'),
			'keterangan' => $this->input->post('keterangan'),
			'kode_kantor' => $this->input->post('kantor'),
			'status_assign' => 'ON PROGRESS',
			'tgl_assign' => date('Y-m-d H:i:s'),
			'keterangan_assign' => 'Order On Progress'
		);

        $query = $this->business->add_data('los_order',$data);

		//GET DATA TO EMAIL
        $where = array('los_calon_nasabah.id_calon_debitur' => $this->input->post('id_calon_debitur'));
		$dataToemail = $this->db->select('*,kre_kode_group2.deskripsi_group2 AS AO_ORDER')
								->from('los_calon_nasabah')
								->join('los_order','los_calon_nasabah.id_calon_debitur = los_order.id_calon_debitur')
								->join('kre_kode_group2','los_order.kode_ao = kre_kode_group2.KODE_GROUP2')
								->where($where)
								->get()
								->row();

       	$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, yusufdroider@gmail.com'; //TOKREDITCHECKING
       	$subject = 'KREDIT CHECKING';
       	$plafond = number_format($dataToemail->plafond, 2, ".", ".");
       	$message = "
	    <div style='padding:2%;background-color:white;'>
		<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
		</div>
		<br>
		<center><h2 style='font-family: arial;'>DATA KREDIT CHECKING MASUK </h2></center>
		<p style='font-family: verdana'>Data calon debitur yang terlampir di bawah ini siap untuk kredit checking, </p>
		<p>MARKETING : $dataToemail->AO_ORDER</p>
		<p>Nama Calon debitur : $dataToemail->nama_lengkap</p>
		<p>NIK : $dataToemail->no_ktp</p>
		<p>plafond : Rp. $plafond - $dataToemail->tenor Bulan</p>
		<br><br><br><br><br>
		<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
			<center>
				<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
				<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
			</center>
		</div>
	    ";
	    $this->sendEmail($toemail,$subject,$message);

        if ($query == TRUE) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function edit_data_order($id_order)
	{
		$where = array('id' => $id_order);
		$where2 = array('id_order' => $id_order);
		$data = array(
	    	'kode_ao' => $this->input->post('ao'),
	    	'kode_mitra' => 1, // belum dinamis
	    	'id_calon_debitur' => $this->input->post('id_calon_debitur'),
			'plafond' => str_replace(".","",$this->input->post('plafond')),
			'tenor' => $this->input->post('tenor'),
			'jenis_pinjaman' => $this->input->post('jenis_pinjaman'),
			'tujuan_penggunaan' => $this->input->post('tujuan_penggunaan'),
			'cara_pembayaran' => $this->input->post('cara_pembayaran'),
			'ket_jaminan' => $this->input->post('ket_jaminan'),
			'sumber_aplikasi' => $this->input->post('sumber_aplikasi'),
			'keterangan' => $this->input->post('keterangan'),
			'kode_kantor' => $this->input->post('kantor'),
		);

		$data_ao = array(
			'plafon_kredit' => str_replace(".","",$this->input->post('plafond')),
			'jangka_waktu' => $this->input->post('tenor')
		);

		$data_ca = array(
			'realisasi' => str_replace(".","",$this->input->post('plafond')),
			'tenor' => $this->input->post('tenor')
		);

		$this->business->update_data('los_memo_kredit_ao',$data_ao,$where2);
		$this->business->update_data('los_memo_kredit_ca_lain_lain',$data_ca,$where2);
		$queryeditorder = $this->business->update_data('los_order',$data,$where);

		if ($queryeditorder) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function edit_lampiran_order($id_order)
	{
		$where = array('id' => $id_order);
		$jumfile = count($_FILES['lampiran']['name']);
		$upload =  $this->MultiUpload($jumfile,'lampiran','./assets/lampiran','LAMP_');
		$dataFile = json_encode(array('file' => $upload));
    	$data = array(
			'file_lampiran' => $dataFile
		);
		$querylampiranorder = $this->business->update_data('los_order',$data,$where);

		if ($querylampiranorder) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function verifikasiOrder($value='')
	{
		$id = $this->uri->segment(3);
		$where = array('id' => $id);

		$data = array(
			'verifikasi' => 1,
			'verifikasi_by' => $this->session->userdata('id'),
			'verifikasi_date' => date('Y-m-d H:i:s')
		);

		$queryVerifOrder = $this->business->update_data('los_order',$data,$where);

		if ($queryVerifOrder) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function delete_order($id_order)
	{
		$where = array('id' => $id_order);
		$ambilLampiran = $this->db->select('file_lampiran')->from('los_order')->where($where)->get()->row();
		/*for ($i=0; $i <= count($ambilLampiran->file_lampiran); $i++) { 
			echo $ambilLampiran->file_lampiran[$i];
		}*/
		echo $ambilLampiran->file_lampiran;
	}

	/*TRACKING ORDER*/

	public function OrderTracking($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'manager' || $jabatan == 'ketua') {
			$ao = null;
		}else{
			$ao = $this->session->userdata('id');
		}
		$query = $this->business->DataTrackingOrder($startlimit,$areakerja,$keysearch,$ao)->result();
		$lengh = $this->business->DataTrackingOrder($startlimit,$areakerja,$keysearch,$ao)->num_rows();
		if ($lengh > 0) {
			echo json_encode($query);
		}else{
			echo json_encode(array('amount' => $lengh));
		}
	}

	public function SearchOrderTracking($value='')
	{
		$startlimit = 0;
		$keysearch = $this->input->post('keyword');
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$areakerja = 'semua';
			$ao = null;
		}else if($jabatan == 'manager') {
			$areakerja = $this->session->userdata('kantor');
			$ao = null;
		}else{
			$areakerja = $this->session->userdata('kantor');
			$ao = $this->session->userdata('id');
		}
		$query = $this->business->DataTrackingOrder($startlimit,$areakerja,$keysearch,$ao)->result();
		$lengh = $this->business->DataTrackingOrder($startlimit,$areakerja,$keysearch,$ao)->num_rows();
		if ($lengh > 0) {
			echo json_encode($query);
		}else{
			echo json_encode(array('amount' => $lengh));
		}
	}

	public function getTrackingOrder($value='')
	{
		$id = $this->uri->segment(3);
		$query = $this->business->getTrackingOrder($id)->result();
		$lengh = $this->business->getTrackingOrder($id)->num_rows();

		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($query);
		}

	}

	/*---------------------*/
	/*KREDIT CHECKING*/

	public function OrderReady($value='')
	{
		$data = $this->business->OrderReady()->result();
		$lengh = $this->business->OrderReady()->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function checkOrderInKredit($value='')
	{
		$id_order = $this->uri->segment(3);
		$id_calon_debitur = $this->uri->segment(4);
		$where = array('id_order' => $id_order,'id_calon_debitur' => $id_calon_debitur);
		$data = $this->business->get_where('los_kredit_checking',null,null,$where)->num_rows();
		echo json_encode(array('amount' => $data));
	}

	public function get_dataKreditcheck($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$data = $this->business->get_dataKreditcheck($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->get_dataKreditcheck($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function seacrhKredit($value='')
	{
		$startlimit = 0;
		$areakerja = $this->input->post('areakerja');
		$keysearch = $this->input->post('keyword');
		$data = $this->business->get_dataKreditcheck($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->get_dataKreditcheck($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_detailKreditcheck($value='')
	{
		$id = $this->uri->segment(3);
		$data = $this->business->getDetailKreditChecking($id)->result();
		$lengh = $this->business->getDetailKreditChecking($id)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function verifikasiKredit($value='')
	{
		$id = $this->input->post('id_kredit_check');
		$id_order = $this->input->post('id_order');
		$ao_to_email = $this->input->post('ao_to_email');
		$name_to_email = $this->input->post('name_to_email');
		$nik_to_email = $this->input->post('nik_to_email');
		$plafond_to_email = $this->input->post('plafond_to_email');
		$where = array('id' => $id);
		//echo $nik_to_email;die();
		$data = array(
			'verifikasi' => 1,
			'verifikasi_by' => $this->session->userdata('id'),
			'verifikasi_date' => date('Y-m-d H:i:s')
		);

		$queryVerifKredti = $this->business->update_data('los_kredit_checking',$data,$where);

		$whereTrack = array('id_order' => $id_order);
		$dataTracking = array(
			'desc_credit_checking' => 'Kredit Checking Sudah Selesai',
			'create_date_credit_checking' => date('Y-m-d H:i:s'),
			'status_credit_checking' => 2,
			'desc_survey' => 'Proses Survey Komite',
			'create_date_survey' => date('Y-m-d H:i:s'),
			'status_survey' => 1,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);

		if ($queryVerifKredti) {
			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}
	       	$subject = 'KREDIT CHECKING TELAH DISETUJUI';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA KREDIT CHECKING DISETUJUI </h2></center>

			<p style='font-family: verdana'>Data calon debitur yang terlampir di bawah ini telah di setujui untuk proses survey, </p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";

		    $this->sendEmail($toemail,$subject,$message);
		    $toemail = 'adisuyadi.kdpms@gmail.com, heinrichricky@gmail.com';// TO MANAGER OR KETUA
	       	$subject = 'DATA SURVEY';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA SURVEY </h2></center>

			<p style='font-family: verdana'>Data calon debitur yang terlampir di bawah ini telah di setujui di kredit checking untuk lanjut ke proses survey, lakukan survey sekarang. </p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
		    $this->sendEmail($toemail,$subject,$message);
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function TolakKredit($value='')
	{
		$id = $this->input->post('id_kredit_check');
		$id_order = $this->input->post('id_order');
		$alasan = $this->input->post('alasan');
		$where = array('id' => $id);

		$data = array(
			'verifikasi' => 2,
			'verifikasi_by' => $this->session->userdata('id'),
			'verifikasi_date' => date('Y-m-d H:i:s')
		);

		$queryVerifKredti = $this->business->update_data('los_kredit_checking',$data,$where);

		$whereTrack = array('id_order' => $id_order);
		$dataTracking = array(
			'desc_credit_checking' => 'Kredit Checking DI TOLAK <br> <b>Alasan Penolakan </b>: '.$alasan,
			'create_date_credit_checking' => date('Y-m-d H:i:s'),
			'status_credit_checking' => 3,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);


		$dataToemail = $this->db->select('los_cn.nama_lengkap,los_cn.no_ktp,los_or.plafond,los_or.tenor,kre_kg2.deskripsi_group2 AS AO_ORDER')
								->from('los_order AS los_or')
								->join('los_calon_nasabah AS los_cn', 'los_or.id_calon_debitur = los_cn.id_calon_debitur')
								->join('kre_kode_group2 AS kre_kg2', 'los_or.kode_ao = kre_kg2.KODE_GROUP2')
								->where(array('los_or.id' => $id_order))
								->get()->row();

		if ($dataToemail->AO_ORDER == 'Kantor') {
			$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'Adi suyadi') {
			$toemail = 'adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'Budiawan') {
			$toemail = 'budiawan.kdpms@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'Rediana Saputra') {
			$toemail = 'redianasaputra4@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'M.Yakub') {
			$toemail = 'mu.yakub99@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'Lukman') {
			$toemail = 'lukmanubay16@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'Putra Nia') {
			$toemail = 'putrania1972@gmail.com';//TO AO
		}else if ($dataToemail->AO_ORDER == 'Amirudin') {
			$toemail = 'muhamadamirudin78@gmail.com';//TO AO
		}

       	$subject = 'PENOLAKAN KREDIT CHECKING';
       	$message = "
	    <div style='padding:2%;background-color:white;'>
		<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
		</div>
		<br>
		<center><h2 style='font-family: arial;'>DATA KREDIT CHECKING DITOLAK </h2></center>
		<p style='font-family: verdana'>Mohon maaf untuk data kredit checking ini kami tolak karena data tidak masuk kriteria, silahkan konfirmasi pihak Atasan.</p></center>
		<p>MARKETING : $dataToemail->AO_ORDER</p>
		<p>Nama Calon debitur : $dataToemail->nama_lengkap</p>
		<p>NIK : $dataToemail->no_ktp</p>
		<p>plafond : Rp. $dataToemail->plafond - $dataToemail->tenor Bulan</p>
		<p>Alasan penolakan : $alasan</p>
		<br><br><br><br><br>
		<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
			<center>
				<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
				<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
			</center>
		</div>
	    ";
	    if ($this->sendEmail($toemail,$subject,$message)) {
	    	if ($queryVerifKredti) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
	    }else{
	    	if ($queryVerifKredti) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
	    }
		
	}

	public function delete_kredit($value='')
	{
		$id = $this->uri->segment(3);
		//echo $id;
		$query = "SELECT lampiran FROM los_kredit_checking WHERE id = ".$id;
		$query = $this->db->query($query)->row();
		$json = json_decode($query->lampiran,true);

		/*$where = array('id' => $id);
		$query = $this->business->delete_data('los_kredit_checking',$where);
		if ($query == TRUE) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}*/
	}


	public function saveeditnoktp_fromkreditceking($id_calon_debitur)
	{
		$where = array('id_calon_debitur' => $id_calon_debitur);

		$data = array('no_ktp' => $this->input->post('new_no_ktp_from_kc'));

		$mood = $this->business->update_data('los_calon_nasabah',$data,$where);

		if ($mood) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function saveeditnamalengkap_fromkreditceking($id_calon_debitur)
	{
		$where = array('id_calon_debitur' => $id_calon_debitur);

		$data = array('nama_lengkap' => $this->input->post('new_nama_lengkap'));

		$mood = $this->business->update_data('los_calon_nasabah',$data,$where);

		if ($mood) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}


	public function saveeditalamat_fromkreditceking($id_calon_debitur)
	{
		$where = array('id_calon_debitur' => $id_calon_debitur);

		$data = array(
			'alamat' => $this->input->post('alamat_cn'),
			'propinsi_id' => $this->input->post('propinsi_cn'),
			'kotakab_id' => $this->input->post('kabkota_cn'),
			'kecamatan_id' => $this->input->post('kecamatan_cn'),
			'kelurahan_id' => $this->input->post('kelurahan_cn'),
			'rt' => $this->input->post('rt_cn'),
			'rw' => $this->input->post('rw_cn')
		);

		$mood = $this->business->update_data('los_calon_nasabah',$data,$where);

		if ($mood) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function add_kreditCheck($value='')
	{
		$jenis_debitur = $this->input->post('jenis_debitur');
		$kode_kantor = $this->session->userdata('kantor');
		$kode_ao = $this->input->post('ao');
		$status = $this->input->post('status');
		$notes = $this->input->post('notes');

		$ao_to_email = $this->input->post('ao_to_email');
		$name_to_email = $this->input->post('name_to_email');
		$nik_to_email = $this->input->post('nik_to_email');
		$plafond_to_email = $this->input->post('plafond_to_email');

		$tanggalTahun = date('Y-m-d');
		$split 		  = explode('-',$tanggalTahun);
		$tahun 		  = $split[0];
		$kantor  	  = $this->session->userdata('kantor');

		$jumdatalast = $this->business->getNOKreditLastData()->num_rows();
		if ($jumdatalast > 0) {
			$Nolast 	 = $this->business->getNOKreditLastData()->row();
			$tahunData	 = explode('-',$Nolast->verifikasi_date)[0];
			$NolastApk   = explode('/',$Nolast->nomor)[2];

			if ($tahunData != $tahunData) {
				$nofix = '0001';
			}else if ($tahunData == $tahunData) {
				$no = $NolastApk + 1;
				$nodef = '10000';
				$nosub = $nodef + $no;
				$nofix = substr($nosub,1,7);
			}else{
				echo "ada yang ga beress";die();
			}
		}else{
			$nofix = '0001';
		}

		$nomor 		  = 'KRDTCHKNG/'.$tahun.'/'.$nofix;

		//$jumfile = count($_FILES['files']['name']);

		if ($status == 'ON PROGRESS') {
			$dataKreditChecking = array(
	    		'id' => null,
	    		'id_order' => $this->input->post('id_order'),
	    		'id_calon_debitur' => $this->input->post('id_calon_debitur'),
	    		'jenis_debitur' => $jenis_debitur,
	    		'nomor' => $nomor,
	    		'kode_kantor' => $kantor,
	    		'kode_ao' => $kode_ao,
	    		'root_server' => null,
	    		'status' => $status,
	    		'proses_by' => $this->session->userdata('id'),
	    		'proses_date' => date('Y-m-d H:i:s'),
	    		'folder_master' => null,
	    		'lampiran' => null,
	    		'notes' => $notes,
	    		'lampiran_result' => null,
	    		'notes_result' => null,
	    		'verifikasi' => 0,
	    		'verifikasi_by' => null,
	    		'verifikasi_date' => date('Y-m-d H:i:s'),
	        );

	        $query = $this->business->add_data('los_kredit_checking',$dataKreditChecking);
			if ($query) {
				echo json_encode(array('msg' => 'success'));
			}else{
				echo json_encode(array('msg' => 'failed'));
			}
		}else if ($status == 'DONE') {
			//$upload = $this->MultiUpload($jumfile,'files','./assets/lampiran_kreditChecking','KREDITCHECKING_');

	        //$dataFile = json_encode(array('file' => $upload));

	        $dataKreditChecking = array(
	    		'id' => null,
	    		'id_order' => $this->input->post('id_order'),
	    		'id_calon_debitur' => $this->input->post('id_calon_debitur'),
	    		'jenis_debitur' => $jenis_debitur,
	    		'nomor' => $nomor,
	    		'kode_kantor' => $kantor,
	    		'kode_ao' => $kode_ao,
	    		'root_server' => null,
	    		'status' => $status,
	    		'proses_by' => $this->session->userdata('id'),
	    		'proses_date' => date('Y-m-d H:i:s'),
	    		'folder_master' => null,
	    		'lampiran' => /*$dataFile*/null,
	    		'notes' => $notes,
	    		'lampiran_result' => null,
	    		'notes_result' => null,
	    		'verifikasi' => 0,
	    		'verifikasi_by' => null,
	    		'verifikasi_date' => date('Y-m-d H:i:s'),
	        );

	        $dataToemail = $this->db->select('los_calon_nasabah.kode_kantor')->from('los_calon_nasabah')->join('los_order','los_calon_nasabah.id_calon_debitur = los_order.id_calon_debitur')->where(array('los_order.id' => $this->input->post('id_order')))->get()->row();

	        if ($dataToemail->kode_kantor == '01') {
		        $toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';// TO MANAGER OR KETUA
	        }else if ($dataToemail->kode_kantor == '02') {
		        $toemail = 'arsyandi.ridho@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';// TO MANAGER OR KETUA
	        }
	       	$subject = 'DATA KREDIT CHECKING';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA SURVEY </h2></center>

			<p style='font-family: verdana'>Data calon debitur yang terlampir di bawah ini telah di kreditchecking, lakukan verifikasi kreditchecking.</p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
		    $this->sendEmail($toemail,$subject,$message);

	        $query = $this->business->add_data('los_kredit_checking',$dataKreditChecking);

			if ($query) {
				echo json_encode(array('msg' => 'success'));
			}else{
				echo json_encode(array('msg' => 'failed'));
			}
		}else{
			echo "Ada yang ga beres";
		}

	}

	public function MultiUpload($jumfile,$nameFile,$locFile,$fileNameFormat) //Params Butuh nilai: Jumlah file, name inputan file, lokasi upload './assets/lampiran_kreditChecking'
	{
		$dataFile = array();
		for($i = 0; $i < $jumfile; $i++){
	        $_FILES['file']['name']     = $_FILES[$nameFile]['name'][$i];
	        $_FILES['file']['type']     = $_FILES[$nameFile]['type'][$i];
	        $_FILES['file']['tmp_name'] = $_FILES[$nameFile]['tmp_name'][$i];
	        $_FILES['file']['error']     = $_FILES[$nameFile]['error'][$i];
	        $_FILES['file']['size']     = $_FILES[$nameFile]['size'][$i];

	        $file 			= $_FILES[$nameFile]['name'][$i];
			$pisah 			= explode(".",$file);
			$ext 			= end($pisah);
			$rename 		= date("YmdHis");
			$nama_file 		= $rename.".".$ext;

			$config['upload_path']	 = $locFile;
	        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
			$config['file_name']  	 = $fileNameFormat.$nama_file;

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if($this->upload->do_upload('file')){
	            $data = array('upload_data' => $this->upload->data());
	            $namaFile = $data['upload_data']['file_name'];
	            array_push($dataFile,$namaFile);
	        }else{
	        	echo json_encode(array('msg' => 'gagal upload'));
	    		die();
	        }
	    }

	    return $dataFile;
	}

	public function save_edit_kredit($value='')
	{
		$id = $this->input->post('id');
		$status = $this->input->post('status');
		$notes = $this->input->post('notes');

		$where = array('id' => $id);

		if ($status == 'ON PROGRESS') {
			$data = array(
				'status' => $status,
				'notes' => $notes
			);

			$query = $this->business->update_data('los_kredit_checking',$data,$where);
		}else if ($status == 'DONE') {
			//$jumfile = count($_FILES['files']['name']);
			//$upload = $this->MultiUpload($jumfile,'files','./assets/lampiran_kreditChecking','KREDITCHECKING_');
	        //$dataFile = json_encode(array('file' => $upload));
			$ao_to_email = $this->input->post('ao_to_email');
			$name_to_email = $this->input->post('name_to_email');
			$nik_to_email = $this->input->post('nik_to_email');
			$plafond_to_email = $this->input->post('plafond_to_email');

			$toemail = 'fahmidion1@gmail.com, arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com ';// TO MANAGER OR KETUA
	       	$subject = 'DATA KREDIT CHECKING';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA SURVEY </h2></center>

			<p style='font-family: verdana'>Data calon debitur yang terlampir di bawah ini telah di kreditchecking, lakukan verifikasi kreditchecking.</p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
		    $this->sendEmail($toemail,$subject,$message);
	        $data = array(
				'status' => $status,
				'lampiran' => /*$dataFile*/null,
				'notes' => $notes
			);

			$query = $this->business->update_data('los_kredit_checking',$data,$where);
		}else{
			echo "ga beres";die();
		}

		if ($query == TRUE) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}

	}

	/*SURVEY KOMITE*/
	public function SurveyKomite($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$data = $this->business->SurveyKomite($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->SurveyKomite($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function searchSurveyKomite($value='')
	{
		$startlimit = 0;
		$areakerja = $this->input->post('areakerja');
		$keysearch = $this->input->post('keyword');
		$data = $this->business->SurveyKomite($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->SurveyKomite($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function Act_PendingSurvey()
	{
		$id_kredit_checking = $this->input->post('id_kredit_check');
		$id_order = $this->input->post('id_order');
		$ao_to_email = $this->input->post('ao_to_email');
		$name_to_email = $this->input->post('name_to_email');
		$nik_to_email = $this->input->post('nik_to_email');
		$plafond_to_email = $this->input->post('plafond_to_email');

		$where = array('id' => $id_kredit_checking);
		$data = array(
			'flg_survey' => 1,
		);
		$querySudahSurvey = $this->business->update_data('los_kredit_checking',$data,$where);

		if ($querySudahSurvey) {
			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}
	       	$subject = 'SURVEY DI PENDING';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA SURVEY DI PEMDING </h2></center>

			<p style='font-family: verdana'>Data Calon nasabah ini di pending dalam proses survey</p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
		    $this->sendEmail($toemail,$subject,$message);
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function Act_SudahSurvey()
	{
		$id_kredit_checking = $this->input->post('id_kredit_check');
		$id_order = $this->input->post('id_order');
		$ao_to_email = $this->input->post('ao_to_email');
		$name_to_email = $this->input->post('name_to_email');
		$nik_to_email = $this->input->post('nik_to_email');
		$plafond_to_email = $this->input->post('plafond_to_email');

		$where = array('id' => $id_kredit_checking);
		$data = array(
			'flg_survey' => 2,
		);
		$querySudahSurvey = $this->business->update_data('los_kredit_checking',$data,$where);

		$whereTrack = array('id_order' => $id_order);
		$dataTracking = array(
			'desc_survey' => 'Nasabah sudah disurvey dan di setujui',
			'create_date_survey' => date('Y-m-d H:i:s'),
			'status_survey' => 2,
			'desc_memo_ao' => 'Proses Memo Ao',
			'create_date_memo_ao' => date('Y-m-d H:i:s'),
			'status_memo_ao' => 1,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);
		if ($querySudahSurvey) {
			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}
	       	$subject = 'DATA SURVEY DI SETUJUI';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA SURVEY DI SETUJUI </h2></center>

			<p style='font-family: verdana'>Data Calon nasabah telah disurvey dan disetujui, silahkan lanjutkan pengisian memo ao</p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
		    $this->sendEmail($toemail,$subject,$message);
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function changeFlgSurvey()
	{
		$this->business->update_data('los_kredit_checking',array('flg_survey' => 2),array('flg_survey' => 1));
		echo 'done ya qmack';
	}

	public function Act_TolakSurvey()
	{
		$id_kredit_checking = $this->input->post('id_kredit_check');
		$id_order = $this->input->post('id_order');
		$ao_to_email = $this->input->post('ao_to_email');
		$name_to_email = $this->input->post('name_to_email');
		$nik_to_email = $this->input->post('nik_to_email');
		$plafond_to_email = $this->input->post('plafond_to_email');
		$alasan = $this->input->post('alasan');

		$where = array('id' => $id_kredit_checking);

		$data = array(
			'flg_survey' => 3,
		);
		$querySudahSurvey = $this->business->update_data('los_kredit_checking',$data,$where);

		$whereTrack = array('id_order' => $id_order);
		$dataTracking = array(
			'desc_survey' => 'Nasabah sudah DI TOLAK <br> <b>Alasan Penolakan </b>: '.$alasan,
			'create_date_survey' => date('Y-m-d H:i:s'),
			'status_survey' => 3,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);
		if ($querySudahSurvey) {
			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com';//TO AO
			}
	       	$subject = 'DATA SURVEY DI TOLAK';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA SURVEY DI TOLAK </h2></center>

			<p style='font-family: verdana'>Data Calon nasabah telah disurvey dan ditolak, tidak bisa di proses ke tahap selanjutnya, silahkan hubungi atasan.</p></center>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<p>Alasan penolakan : $alasan</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
		    $this->sendEmail($toemail,$subject,$message);
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	/*MEMO KREDIT AO*/
	public function SurveyKomiteAo($value='')
	{
		$ao = $this->session->userdata('id');
		$data = $this->business->SurveyReadyMemoAo($ao)->result();
		$lengh = $this->business->SurveyReadyMemoAo($ao)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function checkOrderInMemoAo($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ao',null,null,$where)->num_rows();
		echo json_encode(array('amount' => $data));
	}

	public function get_dataMemoAo($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'manager' || $jabatan == 'ketua') {
			$ao = null;
		}else{
			$ao = $this->session->userdata('id');
		}
		$data = $this->business->get_dataMemoAo($startlimit,$areakerja,$keysearch,$ao)->result();
		$lengh = $this->business->get_dataMemoAo($startlimit,$areakerja,$keysearch,$ao)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function searchAo($value='')
	{
		$startlimit = 0;
		$keysearch = $this->input->post('keyword');
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$areakerja = 'semua';
			$ao = null;
		}else if($jabatan == 'manager') {
			$areakerja = $this->session->userdata('kantor');
			$ao = null;
		}else{
			$areakerja = $this->session->userdata('kantor');
			$ao = $this->session->userdata('id');
		}
		$data = $this->business->get_dataMemoAo($startlimit,$areakerja,$keysearch,$ao)->result();
		$lengh = $this->business->get_dataMemoAo($startlimit,$areakerja,$keysearch,$ao)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function Produk($value='')
	{
		$data = $this->business->get('tab_produk',null)->result();
		echo json_encode($data);
	}

	public function merkKendaraan($value='')
	{
		$data = $this->business->get('merk_kendaraan','nm_merk')->result();
		echo json_encode($data);
	}

	public function typeKendaraan($value='')
	{
		$data = $this->business->get('type_kendaraan',null)->result();
		echo json_encode($data);
	}

	public function jenisKendaraan($value='')
	{
		$data = $this->business->get('jenis_kendaraan',null)->result();
		echo json_encode($data);
	}


	public function saveAddMemoAo($value='')
	{
		$tanggalTahun = date('Y-m-d');
		$split 		  = explode('-',$tanggalTahun);
		$bulan 		  = $split[1];
		$tahun 		  = $split[0];
		$bulanRomawi  = $this->getBulanRomawi($bulan);
		$nokantor 	  = $this->session->userdata('kantor');

		$jumdatalast = $this->business->getNOMemoAoLastData()->num_rows();
		if ($jumdatalast > 0) {
			$Nolast 	 = $this->business->getNOMemoAoLastData()->row();
			$tahunData	 = explode('-',$Nolast->create_date)[0];
			$NolastApk   = explode('/',$Nolast->no_aplikasi)[4];
			if ($tahunData != $tahun) {
				$nofix = '000001';
			}else if ($tahunData == $tahunData) {
				$no = $NolastApk + 1;
				$nodef = '1000000';
				$nosub = $nodef + $no;
				$nofix = substr($nosub,1,7);
			}else{
				echo "ada yang ga beress";die();
			}
		}else{
			$nofix = '000001';
		}

		$no_aplikasi  = $nokantor.'/DPM/'.$bulanRomawi.'/'.$tahun.'/'.$nofix;

		$angunan = $this->input->post('angunan');
		$dataMemoAo = array(
			'id_order' => $this->input->post('id_order'),
			'id_calon_debitur' => $this->input->post('id_calon_debitur'),
			'id_kredit_checking' => $this->input->post('id_kredit_checking'),
			'no_aplikasi' => $no_aplikasi,
			'jaminan_utama' => $this->input->post('jaminan_utama'),
			'sumber_informasi' => $this->input->post('sumber_informasi'),
			'tujuan_kredit' => $this->input->post('tujuan_kredit'),
			'type_kredit' => $this->input->post('type_kredit'),
			'jenis_fasilitas' => $this->input->post('jenis_fasilitas'),
			'kode_produk' => $this->input->post('kode_produk'),
			'plafon_kredit' => $this->input->post('plafond'),
			'jangka_waktu' => $this->input->post('jangka_waktu'),
			'suku_bunga' => str_replace(".","",$this->input->post('suku_bunga')),
			'akad_kredit' => $this->input->post('akad_kredit'),
			'akad_jaminan' => $this->input->post('akad_jaminan'),
			'gaji_debitur' => str_replace(".","",$this->input->post('gaji_debitur')),
			'gaji_pasangan' => str_replace(".","",$this->input->post('gaji_pasangan')),
			'gaji_penjamin' => str_replace(".","",$this->input->post('gaji_penjamin')),
			'pengeluaran_rumah_tangga' => str_replace(".","",$this->input->post('pengeluaran_rumah_tangga')),
			'pengeluaran_transportasi' => str_replace(".","",$this->input->post('pengeluaran_transport')),
			'pengeluaran_pendidikan' => str_replace(".","",$this->input->post('pengeluaran_pendidikan')),
			'pengeluaran_lainya' => str_replace(".","",$this->input->post('pengeluaran_lainnya')),
			'angsuran_lain' => str_replace(".","",$this->input->post('angsuran_lain')),
			'angsuran_kdpms' => str_replace(".","",$this->input->post('angsuran_kdpms')),
			'pendapatan_lainnya' => str_replace(".","",$this->input->post('pendapatan_lainnya')),
			'hasil_cek_lingkungan' => $this->input->post('hasil_cek_lingkungan'),
			'vertifikasi_data_debitur' => $this->input->post('verifikasi_data_debitur'),
			'ket_calon_debitur' => $this->input->post('ket_calon_debitur'),
			/*'realisasi' => $this->input->post('realisasi'),
			'tenor' => $this->input->post('tenor'),*/
			'nama_anak' => $this->input->post('nama_anak'),
			'nama_sekolah_anak' => $this->input->post('nama_sekolah'),
			'alamat_sekolah_anak' => $this->input->post('alamat_sekolah_anak'),
			'verifikasi' => 1,
			'verifikasi_by' => $this->session->userdata('id'),
			'verifikasi_date' => date('Y-m-d H:i:s'),
			'create_date'=> date('Y-m-d H:i:s'),
			'create_by'=> $this->session->userdata('id'),
			'last_update'=> null,
			'update_by'=> null,
		);

		$dataAoSertifikat = array(
			'id_order' => $this->input->post('id_order'),
			'lokasi' => $this->input->post('lokasi'),
			'kepemilikan' => $this->input->post('kepemilikan'),
			'penggunaan' => $this->input->post('penggunaan'),
			'no_sertifikat' => $this->input->post('no_sertifikat'),
			'tgl_sertifikat' => $this->input->post('tgl_sertifikat'),
			'tgl_surat_ukur' => $this->input->post('tgl_surat_ukur'),
			'no_surat_ukur' => $this->input->post('no_surat_ukur'),
			'jenis_sertifikat' => $this->input->post('jenis_sertifikat'),
			// 'no_shm' => $this->input->post('no_shm'),
			'no_ajb' => $this->input->post('no_ajb'),
			'masa_berlaku_shgb' => $this->input->post('masa_berlaku_shgb'),
			'masa_berlaku_shmrs' => $this->input->post('masa_berlaku_shmrs'),
			'tgl_ajb' => $this->input->post('tgl_ajb'),
			'atas_nama' => $this->input->post('atas_nama'),
			'alamat' => $this->input->post('alamat'),
			'luas_tanah' => $this->input->post('luas_tanah'),
			'luas_bangunan' => $this->input->post('luas_bangunan'),
			'kondisi_bangunan' => $this->input->post('kondisi_bangunan'),
			'imb' => $this->input->post('imb'),
			'legalitas' => $this->input->post('legalitas'),
			'catatan_lainnya' => $this->input->post('catatan_lainnya'),
			/*'nilai_taksasi' => $this->input->post('nilai_taksasi'),
			'nilai_njop' => $this->input->post('nilai_njop'),
			'tgl_taksasi' => $this->input->post('tgl_taksasi')*/
		);

		$dataAoKendaraan = array(
			'id_order' => $this->input->post('id_order'),
			'kd_merk' => $this->input->post('kd_merk_kendaraan'),
			'kd_type' => $this->input->post('kd_type_kendaraan'),
			'kd_jenis' => $this->input->post('kd_jenis_kendaraan'),
			'kepemilikan' => $this->input->post('kepemilikan_kendaraan'),
			'penggunaan' => $this->input->post('penggunaan_kendaraan'),
			'atas_nama' => $this->input->post('atas_nama_kendaraan'),
			'alamat_bpkb' => $this->input->post('alamat_bpkb_kendaraan'),
			'kecamatan_bpkb' => $this->input->post('kecamatan_bpkb_kendaraan'),
			'kelurahan_bpkb' => $this->input->post('kelurahan_bpkb_kendaraan'),
			'kota_bpkb' => $this->input->post('kota_bpkb_kendaraan'),
			'nilai_likuidas' => $this->input->post('nilai_likuidas_kendaraan'),
			'kondisi_jaminan' => $this->input->post('kondisi_jaminan_kendaraan'),
			'tgl_taksasi' => $this->input->post('tgl_taksasi_kendaraaan'),
			'tgl_exp_pajak' => $this->input->post('tgl_exp_pajak_kendaraaan'),
			'tgl_exp_stnk' => $this->input->post('tgl_exp_stnk_kendaraaan'),
			'no_bpkb' => $this->input->post('no_bpkb_kendaraaan'),
			'no_rangka' => $this->input->post('no_rangka_kendaraaan'),
			'no_mesin' => $this->input->post('no_mesin_kendaraaan'),
			'no_stnk' => $this->input->post('no_stnk_kendaraaan'),
			'no_polisi' => $this->input->post('no_polisi_kendaraaan'),
			'tahun' => $this->input->post('tahun_kendaraan'),
			'warna' => $this->input->post('warna_kendaraan'),
			'no_faktur' => $this->input->post('no_faktur'),
			'silinder' => $this->input->post('silinder_kendaraan'),
			'nilai_taksasi' => $this->input->post('nilai_taksasi_kendaraan')
		);

		$whereTrack = array('id_order' => $this->input->post('id_order'));
		$dataTracking = array(
			'desc_memo_ao' => 'Memo Ao Telah Selesai',
			'create_date_memo_ao' => date('Y-m-d H:i:s'),
			'status_memo_ao' => 2,
			'desc_memo_ca' => 'Proses Memo Ca',
			'create_date_memo_ca' => date('Y-m-d H:i:s'),
			'status_memo_ca' => 1,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);
		if ($angunan == 'Sertifikat') {
			$querySert = $this->business->add_data('los_memo_kredit_ao_sertifikat',$dataAoSertifikat);
			$queryMemoao = $this->business->add_data('los_memo_kredit_ao',$dataMemoAo);
			if ($queryMemoao AND $querySert) {
				echo json_encode(array('msg' => 'success'));
			}else{
				echo json_encode(array('msg' => 'failed'));
			}
		}else if ($angunan == 'Kendaraan') {
			$queryKend = $this->business->add_data('los_memo_kredit_ao_kendaraan',$dataAoKendaraan);
			$queryMemoao = $this->business->add_data('los_memo_kredit_ao',$dataMemoAo);
			if ($queryMemoao AND $queryKend) {
				echo json_encode(array('msg' => 'success'));
			}else{
				echo json_encode(array('msg' => 'failed'));
			}
		}else{
			echo "undifined";
		}
	}

	public function get_detailMemoAo($value='')
	{
		$id_order = $this->uri->segment(3);
		$data = $this->business->DetailMemoAo($id_order)->result();
		$lengh = $this->business->DetailMemoAo($id_order)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_detailMemoAoSertifikat($value='')
	{
		$id = $this->uri->segment(3);
		$data = $this->business->DetailMemoAoSetifikat($id)->result();
		$lengh = $this->business->DetailMemoAoSetifikat($id)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_detailMemoAoKendaraan($value='')
	{
		$id = $this->uri->segment(3);
		$data = $this->business->DetailMemoAoKendaraan($id)->result();
		$lengh = $this->business->DetailMemoAoKendaraan($id)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}


	public function verifikasiMemoAo($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);

		$data = array(
			'verifikasi' => 1,
			'verifikasi_by' => $this->session->userdata('id'),
			'verifikasi_date' => date('Y-m-d H:i:s')
		);

		$queryVerifMemoAO = $this->business->update_data('los_memo_kredit_ao',$data,$where);

		if ($queryVerifMemoAO) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function saveEditMemoAo($value='')
	{
		$where =array('id_order' => $this->input->post('id_order'));
		$status_ser = $this->input->post('status_ser');
		$status_ken = $this->input->post('status_ken');
		$dataMemoAo = array(
			'jaminan_utama' => $this->input->post('jaminan_utama'),
			'sumber_informasi' => $this->input->post('sumber_informasi'),
			'type_kredit' => $this->input->post('type_kredit'),
			'jenis_fasilitas' => $this->input->post('jenis_fasilitas'),
			'kode_produk' => $this->input->post('kode_produk'),
			'suku_bunga' => $this->input->post('suku_bunga'),
			'akad_kredit' => $this->input->post('akad_kredit'),
			'akad_jaminan' => $this->input->post('akad_jaminan'),
			'gaji_debitur' => str_replace(".","",$this->input->post('gaji_debitur')),
			'gaji_pasangan' => str_replace(".","",$this->input->post('gaji_pasangan')),
			'gaji_penjamin' => str_replace(".","",$this->input->post('gaji_penjamin')),
			'pengeluaran_rumah_tangga' => str_replace(".","",$this->input->post('pengeluaran_rumah_tangga')),
			'pengeluaran_transportasi' => str_replace(".","",$this->input->post('pengeluaran_transport')),
			'pengeluaran_pendidikan' => str_replace(".","",$this->input->post('pengeluaran_pendidikan')),
			'pengeluaran_lainya' => str_replace(".","",$this->input->post('pengeluaran_lainnya')),
			'angsuran_lain' => str_replace(".","",$this->input->post('angsuran_lain')),
			'angsuran_kdpms' => str_replace(".","",$this->input->post('angsuran_kdpms')),
			'pendapatan_lainnya' => str_replace(".","",$this->input->post('penghasilan_lainnya')),
			'hasil_cek_lingkungan' => $this->input->post('hasil_cek_lingkungan'),
			'vertifikasi_data_debitur' => $this->input->post('vertifikasi_data_debitur'),
			'ket_calon_debitur' => $this->input->post('ket_calon_debitur'),
			/*'realisasi' => $this->input->post('realisasi'),
			'tenor' => $this->input->post('tenor'),*/
			'nama_anak' => $this->input->post('nama_anak'),
			'nama_sekolah_anak' => $this->input->post('nama_sekolah'),
			'alamat_sekolah_anak' => $this->input->post('alamat_sekolah_anak'),
			'last_update'=> date('Y-m-d H:i:s'),
			'update_by'=> $this->session->userdata('id'),
		);

		if ($status_ser == 'tidakada') {
			$dataAoKendaraan = array(
				'kd_merk' => $this->input->post('kd_merk_kendaraan'),
				'kd_type' => $this->input->post('kd_type_kendaraan'),
				'kd_jenis' => $this->input->post('kd_jenis_kendaraan'),
				'kepemilikan' => $this->input->post('kepemilikan_kendaraan'),
				'penggunaan' => $this->input->post('penggunaan_kendaraan'),
				'atas_nama' => $this->input->post('atas_nama_kendaraan'),
				'alamat_bpkb' => $this->input->post('alamat_bpkb_kendaraan'),
				'kecamatan_bpkb' => $this->input->post('kecamatan_bpkb_kendaraan'),
				'kelurahan_bpkb' => $this->input->post('kelurahan_bpkb_kendaraan'),
				'kota_bpkb' => $this->input->post('kota_bpkb_kendaraan'),
				'nilai_likuidas' => $this->input->post('nilai_likuidas_kendaraan'),
				'kondisi_jaminan' => $this->input->post('kondisi_jaminan_kendaraan'),
				'tgl_taksasi' => $this->input->post('tgl_taksasi_kendaraaan'),
				'tgl_exp_pajak' => $this->input->post('tgl_exp_pajak_kendaraaan'),
				'tgl_exp_stnk' => $this->input->post('tgl_exp_stnk_kendaraaan'),
				'no_bpkb' => $this->input->post('no_bpkb_kendaraaan'),
				'no_rangka' => $this->input->post('no_rangka_kendaraaan'),
				'no_mesin' => $this->input->post('no_mesin_kendaraaan'),
				'no_stnk' => $this->input->post('no_stnk_kendaraaan'),
				'no_polisi' => $this->input->post('no_polisi_kendaraaan'),
				'tahun' => $this->input->post('tahun_kendaraan'),
				'warna' => $this->input->post('warna_kendaraan'),
				'no_faktur' => $this->input->post('no_faktur'),
				'silinder' => $this->input->post('silinder_kendaraan'),
				'nilai_taksasi' => $this->input->post('nilai_taksasi_kendaraan')
			);

			$updateAo = $this->business->update_data('los_memo_kredit_ao',$dataMemoAo,$where);
			$updateKen = $this->business->update_data('los_memo_kredit_ao_kendaraan',$dataAoKendaraan,$where);

			if ($updateAo && $updateKen) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}else if ($status_ken == 'tidakada') {
			$dataAoSertifikat = array(
				'id_order' => $this->input->post('id_order'),
				'lokasi' => $this->input->post('lokasi'),
				'kepemilikan' => $this->input->post('kepemilikan'),
				'penggunaan' => $this->input->post('penggunaan'),
				'no_sertifikat' => $this->input->post('no_sertifikat'),
				'tgl_sertifikat' => $this->input->post('tgl_sertifikat'),
				'tgl_surat_ukur' => $this->input->post('tgl_surat_ukur'),
				'no_surat_ukur' => $this->input->post('no_surat_ukur'),
				'jenis_sertifikat' => $this->input->post('jenis_sertifikat'),
				'no_shm' => $this->input->post('no_shm'),
				'no_ajb' => $this->input->post('no_ajb'),
				'masa_berlaku_shgb' => $this->input->post('masa_berlaku_shgb'),
				'masa_berlaku_shmrs' => $this->input->post('masa_berlaku_shmrs'),
				'tgl_ajb' => $this->input->post('tgl_ajb'),
				'atas_nama' => $this->input->post('atas_nama'),
				'alamat' => $this->input->post('alamat'),
				'luas_tanah' => $this->input->post('luas_tanah'),
				'luas_bangunan' => $this->input->post('luas_bangunan'),
				'kondisi_bangunan' => $this->input->post('kondisi_bangunan'),
				'imb' => $this->input->post('imb'),
				'legalitas' => $this->input->post('legalitas'),
				'catatan_lainnya' => $this->input->post('catatan_lainnya'),
				/*'nilai_taksasi' => $this->input->post('nilai_taksasi'),
				'nilai_njop' => $this->input->post('nilai_njop'),
				'tgl_taksasi' => $this->input->post('tgl_taksasi')*/
			);

			$updateAo = $this->business->update_data('los_memo_kredit_ao',$dataMemoAo,$where);
			$updateSer = $this->business->update_data('los_memo_kredit_ao_sertifikat',$dataAoSertifikat,$where);

			if ($updateAo && $updateSer) {
				echo json_encode(array('msg' => 'success' ));
			}else{
				echo json_encode(array('msg' => 'failed' ));
			}
		}else{
			echo "ada yang ga beres";
		}
	}

	/*MEMO KREDIT CA*/
	public function MemoAoReadyCA($value='')
	{
		$data = $this->business->MemoAoReadyCA()->result();
		$lengh = $this->business->MemoAoReadyCA()->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function checkOrderInMemoCa($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca',null,null,$where)->num_rows();
		echo json_encode(array('amount' => $data));
	}

	public function get_DataMemoCA($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'manager' || $jabatan == 'ketua') {
			$ao = null;
		}else{
			$ao = $this->session->userdata('id');
		}
		$data = $this->business->get_DataMemoCA($startlimit,$areakerja,$keysearch,$ao)->result();
		$lengh = $this->business->get_DataMemoCA($startlimit,$areakerja,$keysearch,$ao)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function searchCa($value='')
	{
		$startlimit = 0;
		$keysearch = $this->input->post('keyword');
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$areakerja = 'semua';
			$ao = null;
		}else if($jabatan == 'manager') {
			$areakerja = $this->session->userdata('kantor');
			$ao = null;
		}else{
			$areakerja = $this->session->userdata('kantor');
			$ao = $this->session->userdata('id');
		}
		$data = $this->business->get_DataMemoCA($startlimit,$areakerja,$keysearch,$ao)->result();
		$lengh = $this->business->get_DataMemoCA($startlimit,$areakerja,$keysearch,$ao)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function AddMemoKreditCa($value='')
	{
		$dataMemoCa = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'id_calon_debitur' => rawurldecode($this->uri->segment(8)),
			'no_aplikasi' => $this->input->post('no_aplikasi_ca'),
			'jaminan_utama' => $this->input->post('jaminan_utama_ca'),
			'sumber_informasi' => $this->input->post('sumber_informasi_ca'),
			'sla' => $this->input->post('sla'),
			'ket_sla' => $this->input->post('ket_sla'),
			'jml_tanggungan' => $this->input->post('jml_tanggungan'),
			'status_rumah' => $this->input->post('status_rumah'),
			'alamat_sekarang' => $this->input->post('alamat_sekarang'),
			'alamat_domisili' => $this->input->post('alamat_domisili_ca'),
			'propinsi_id_domisili' => $this->input->post('propinsi_id_domisili'),
			'kotakab_id_domisili' => $this->input->post('kotakab_id_domisili'),
			'kecamatan_id_domisili' => $this->input->post('kecamatan_id_domisili'),
			'kelurahan_id_domisili' => $this->input->post('kelurahan_id_domisili'),
			'rt_domisili' => $this->input->post('rt_domisili'),
			'rw_domisili' => $this->input->post('rw_domisili'),
			'pekerjaan_debitur' => $this->input->post('pekerjaan_debitur'),
			'nama_tempat_kerja' => $this->input->post('nama_tempat_kerja'),
			'posisi' => $this->input->post('posisi'),
			'jenis_usaha_debitur' => $this->input->post('jenis_kerja_debitur'),
			'alamat_usaha_debitur' => $this->input->post('alamat_kerja_debitur'),
			'masa_kerja_debitur' => $this->input->post('masa_kerja_debitur'),
			'no_telp_kerja_debitur' => $this->input->post('no_telp_kerja_debitur'),
			'usaha_debitur' => $this->input->post('usaha_debitur'),
			'nama_tempat_usaha' => $this->input->post('nama_tempat_usaha'),
			'jenis_usaha' => $this->input->post('jenis_usaha'),
			'alamat_tempat_usaha' => $this->input->post('alamat_tempat_usaha'),
			'masa_usaha' => $this->input->post('masa_usaha'),
			'no_telp_usaha' => $this->input->post('no_telp_usaha'),
			'tempat_usaha' => $this->input->post('tempat_usaha'),
			'pengeluaran_lainya' => str_replace(".","",$this->input->post('pengeluaran_lainnya')),
			'pendapatan_tunai' => str_replace(".","",$this->input->post('pendapatan_tunai')),
			'pendapatan_kredit' => str_replace(".","",$this->input->post('pendapatan_kredit')),
			'pengeluaran_sewa' => str_replace(".","",$this->input->post('pengeluaran_sewa')),
			'pengeluaran_belanja' => str_replace(".","",$this->input->post('pengeluaran_belanja')),
			'pengeluaran_gaji_pegawai' => str_replace(".","",$this->input->post('pengeluaran_gaji_pegawai')),
			'angsuran_lain_usaha' => str_replace(".","",$this->input->post('angsuran_lain_usaha')),
			'pengeluaran_lainya_usaha' => str_replace(".","",$this->input->post('pengeluaran_lain_usaha')),
			'pengeluaran_telp_listrik_air' => str_replace(".","",$this->input->post('pengeluaran_telp_listrik_air')),
			'luas_tanah_ca' => $this->input->post('luas_tanah_ca'),
			'luas_tanah_njop' => $this->input->post('luas_tanah_njop'),
			'kondisi_bentuk_tanah' => $this->input->post('kondisi_bentuk_tanah'),
			'luas_bangunan_ca' => $this->input->post('luas_bangunan_ca'),
			'luas_bangunan_njop' => $this->input->post('luas_bangunan_njop'),
			'dibangun_tahun' => $this->input->post('dibangun_tahun'),
			'kegunaan_bangunan' => $this->input->post('kegunaan_bangunan'),
			'penguasaan_tanah_bangunan' => $this->input->post('penguasaan_tanah_bangunan'),
			'kondisi_fisik' => $this->input->post('kondisi_fisik_bangunan'),
			'sebelah_utara' => $this->input->post('sebelah_utara'),
			'sebelah_selatan' => $this->input->post('sebelah_selatan'),
			'sebelah_timur' => $this->input->post('sebelah_timur'),
			'sebelah_barat' => $this->input->post('sebelah_barat'),
			'jalan_didepan' => $this->input->post('jalan_depan'),
			'jalan_lingkungan_terbesar' => $this->input->post('jalan_lingkungan_terbesar'),
			'fasilitas_umum' => $this->input->post('fasilitas_umum'),
			'tahun_njop' => $this->input->post('tahun_njop'),
			'njop_tanah' => str_replace(".","",$this->input->post('njop_bumi')),
			'njop_bangunan' => str_replace(".","",$this->input->post('njop_bangunan')),
			'harga_pasar_tanah' => str_replace(".","",$this->input->post('harga_pasaran_tanah')),
			'harga_pasar_bangunan' => str_replace(".","",$this->input->post('harga_pasaran_bangunan')),
			'keterangan_penilaian' => $this->input->post('keterangan_penilaian'),
			'nilai_taksasi' => $this->input->post('nilai_taksasi_persen'),
			'sumber_harga' => $this->input->post('sumber_harga'),
			'faktor_menaikan' => $this->input->post('faktor_yang_dapat_menaikan'),
			'faktor_menurunkan' => $this->input->post('faktor_yang_dapat_menurunkan'),
		);
		
		$dataMemoCaBangunan = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'kontruksi' => $this->input->post('kontruksi'),
			'lantai' => $this->input->post('lantai'),
			'dinding' => $this->input->post('dinding'),
			'kusen' => $this->input->post('kusen'),
			'pintu' => $this->input->post('pintu'),
			'jendela' => $this->input->post('jendela'),
			'kuda_kuda' => $this->input->post('kuda_kuda'),
			'rangkap_atap' => $this->input->post('rangkap_atap'),
			'langit_langit' => $this->input->post('langit_langit'),
			'atap' => $this->input->post('atap'),
			'pagar' => $this->input->post('pagar'),
			'ruang_tamu' => $this->input->post('ruang_tamu'),
			'kamar_mandi_wc' => $this->input->post('kamar_mandi'),
			'ruang_makan' => $this->input->post('ruang_makan'),
			'dapur' => $this->input->post('dapur'),
			'kamar_pembantu' => $this->input->post('kamar_pembantu'),
			'teras' => $this->input->post('teras'),
			'kamar_tidur' => $this->input->post('kamar_tidur'),
			'garasi' => $this->input->post('garasi'),
			'ruang_keluarga_l2' => $this->input->post('ruang_keluarga'),
			'kamar_mandi_wc_l2' => $this->input->post('kamar_mandi_2'),
			'ruang_makan_l2' => $this->input->post('ruang_makan_2'),
			'dapur_l2' => $this->input->post('dapur_2'),
			'kamar_l2' => $this->input->post('kamar'),
			'teras_l2' => $this->input->post('teras'),
			'listrik_l2' => $this->input->post('listrik'),
			'telepon_fax_dll_l2' => $this->input->post('telpon_fax'),
			'air_l2' => $this->input->post('air')
		);

		$VerifikasiDataCa = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'ktp_cln_debitur' => $this->input->post('ktp_cln_debitur'),
			'ktp_pasangan' => $this->input->post('ktp_pasangan'),
			'kartu_keluarga' => $this->input->post('kartu_keluarga'),
			'surat_nikah' => $this->input->post('surat_nikah'),
			'surat_cerai' => $this->input->post('surat_cerai'),
			'sttp_pbb' => $this->input->post('sttp_pbb'),
			'sertifikat_or_bpkb' => $this->input->post('sertifikat_or_bpkb'),
			'imb' => $this->input->post('imb'),
			'slip_gaji' => $this->input->post('slip_gaji'),
			'rekening_tabungan' => $this->input->post('rekening_tabungan'),
			'data_penjamin' => $this->input->post('data_penjamin'),
			'catatan' => $this->input->post('catatan')
		);

		$CekSurveyCa = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'visit_cln_debitur' => $this->input->post('visit_cln_debitur'),
			'visit_pasangan' => $this->input->post('visit_pasangan'),
			'visit_penjamin' => $this->input->post('visit_penjamin'),
			'visit_tmpt_tinggal' => $this->input->post('visit_tmpt_tinggal'),
			'visit_jaminan' => $this->input->post('visit_jaminan'),
			'visit_usaha' => $this->input->post('visit_usaha'),
			'cek_lingkungan' => $this->input->post('cek_lingkungan'),
			'alamat_domisili' => $this->input->post('alamat_domisili')
		);

		$KondisiLokasiJaminan = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'pusat_keramaian' => $this->input->post('pusat_keramaian'),
			'jarak_keramaian' => $this->input->post('jarak_keramaian'),
			'akses_jalan' => $this->input->post('akses_jalan'),
			'tingkat_kepadatan' => $this->input->post('tingkat_kepadatan'),
			'luas_jalan' => $this->input->post('luas_jalan'),
			'pert_lingkungan' => $this->input->post('pert_lingkungan'),
			'rawan_bancana' => $this->input->post('rawan_bancana'),
			'daerah_banjir' => $this->input->post('daerah_banjir'),
		);

		$lainLain = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'sertifikat' => $this->input->post('sertifikat'),
			'ajb' => $this->input->post('ajb'),
			'kendaraan' => $this->input->post('kendaraan'),
			'tim_survey' => $this->input->post('team_survey'),
			'penyimpangan' => $this->input->post('penyimpangan'),
			'realisasi' => str_replace(".","",$this->input->post('realisasi')),
			'tenor' => $this->input->post('tenor'),
			'vertifikasi_data_debitur' => $this->input->post('vertifikasi_data_debitur'),
			'vertifikasi_penjamin' => $this->input->post('vertifikasi_penjamin'),
			'vertifikasi_jaminan' => $this->input->post('vertifikasi_jaminan'),
			'analisa_bi_checking' => $this->input->post('analisa_kredit_checking'),
			'ket_calon_debitur_ca' => $this->input->post('ket_calon_debitur'),
			'comment_analisa' => $this->input->post('comment_analisa'),
			'hasil_cek_lingk' => $this->input->post('hasil_cek_lingk'),
			'hasil_cek_aspek_kuantitatif' => $this->input->post('hasil_cek_aspek_kuantitatif')
		);

		$jumfileFotoJaminan = count($_FILES['foto_jaminan']['name']);
		$uploadFotoJaminan = $this->MultiUpload($jumfileFotoJaminan,'foto_jaminan','./assets/foto_jaminan','CAA_');

        $foto_jaminan = json_encode(array('file' => $uploadFotoJaminan));

        $jumFileLampCaa = count($_FILES['lampiran_caa']['name']);
		$uploadLampCaa = $this->MultiUpload($jumFileLampCaa,'lampiran_caa','./assets/lampiran_caa','CAA_');

        $lampiran_caa = json_encode(array('file' => $uploadLampCaa));

		$dataCaa = array(
			'id_order' => rawurldecode($this->uri->segment(7)),
			'is_penyimpangan' => 0,
			'is_return' => null,
			'team_caa' => 'manager,ketua',
			'subject' => $this->input->post('Subject'),
			'status_app' => '0',
			'root_server' => null,
			'folder_master' => null,
			'foto_jaminan' => $foto_jaminan,
			'lampiran' => $lampiran_caa,
			'user_last_app' => $this->session->userdata('id'),
			'tgl_last_app' => date('Y-m-d H:i:s'),
			'user_id' => $this->session->userdata('id'),
			'tgl_buat' => date('Y-m-d H:i:s'),
			'ket_return' => null,
			'flg_notif' => '0',
		);
		$whereTrack = array('id_order' => rawurldecode($this->uri->segment(7)));
		$dataTracking = array(
			'desc_memo_ca' => 'Memo CA Telah Selesai',
			'create_date_memo_ca' => date('Y-m-d H:i:s'),
			'status_memo_ca' => 2,
			'desc_caa' => 'Proses persetujuan manager dan ketua',
			'create_date_caa' => date('Y-m-d H:i:s'),
			'status_caa' => 1,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);

		$ao_to_email = rawurldecode($this->uri->segment(3));
		$name_to_email = rawurldecode($this->uri->segment(4));
		$nik_to_email = rawurldecode($this->uri->segment(5));
		$plafond_to_email = rawurldecode($this->uri->segment(6));
		/*print_r($ao_to_email);
		print_r($name_to_email);
		print_r($nik_to_email);
		print_r($plafond_to_email);
		die();*/
		//print_r($dataCaa);die();
		$queryMemoCa = $this->business->add_data('los_memo_kredit_ca',$dataMemoCa);
		$queryMemoCaBangunan = $this->business->add_data('los_memo_kredit_ca_bangunan',$dataMemoCaBangunan);
		$queryMemoCaVerifData = $this->business->add_data('los_memo_kredit_ca_vertifikasi_data',$VerifikasiDataCa);
		$queryMemoCaCeklisSurvey = $this->business->add_data('los_memo_kredit_ca_ceklist_survey',$CekSurveyCa);
		$queryKondisiLokasiJaminanCa = $this->business->add_data('los_memo_kredit_ca_kondisi_dan_lokasi_jaminan',$KondisiLokasiJaminan);
		$querylainLainCa = $this->business->add_data('los_memo_kredit_ca_lain_lain',$lainLain);
		$queryCaa = $this->business->add_data('los_caa',$dataCaa);

		if ($queryMemoCa && $queryMemoCaVerifData && $queryMemoCaCeklisSurvey && $queryKondisiLokasiJaminanCa && $querylainLainCa && $queryCaa) {
			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'arsyandi.ridho@gmail.com, budiawan.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'arsyandi.ridho@gmail.com, mu.yakub99@gmail.com, budiawan.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'arsyandi.ridho@gmail.com, budiawan.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com';
			}
			//$toemail = 'fahmidwi45@gmail.com';//TO AO
	       	$subject = 'PERSETUJUAN';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA PERSETUJUAN </h2></center>

			<p style='font-family: verdana'>Data Calon nasabah telah telah lengkap, silahkan periksa kembali kelengkapan data dan lakukan persetujuan</p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
			$this->sendEmail($toemail,$subject,$message);
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}

	}

	public function AddMemoKreditCaKendaraan($value='')
	{
		$dataMemoCa = array(
			'id_order' => $this->input->post('id_order'),
			'id_calon_debitur' => $this->input->post('id_calon_debitur'),
			'no_aplikasi' => $this->input->post('no_aplikasi_ca'),
			'jaminan_utama' => $this->input->post('jaminan_utama_ca'),
			'sumber_informasi' => $this->input->post('sumber_informasi_ca'),
			'sla' => $this->input->post('sla'),
			'ket_sla' => $this->input->post('ket_sla'),
			'jml_tanggungan' => $this->input->post('jml_tanggungan'),
			'status_rumah' => $this->input->post('status_rumah'),
			'alamat_sekarang' => $this->input->post('alamat_sekarang'),
			'alamat_domisili' => $this->input->post('alamat_domisili_ca'),
			'propinsi_id_domisili' => $this->input->post('propinsi_id_domisili'),
			'kotakab_id_domisili' => $this->input->post('kotakab_id_domisili'),
			'kecamatan_id_domisili' => $this->input->post('kecamatan_id_domisili'),
			'kelurahan_id_domisili' => $this->input->post('kelurahan_id_domisili'),
			'rt_domisili' => $this->input->post('rt_domisili'),
			'rw_domisili' => $this->input->post('rw_domisili'),
			'pekerjaan_debitur' => $this->input->post('pekerjaan_debitur'),
			'nama_tempat_kerja' => $this->input->post('nama_tempat_kerja'),
			'posisi' => $this->input->post('posisi'),
			'jenis_usaha_debitur' => $this->input->post('jenis_kerja_debitur'),
			'alamat_usaha_debitur' => $this->input->post('alamat_kerja_debitur'),
			'masa_kerja_debitur' => $this->input->post('masa_kerja_debitur'),
			'no_telp_kerja_debitur' => $this->input->post('no_telp_kerja_debitur'),
			'usaha_debitur' => $this->input->post('usaha_debitur'),
			'nama_tempat_usaha' => $this->input->post('nama_tempat_usaha'),
			'jenis_usaha' => $this->input->post('jenis_usaha'),
			'alamat_tempat_usaha' => $this->input->post('alamat_tempat_usaha'),
			'masa_usaha' => $this->input->post('masa_usaha'),
			'no_telp_usaha' => $this->input->post('no_telp_usaha'),
			'tempat_usaha' => $this->input->post('tempat_usaha'),
			'pengeluaran_lainya' => str_replace(".","",$this->input->post('pengeluaran_lainnya')),
			'pendapatan_tunai' => str_replace(".","",$this->input->post('pendapatan_tunai')),
			'pendapatan_kredit' => str_replace(".","",$this->input->post('pendapatan_kredit')),
			'pengeluaran_sewa' => str_replace(".","",$this->input->post('pengeluaran_sewa')),
			'pengeluaran_belanja' => str_replace(".","",$this->input->post('pengeluaran_belanja')),
			'pengeluaran_gaji_pegawai' => str_replace(".","",$this->input->post('pengeluaran_gaji_pegawai')),
			'angsuran_lain_usaha' => str_replace(".","",$this->input->post('angsuran_lain_usaha')),
			'pengeluaran_lainya_usaha' => str_replace(".","",$this->input->post('pengeluaran_lain_usaha')),
			'pengeluaran_telp_listrik_air' => str_replace(".","",$this->input->post('pengeluaran_telp_listrik_air')),
			'luas_tanah_ca' => $this->input->post('luas_tanah_ca'),
			'luas_tanah_njop' => $this->input->post('luas_tanah_njop'),
			'kondisi_bentuk_tanah' => $this->input->post('kondisi_bentuk_tanah'),
			'luas_bangunan_ca' => $this->input->post('luas_bangunan_ca'),
			'luas_bangunan_njop' => $this->input->post('luas_bangunan_njop'),
			'dibangun_tahun' => $this->input->post('dibangun_tahun'),
			'kegunaan_bangunan' => $this->input->post('kegunaan_bangunan'),
			'penguasaan_tanah_bangunan' => $this->input->post('penguasaan_tanah_bangunan'),
			'kondisi_fisik' => $this->input->post('kondisi_fisik_bangunan'),
			'sebelah_utara' => $this->input->post('sebelah_utara'),
			'sebelah_selatan' => $this->input->post('sebelah_selatan'),
			'sebelah_timur' => $this->input->post('sebelah_timur'),
			'sebelah_barat' => $this->input->post('sebelah_barat'),
			'jalan_didepan' => $this->input->post('jalan_depan'),
			'jalan_lingkungan_terbesar' => $this->input->post('jalan_lingkungan_terbesar'),
			'fasilitas_umum' => $this->input->post('fasilitas_umum'),
			'tahun_njop' => $this->input->post('tahun_njop'),
			'njop_tanah' => str_replace(".","",$this->input->post('njop_bumi')),
			'njop_bangunan' => str_replace(".","",$this->input->post('njop_bangunan')),
			'harga_pasar_tanah' => str_replace(".","",$this->input->post('harga_pasaran_tanah')),
			'harga_pasar_bangunan' => str_replace(".","",$this->input->post('harga_pasaran_bangunan')),
			'keterangan_penilaian' => $this->input->post('keterangan_penilaian'),
			'nilai_taksasi' => $this->input->post('nilai_taksasi_persen'),
			'sumber_harga' => $this->input->post('sumber_harga'),
			'faktor_menaikan' => $this->input->post('faktor_yang_dapat_menaikan'),
			'faktor_menurunkan' => $this->input->post('faktor_yang_dapat_menurunkan'),
		);

		$VerifikasiDataCa = array(
			'id_order' => $this->input->post('id_order'),
			'ktp_cln_debitur' => $this->input->post('ktp_cln_debitur'),
			'ktp_pasangan' => $this->input->post('ktp_pasangan'),
			'kartu_keluarga' => $this->input->post('kartu_keluarga'),
			'surat_nikah' => $this->input->post('surat_nikah'),
			'surat_cerai' => $this->input->post('surat_cerai'),
			'sttp_pbb' => $this->input->post('sttp_pbb'),
			'sertifikat_or_bpkb' => $this->input->post('sertifikat_or_bpkb'),
			'imb' => $this->input->post('imb'),
			'slip_gaji' => $this->input->post('slip_gaji'),
			'rekening_tabungan' => $this->input->post('rekening_tabungan'),
			'data_penjamin' => $this->input->post('data_penjamin'),
			'catatan' => $this->input->post('catatan')
		);

		$CekSurveyCa = array(
			'id_order' => $this->input->post('id_order'),
			'visit_cln_debitur' => $this->input->post('visit_cln_debitur'),
			'visit_pasangan' => $this->input->post('visit_pasangan'),
			'visit_penjamin' => $this->input->post('visit_penjamin'),
			'visit_tmpt_tinggal' => $this->input->post('visit_tmpt_tinggal'),
			'visit_jaminan' => $this->input->post('visit_jaminan'),
			'visit_usaha' => $this->input->post('visit_usaha'),
			'cek_lingkungan' => $this->input->post('cek_lingkungan'),
			'alamat_domisili' => $this->input->post('alamat_domisili')
		);

		$suratsuratKendaraan = array(
			'id_order' => $this->input->post('id_order'),
			'merk_jenis' => $this->input->post('merk_jenis_k'),
			'no_rangka' => $this->input->post('no_rangka_k'),
			'no_stnk' => $this->input->post('no_stnk_k'),
			'no_polisi' => $this->input->post('no_polisi_k'),
			'no_faktur' => $this->input->post('no_faktur_k'),
			'no_bpkb' => $this->input->post('no_bpkb_k'),
			'atas_nama' => $this->input->post('atas_nama_k'),
			'alamat' => $this->input->post('alamat_k'),
			'stnk' => $this->input->post('stnk').','.$this->input->post('stnk1'),
			'notes_pajak' => $this->input->post('notes_pajak').','.$this->input->post('notes_pajak1'),
			'trayek' => $this->input->post('trayek').','.$this->input->post('trayek1'),
			'bpkb' => $this->input->post('bpkb').','.$this->input->post('bpkb1'),
			'faktur' => $this->input->post('faktur').','.$this->input->post('faktur1'),
			'kwitansi_blangko' => $this->input->post('kwitansi_blangko').','.$this->input->post('kwitansi_blangko1'),
			'masa_berlaku_stnk' => $this->input->post('masa_berlaku_stnk'),
			'masa_berlaku_pajak' => $this->input->post('masa_berlaku_pajak')
		);

		$fisikkendaraan = array(
			'id_order' => $this->input->post('id_order'),
			'chasis' => $this->input->post('chasis'),
			'body' => $this->input->post('body'),
			'kabin' => $this->input->post('kabin'),
			'plafon' => $this->input->post('flapon'),
			'dashboard' => $this->input->post('dashboard'),
			'dek_landasan' => $this->input->post('dek_landasan'),
			'ban' => $this->input->post('ban'),
			'velg' => $this->input->post('velg'),
			'jok' => $this->input->post('jok'),
			'cat' => $this->input->post('cat'),
			'lampu_lampu' => $this->input->post('lampu_lampu'),
			'klakson' => $this->input->post('klakson'),
			'speedometer' => $this->input->post('speedometer'),
			'kaca_spion' => $this->input->post('kaca_spion'),
			'kunci_kontak' => $this->input->post('kunci_kontak'),
			'kondisi_mesin_hidup' => $this->input->post('kondisi_mesin_hidup'),
			'perlengkapan' => $this->input->post('perlengkapan_yang_ada')
		);

		$penilaian = array(
			'id_order' => $this->input->post('id_order'),
			'sumber_informasi1' => $this->input->post('sumber1'),
			'harga1' => str_replace(".","",$this->input->post('harga1')),
			'sumber_informasi2' => $this->input->post('sumber2'),
			'harga2' => str_replace(".","",$this->input->post('harga2')),
			'kesimpulan' => $this->input->post('kesimpulan_penilaian')
		);

		$lainLain = array(
			'id_order' => $this->input->post('id_order'),
			'sertifikat' => $this->input->post('sertifikat'),
			'ajb' => $this->input->post('ajb'),
			'kendaraan' => $this->input->post('kendaraan'),
			'tim_survey' => $this->input->post('team_survey'),
			'penyimpangan' => $this->input->post('penyimpangan'),
			'realisasi' => str_replace(".","",$this->input->post('realisasi')),
			'tenor' => $this->input->post('tenor'),
			'vertifikasi_data_debitur' => $this->input->post('vertifikasi_data_debitur'),
			'vertifikasi_penjamin' => $this->input->post('vertifikasi_penjamin'),
			'vertifikasi_jaminan' => $this->input->post('vertifikasi_jaminan'),
			'analisa_bi_checking' => $this->input->post('analisa_kredit_checking'),
			'ket_calon_debitur_ca' => $this->input->post('ket_calon_debitur'),
			'comment_analisa' => $this->input->post('comment_analisa'),
			'hasil_cek_lingk' => $this->input->post('hasil_cek_lingk'),
			'hasil_cek_aspek_kuantitatif' => $this->input->post('hasil_cek_aspek_kuantitatif')
		);

		//print_r($penilaian);die();

		$jumfileFotoJaminan = count($_FILES['foto_jaminan']['name']);
		$uploadFotoJaminan = $this->MultiUpload($jumfileFotoJaminan,'foto_jaminan','./assets/foto_jaminan','CAA_');

        $foto_jaminan = json_encode(array('file' => $uploadFotoJaminan));

        $jumFileLampCaa = count($_FILES['lampiran_caa']['name']);
		$uploadLampCaa = $this->MultiUpload($jumFileLampCaa,'lampiran_caa','./assets/lampiran_caa','CAA_');

        $lampiran_caa = json_encode(array('file' => $uploadLampCaa));

		$dataCaa = array(
			'id_order' => $this->input->post('id_order'),
			'is_penyimpangan' => 0,
			'is_return' => null,
			'team_caa' => 'manager,ketua',
			'subject' => $this->input->post('Subject'),
			'status_app' => '0',
			'root_server' => null,
			'folder_master' => null,
			'foto_jaminan' => $foto_jaminan,
			'lampiran' => $lampiran_caa,
			'user_last_app' => $this->session->userdata('id'),
			'tgl_last_app' => date('Y-m-d H:i:s'),
			'user_id' => $this->session->userdata('id'),
			'tgl_buat' => date('Y-m-d H:i:s'),
			'ket_return' => null,
			'flg_notif' => '0',
		);

		$whereTrack = array('id_order' => $this->input->post('id_order'));
		$dataTracking = array(
			'desc_memo_ca' => 'Memo CA Telah Selesai',
			'create_date_memo_ca' => date('Y-m-d H:i:s'),
			'status_memo_ca' => 2,
			'desc_caa' => 'Proses persetujuan manager dan ketua',
			'create_date_caa' => date('Y-m-d H:i:s'),
			'status_caa' => 1,
		);

		$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);

		$ao_to_email = rawurldecode($this->uri->segment(3));
		$name_to_email = rawurldecode($this->uri->segment(4));
		$nik_to_email = rawurldecode($this->uri->segment(5));
		$plafond_to_email = rawurldecode($this->uri->segment(6));
		/*print_r($ao_to_email);
		print_r($name_to_email);
		print_r($nik_to_email);
		print_r($plafond_to_email);
		die();*/
		//$toemail = 'fahmidwi45@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com ';
		if ($ao_to_email == 'Kantor') {
			$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'Adi suyadi') {
			$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'Budiawan') {
			$toemail = 'arsyandi.ridho@gmail.com, budiawan.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'Rediana Saputra') {
			$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'M.Yakub') {
			$toemail = 'mu.yakub99@gmail.com, budiawan.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'Lukman') {
			$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'Putra Nia') {
			$toemail = 'arsyandi.ridho@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
		}else if ($ao_to_email == 'Amirudin') {
			$toemail = 'arsyandi.ridho@gmail.com, budiawan.kdpms@gmail.com,';//TO AO
		}else if ($ao_to_email == 'Bambang Setiawan') {
			$toemail = 'Faiyzajavier@gmail.com, budiawan.kdpms@gmail.com';//TO AO
		}
       	$subject = 'PERSETUJUAN';
       	$message = "
	    <div style='padding:2%;background-color:white;'>
		<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
		</div>
		<br>
		<center><h2 style='font-family: arial;'>DATA PERSETUJUAN </h2></center>

		<p style='font-family: verdana'>Data Calon nasabah telah telah lengkap, silahkan periksa kembali kelengkapan data dan lakukan persetujuan</p>
		<p>MARKETING : $ao_to_email</p>
		<p>Nama Calon debitur : $name_to_email</p>
		<p>NIK : $nik_to_email</p>
		<p>plafond : Rp. $plafond_to_email</p>
		<br><br><br><br><br>
		<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
			<center>
				<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
				<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
			</center>
		</div>
	    ";
		$this->sendEmail($toemail,$subject,$message);

		//print_r($dataCaa);die();
		$queryMemoCa = $this->business->add_data('los_memo_kredit_ca',$dataMemoCa);
		$queryVerifikasiDataCa = $this->business->add_data('los_memo_kredit_ca_vertifikasi_data',$VerifikasiDataCa);
		$queryMemoCaCeklisSurvey = $this->business->add_data('los_memo_kredit_ca_ceklist_survey',$CekSurveyCa);
		$querysuratsuratKendaraan = $this->business->add_data('los_memo_kredit_ca_kendaraan',$suratsuratKendaraan);
		$queryfisikkendaraan = $this->business->add_data('los_memo_kredit_ca_fisik_kendaraan',$fisikkendaraan);
		$querypenilaian = $this->business->add_data('los_memo_kredit_ca_penilaian_jaminan_kendaraan',$penilaian);
		$querylainLainCa = $this->business->add_data('los_memo_kredit_ca_lain_lain',$lainLain);
		$queryCaa = $this->business->add_data('los_caa',$dataCaa);

		if ($queryMemoCa && $queryVerifikasiDataCa && $queryMemoCaCeklisSurvey && $querysuratsuratKendaraan && $queryfisikkendaraan && $querypenilaian && $querylainLainCa && $queryCaa) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}

	}

	public function get_DetailCa($value='')
	{
		$id_order = $this->uri->segment(3);
		$data = $this->business->get_DetailCa($id_order)->result();
		$lengh = $this->business->get_DetailCa($id_order)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_DetailCaVerifikasiData($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_vertifikasi_data',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaCeklisSurvey($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_ceklist_survey',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaKondisiLokasi($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_kondisi_dan_lokasi_jaminan',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaBiaya($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_biaya',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaLainLain($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_lain_lain',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaBangunan($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_bangunan',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaKendaraan($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_kendaraan',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaFisikKendaraan($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_fisik_kendaraan',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCaPenilaianKendaraan($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_memo_kredit_ca_penilaian_jaminan_kendaraan',null,null,$where)->result();
		echo json_encode($data);
	}


	public function SaveUpdateMemoCa($value='')
	{
		$where = array('id_order' => $this->input->post('id_order'));
		$dataMemoCa = array(
			'id_order' => $this->input->post('id_order'),
			'id_calon_debitur' => $this->input->post('id_calon_debitur'),
			'no_aplikasi' => $this->input->post('no_aplikasi_ca'),
			'jaminan_utama' => $this->input->post('jaminan_utama_ca'),
			'sumber_informasi' => $this->input->post('sumber_informasi_ca'),
			'sla' => $this->input->post('sla'),
			'ket_sla' => $this->input->post('ket_sla'),
			'jml_tanggungan' => $this->input->post('jml_tanggungan'),
			'status_rumah' => $this->input->post('status_rumah'),
			'alamat_sekarang' => $this->input->post('alamat_sekarang'),
			'alamat_domisili' => $this->input->post('alamat_domisili_ca'),
			'propinsi_id_domisili' => $this->input->post('propinsi_id_domisili'),
			'kotakab_id_domisili' => $this->input->post('kotakab_id_domisili'),
			'kecamatan_id_domisili' => $this->input->post('kecamatan_id_domisili'),
			'kelurahan_id_domisili' => $this->input->post('kelurahan_id_domisili'),
			'rt_domisili' => $this->input->post('rt_domisili'),
			'rw_domisili' => $this->input->post('rw_domisili'),
			'pekerjaan_debitur' => $this->input->post('pekerjaan_debitur'),
			'nama_tempat_kerja' => $this->input->post('nama_tempat_kerja'),
			'posisi' => $this->input->post('posisi'),
			'jenis_usaha_debitur' => $this->input->post('jenis_usaha_debitur'),
			'alamat_usaha_debitur' => $this->input->post('alamat_usaha_debitur'),
			'masa_kerja_debitur' => $this->input->post('masa_kerja_debitur'),
			'no_telp_kerja_debitur' => $this->input->post('no_telp_kerja_debitur'),
			'pengeluaran_lainya' => str_replace(".","",$this->input->post('pengeluaran_lainnya')),
			'pendapatan_tunai' => str_replace(".","",$this->input->post('pendapatan_tunai')),
			'pendapatan_kredit' => str_replace(".","",$this->input->post('pendapatan_kredit')),
			'pengeluaran_sewa' => str_replace(".","",$this->input->post('pengeluaran_sewa')),
			'pengeluaran_belanja' => str_replace(".","",$this->input->post('pengeluaran_belanja')),
			'pengeluaran_gaji_pegawai' => str_replace(".","",$this->input->post('pengeluaran_gaji_pegawai')),
			'angsuran_lain_usaha' => str_replace(".","",$this->input->post('angsuran_lain_usaha')),
			'pengeluaran_lainya_usaha' => str_replace(".","",$this->input->post('pengeluaran_lain_usaha')),
			'luas_tanah_ca' => $this->input->post('luas_tanah_ca'),
			'luas_tanah_njop' => $this->input->post('luas_tanah_njop'),
			'kondisi_bentuk_tanah' => $this->input->post('kondisi_bentuk_tanah'),
			'luas_bangunan_ca' => $this->input->post('luas_bangunan_ca'),
			'luas_bangunan_njop' => $this->input->post('luas_bangunan_njop'),
			'dibangun_tahun' => $this->input->post('dibangun_tahun'),
			'kegunaan_bangunan' => $this->input->post('kegunaan_bangunan'),
			'penguasaan_tanah_bangunan' => $this->input->post('penguasaan_tanah_bangunan'),
			'kondisi_fisik' => $this->input->post('kondisi_fisik_bangunan'),
			'sebelah_utara' => $this->input->post('sebelah_utara'),
			'sebelah_selatan' => $this->input->post('sebelah_selatan'),
			'sebelah_timur' => $this->input->post('sebelah_timur'),
			'sebelah_barat' => $this->input->post('sebelah_barat'),
			'jalan_didepan' => $this->input->post('jalan_depan'),
			'jalan_lingkungan_terbesar' => $this->input->post('jalan_lingkungan_terbesar'),
			'fasilitas_umum' => $this->input->post('fasilitas_umum'),
			'tahun_njop' => $this->input->post('tahun_njop'),
			'njop_tanah' => str_replace(".","",$this->input->post('njop_bumi')),
			'njop_bangunan' => str_replace(".","",$this->input->post('njop_bangunan')),
			'harga_pasar_tanah' => str_replace(".","",$this->input->post('harga_pasaran_tanah')),
			'harga_pasar_bangunan' => str_replace(".","",$this->input->post('harga_pasaran_bangunan')),
			'keterangan_penilaian' => $this->input->post('keterangan_penilaian'),
			'nilai_taksasi' => $this->input->post('nilai_taksasi_persen'),
			'sumber_harga' => $this->input->post('sumber_harga'),
			'faktor_menaikan' => $this->input->post('faktor_yang_dapat_menaikan'),
			'faktor_menurunkan' => $this->input->post('faktor_yang_dapat_menurunkan'),
			'usaha_debitur' => $this->input->post('usaha_debitur'),
			'nama_tempat_usaha' => $this->input->post('nama_tempat_usaha'),
			'jenis_usaha' => $this->input->post('jenis_usaha'),
			'alamat_tempat_usaha' => $this->input->post('alamat_tempat_usaha'),
			'masa_usaha' => $this->input->post('masa_usaha'),
			'no_telp_usaha' => $this->input->post('no_telp_usaha'),
			'tempat_usaha' => $this->input->post('tempat_usaha'),
		);

		$dataMemoCaBangunan = array(
			'id_order' => $this->input->post('id_order'),
			'kontruksi' => $this->input->post('kontruksi'),
			'lantai' => $this->input->post('lantai'),
			'dinding' => $this->input->post('dinding'),
			'kusen' => $this->input->post('kusen'),
			'pintu' => $this->input->post('pintu'),
			'jendela' => $this->input->post('jendela'),
			'kuda_kuda' => $this->input->post('kuda_kuda'),
			'rangkap_atap' => $this->input->post('rangkap_atap'),
			'langit_langit' => $this->input->post('langit_langit'),
			'atap' => $this->input->post('atap'),
			'pagar' => $this->input->post('pagar'),
			'ruang_tamu' => $this->input->post('ruang_tamu'),
			'kamar_mandi_wc' => $this->input->post('kamar_mandi'),
			'ruang_makan' => $this->input->post('ruang_makan'),
			'dapur' => $this->input->post('dapur'),
			'kamar_pembantu' => $this->input->post('kamar_pembantu'),
			'teras' => $this->input->post('teras'),
			'kamar_tidur' => $this->input->post('kamar_tidur'),
			'garasi' => $this->input->post('garasi'),
			'ruang_keluarga_l2' => $this->input->post('ruang_keluarga'),
			'kamar_mandi_wc_l2' => $this->input->post('kamar_mandi_2'),
			'ruang_makan_l2' => $this->input->post('ruang_makan_2'),
			'dapur_l2' => $this->input->post('dapur_2'),
			'kamar_l2' => $this->input->post('kamar'),
			'teras_l2' => $this->input->post('terasl2'),
			'listrik_l2' => $this->input->post('listrik'),
			'telepon_fax_dll_l2' => $this->input->post('telpon_fax'),
			'air_l2' => $this->input->post('air')
		);

		$VerifikasiDataCa = array(
			'id_order' => $this->input->post('id_order'),
			'ktp_cln_debitur' => $this->input->post('ktp_cln_debitur'),
			'ktp_pasangan' => $this->input->post('ktp_pasangan'),
			'kartu_keluarga' => $this->input->post('kartu_keluarga'),
			'surat_nikah' => $this->input->post('surat_nikah'),
			'surat_cerai' => $this->input->post('surat_cerai'),
			'sttp_pbb' => $this->input->post('sttp_pbb'),
			'sertifikat_or_bpkb' => $this->input->post('sertifikat_or_bpkb'),
			'imb' => $this->input->post('imb'),
			'slip_gaji' => $this->input->post('slip_gaji'),
			'rekening_tabungan' => $this->input->post('rekening_tabungan'),
			'data_penjamin' => $this->input->post('data_penjamin'),
			'catatan' => $this->input->post('catatan')
		);

		$CekSurveyCa = array(
			'id_order' => $this->input->post('id_order'),
			'visit_cln_debitur' => $this->input->post('visit_cln_debitur'),
			'visit_pasangan' => $this->input->post('visit_pasangan'),
			'visit_penjamin' => $this->input->post('visit_penjamin'),
			'visit_tmpt_tinggal' => $this->input->post('visit_tmpt_tinggal'),
			'visit_jaminan' => $this->input->post('visit_jaminan'),
			'visit_usaha' => $this->input->post('visit_usaha'),
			'cek_lingkungan' => $this->input->post('cek_lingkungan'),
			'alamat_domisili' => $this->input->post('alamat_domisili')
		);

		$KondisiLokasiJaminan = array(
			'id_order' => $this->input->post('id_order'),
			'pusat_keramaian' => $this->input->post('pusat_keramaian'),
			'jarak_keramaian' => $this->input->post('jarak_keramaian'),
			'akses_jalan' => $this->input->post('akses_jalan'),
			'tingkat_kepadatan' => $this->input->post('tingkat_kepadatan'),
			'luas_jalan' => $this->input->post('luas_jalan'),
			'pert_lingkungan' => $this->input->post('pert_lingkungan'),
			'rawan_bancana' => $this->input->post('rawan_bancana'),
			'daerah_banjir' => $this->input->post('daerah_banjir'),
		);

		$lainLain = array(
			'id_order' => $this->input->post('id_order'),
			'sertifikat' => $this->input->post('sertifikat'),
			'ajb' => $this->input->post('ajb'),
			'kendaraan' => $this->input->post('kendaraan'),
			'tim_survey' => $this->input->post('team_survey'),
			'penyimpangan' => $this->input->post('penyimpangan'),
			'realisasi' => str_replace(".","",$this->input->post('realisasi')),
			'tenor' => $this->input->post('tenor'),
			'vertifikasi_data_debitur' => $this->input->post('vertifikasi_data_debitur'),
			'vertifikasi_penjamin' => $this->input->post('vertifikasi_penjamin'),
			'vertifikasi_jaminan' => $this->input->post('vertifikasi_jaminan'),
			'analisa_bi_checking' => $this->input->post('analisa_kredit_checking'),
			'ket_calon_debitur_ca' => $this->input->post('ket_calon_debitur'),
			'comment_analisa' => $this->input->post('comment_analisa'),
			'hasil_cek_lingk' => $this->input->post('hasil_cek_lingk'),
			'hasil_cek_aspek_kuantitatif' => $this->input->post('hasil_cek_aspek_kuantitatif')
		);

		$queryMemoCa = $this->business->update_data('los_memo_kredit_ca',$dataMemoCa,$where);
		$queryMemoCaBangunan = $this->business->update_data('los_memo_kredit_ca_bangunan',$dataMemoCaBangunan,$where);
		$queryMemoCaVerifData = $this->business->update_data('los_memo_kredit_ca_vertifikasi_data',$VerifikasiDataCa,$where);
		$queryMemoCaCeklisSurvey = $this->business->update_data('los_memo_kredit_ca_ceklist_survey',$CekSurveyCa,$where);
		$queryKondisiLokasiJaminanCa = $this->business->update_data('los_memo_kredit_ca_kondisi_dan_lokasi_jaminan',$KondisiLokasiJaminan,$where);
		$queryBlainLainCa = $this->business->update_data('los_memo_kredit_ca_lain_lain',$lainLain,$where);

		if ($queryMemoCa && $queryMemoCaBangunan && $queryMemoCaVerifData && $queryMemoCaCeklisSurvey && $queryKondisiLokasiJaminanCa && $queryBlainLainCa) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}

	}

	public function SaveUpdateMemoCaKendaraan($value='')
	{
		$where = array('id_order' => $this->input->post('id_order'));

		$dataMemoCa = array(
			'id_order' => $this->input->post('id_order'),
			'id_calon_debitur' => $this->input->post('id_calon_debitur'),
			'jml_tanggungan' => $this->input->post('jml_tanggungan'),
			'alamat_sekarang' => $this->input->post('alamat_sekarang'),
			'nama_tempat_kerja' => $this->input->post('nama_tempat_kerja'),
			'posisi' => $this->input->post('posisi'),
			'jenis_usaha_debitur' => $this->input->post('jenis_usaha_debitur'),
			'alamat_usaha_debitur' => $this->input->post('alamat_usaha_debitur'),
			'masa_kerja_debitur' => $this->input->post('masa_kerja_debitur'),
			'no_telp_kerja_debitur' => $this->input->post('no_telp_kerja_debitur'),
			'pengeluaran_lainya' => str_replace(".","",$this->input->post('pengeluaran_lainnya')),
			'pendapatan_tunai' => str_replace(".","",$this->input->post('pendapatan_tunai')),
			'pendapatan_kredit' => str_replace(".","",$this->input->post('pendapatan_kredit')),
			'pengeluaran_sewa' => str_replace(".","",$this->input->post('pengeluaran_sewa')),
			'pengeluaran_belanja' => str_replace(".","",$this->input->post('pengeluaran_belanja')),
			'pengeluaran_gaji_pegawai' => str_replace(".","",$this->input->post('pengeluaran_gaji_pegawai')),
			'angsuran_lain_usaha' => str_replace(".","",$this->input->post('angsuran_lain_usaha')),
			'pengeluaran_lainya_usaha' => str_replace(".","",$this->input->post('pengeluaran_lain_usaha')),
			'usaha_debitur' => $this->input->post('usaha_debitur'),
			'nama_tempat_usaha' => $this->input->post('nama_tempat_usaha'),
			'jenis_usaha' => $this->input->post('jenis_usaha'),
			'alamat_tempat_usaha' => $this->input->post('alamat_tempat_usaha'),
			'masa_usaha' => $this->input->post('masa_usaha'),
			'no_telp_usaha' => $this->input->post('no_telp_usaha'),
			'tempat_usaha' => $this->input->post('tempat_usaha'),
		);

		$VerifikasiDataCa = array(
			'id_order' => $this->input->post('id_order'),
			'ktp_cln_debitur' => $this->input->post('ktp_cln_debitur'),
			'ktp_pasangan' => $this->input->post('ktp_pasangan'),
			'kartu_keluarga' => $this->input->post('kartu_keluarga'),
			'surat_nikah' => $this->input->post('surat_nikah'),
			'surat_cerai' => $this->input->post('surat_cerai'),
			'sttp_pbb' => $this->input->post('sttp_pbb'),
			'sertifikat_or_bpkb' => $this->input->post('sertifikat_or_bpkb'),
			'imb' => $this->input->post('imb'),
			'slip_gaji' => $this->input->post('slip_gaji'),
			'rekening_tabungan' => $this->input->post('rekening_tabungan'),
			'data_penjamin' => $this->input->post('data_penjamin'),
			'catatan' => $this->input->post('catatan')
		);

		$CekSurveyCa = array(
			'id_order' => $this->input->post('id_order'),
			'visit_cln_debitur' => $this->input->post('visit_cln_debitur'),
			'visit_pasangan' => $this->input->post('visit_pasangan'),
			'visit_penjamin' => $this->input->post('visit_penjamin'),
			'visit_tmpt_tinggal' => $this->input->post('visit_tmpt_tinggal'),
			'visit_jaminan' => $this->input->post('visit_jaminan'),
			'visit_usaha' => $this->input->post('visit_usaha'),
			'cek_lingkungan' => $this->input->post('cek_lingkungan'),
			'alamat_domisili' => $this->input->post('alamat_domisili')
		);

		$suratsuratKendaraan = array(
			'id_order' => $this->input->post('id_order'),
			'stnk' => $this->input->post('stnk').','.$this->input->post('stnk1'),
			'notes_pajak' => $this->input->post('notes_pajak').','.$this->input->post('notes_pajak1'),
			'trayek' => $this->input->post('trayek').','.$this->input->post('trayek1'),
			'bpkb' => $this->input->post('bpkb').','.$this->input->post('bpkb1'),
			'faktur' => $this->input->post('faktur').','.$this->input->post('faktur1'),
			'kwitansi_blangko' => $this->input->post('kwitansi_blangko').','.$this->input->post('kwitansi_blangko1'),
			'masa_berlaku_stnk' => $this->input->post('masa_berlaku_stnk'),
			'masa_berlaku_pajak' => $this->input->post('masa_berlaku_pajak')
		);

		$fisikkendaraan = array(
			'id_order' => $this->input->post('id_order'),
			'chasis' => $this->input->post('chasis'),
			'body' => $this->input->post('body'),
			'kabin' => $this->input->post('kabin'),
			'plafon' => $this->input->post('flapon'),
			'dashboard' => $this->input->post('dashboard'),
			'dek_landasan' => $this->input->post('dek_landasan'),
			'ban' => $this->input->post('ban'),
			'velg' => $this->input->post('velg'),
			'jok' => $this->input->post('jok'),
			'cat' => $this->input->post('cat'),
			'lampu_lampu' => $this->input->post('lampu_lampu'),
			'klakson' => $this->input->post('klakson'),
			'speedometer' => $this->input->post('speedometer'),
			'kaca_spion' => $this->input->post('kaca_spion'),
			'kunci_kontak' => $this->input->post('kunci_kontak'),
			'kondisi_mesin_hidup' => $this->input->post('kondisi_mesin_hidup'),
			'perlengkapan' => $this->input->post('perlengkapan_yang_ada')
		);

		$penilaian = array(
			'id_order' => $this->input->post('id_order'),
			'sumber_informasi1' => $this->input->post('sumber1'),
			'harga1' => str_replace(".","",$this->input->post('harga1')),
			'sumber_informasi2' => $this->input->post('sumber2'),
			'harga2' => str_replace(".","",$this->input->post('harga2')),
			'kesimpulan' => $this->input->post('kesimpulan_penilaian')
		);

		$lainLain = array(
			'id_order' => $this->input->post('id_order'),
			'tim_survey' => $this->input->post('team_survey'),
			'penyimpangan' => $this->input->post('penyimpangan'),
			'realisasi' => str_replace(".","",$this->input->post('realisasi')),
			'tenor' => $this->input->post('tenor'),
			'vertifikasi_data_debitur' => $this->input->post('vertifikasi_data_debitur_ca'),
			'vertifikasi_penjamin' => $this->input->post('vertifikasi_penjamin'),
			'vertifikasi_jaminan' => $this->input->post('vertifikasi_jaminan'),
			'analisa_bi_checking' => $this->input->post('analisa_kredit_checking'),
			'ket_calon_debitur_ca' => $this->input->post('ket_calon_debitur'),
			'comment_analisa' => $this->input->post('comment_analisa'),
			'hasil_cek_lingk' => $this->input->post('hasil_cek_lingk'),
			'hasil_cek_aspek_kuantitatif' => $this->input->post('hasil_cek_aspek_kuantitatif')
		);
		//print_r($lainLain);die();

		//print_r($dataCaa);die();
		$queryMemoCa = $this->business->update_data('los_memo_kredit_ca',$dataMemoCa,$where);
		$queryVerifikasiDataCa = $this->business->update_data('los_memo_kredit_ca_vertifikasi_data',$VerifikasiDataCa,$where);
		$queryMemoCaCeklisSurvey = $this->business->update_data('los_memo_kredit_ca_ceklist_survey',$CekSurveyCa,$where);
		$querysuratsuratKendaraan = $this->business->update_data('los_memo_kredit_ca_kendaraan',$suratsuratKendaraan,$where);
		$queryfisikkendaraan = $this->business->update_data('los_memo_kredit_ca_fisik_kendaraan',$fisikkendaraan,$where);
		$querypenilaian = $this->business->update_data('los_memo_kredit_ca_penilaian_jaminan_kendaraan',$penilaian,$where);
		$querylainLainCa = $this->business->update_data('los_memo_kredit_ca_lain_lain',$lainLain,$where);

		if ($queryMemoCa && $queryVerifikasiDataCa && $queryMemoCaCeklisSurvey && $querysuratsuratKendaraan && $queryfisikkendaraan && $querypenilaian && $querylainLainCa) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}

	}

	public function EditFotoJaminanCa($id_order)
	{
		$where = array('id_order' => $id_order);
		$cek = $this->business->get_where('los_caa',null,null,$where)->num_rows();

		$jumfileFotoJaminan = count($_FILES['foto_jaminan']['name']);
		$uploadFotoJaminan = $this->MultiUpload($jumfileFotoJaminan,'foto_jaminan','./assets/foto_jaminan','CAA_');
		$foto_jaminan = json_encode(array('file' => $uploadFotoJaminan));

		if ($cek == 0) {
			$dataCaa = array(
				'id_order' => $id_order,
				'is_penyimpangan' => 0,
				'is_return' => null,
				'team_caa' => 'manager,ketua',
				'subject' => $this->input->post('Subject'),
				'status_app' => '0',
				'root_server' => null,
				'folder_master' => null,
				'foto_jaminan' => $foto_jaminan,
				'lampiran' => null,
				'user_last_app' => $this->session->userdata('id'),
				'tgl_last_app' => date('Y-m-d H:i:s'),
				'user_id' => $this->session->userdata('id'),
				'tgl_buat' => date('Y-m-d H:i:s'),
				'ket_return' => null,
				'flg_notif' => '0',
			);
			//print_r($dataCaa);die();
			$queryfoto_jaminan = $this->business->add_data('los_caa',$dataCaa);
		}else{
			$data = array(
				'foto_jaminan' => $foto_jaminan
			);
			//print_r($data);die();
			$queryfoto_jaminan = $this->business->update_data('los_caa',$data,$where);
		}

		if ($queryfoto_jaminan) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	public function EditLampiranCa($id_order)
	{
		$where = array('id_order' => $id_order);
		$jumFileLampCaa = count($_FILES['lampiran_caa']['name']);
		$uploadLampCaa = $this->MultiUpload($jumFileLampCaa,'lampiran_caa','./assets/lampiran_caa','CAA_');

    	$lampiran_caa = json_encode(array('file' => $uploadLampCaa));

		$cek = $this->business->get_where('los_caa',null,null,$where)->num_rows();
		if ($cek == 0) {
			$dataCaa = array(
				'id_order' => $id_order,
				'is_penyimpangan' => 0,
				'is_return' => null,
				'team_caa' => 'manager,ketua',
				'subject' => $this->input->post('Subject'),
				'status_app' => '0',
				'root_server' => null,
				'folder_master' => null,
				'lampiran' => $lampiran_caa,
				'user_last_app' => $this->session->userdata('id'),
				'tgl_last_app' => date('Y-m-d H:i:s'),
				'user_id' => $this->session->userdata('id'),
				'tgl_buat' => date('Y-m-d H:i:s'),
				'ket_return' => null,
				'flg_notif' => '0',
			);
			print_r($dataCaa);die();
			$lampiran_caa = $this->business->add_data('los_caa',$dataCaa);
		}else{
			$data = array(
				'lampiran' => $lampiran_caa
			);
			$lampiran_caa = $this->business->update_data('los_caa',$data,$where);
		}

		if ($lampiran_caa) {
			echo json_encode(array('msg' => 'success' ));
		}else{
			echo json_encode(array('msg' => 'failed' ));
		}
	}

	/*CAA*/
	public function get_DataCaa($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$kantor = null;
		}else{
			$kantor = $this->session->userdata('kantor');
		}
		$data = $this->business->get_Caa($startlimit,$areakerja,$keysearch,$kantor)->result();
		$lengh = $this->business->get_Caa($startlimit,$areakerja,$keysearch,$kantor)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_DataCaa_ketua($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$data = $this->business->get_Caa_ketua($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->get_Caa_ketua($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function searchCaa($value='')
	{
		$startlimit = 0;
		$areakerja = $this->input->post('areakerja');
		$keysearch = $this->input->post('keyword');
		$jabatan = $this->session->userdata('jabatan');
		if ($jabatan == 'ketua') {
			$kantor = null;
		}else{
			$kantor = $this->session->userdata('kantor');
		}
		$data = $this->business->get_Caa($startlimit,$areakerja,$keysearch,$kantor)->result();
		$lengh = $this->business->get_Caa($startlimit,$areakerja,$keysearch,$kantor)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function searchCaa_ketua($value='')
	{
		$startlimit = 0;
		$areakerja = $this->input->post('areakerja');
		$keysearch = $this->input->post('keyword');
		$data = $this->business->get_Caa_ketua($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->get_Caa_ketua($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function AddCaaApproval($value='')
	{
		$where = array('id_order' => $this->input->post('id_order'));

		$ao_to_email =  $this->input->post('ao_to_email');
		$name_to_email =  $this->input->post('name_to_email');
		$nik_to_email =  $this->input->post('nik_to_email');
		$plafond_to_email =  $this->input->post('plafond_to_email');

		if ($this->session->userdata('jabatan') == 'manager') {
			$DataApproval = array(
				'id_order' => $this->input->post('id_order'),
				'user_id' => $this->session->userdata('id'),
				'jabatan' => $this->session->userdata('jabatan'),
				'alasan' => nl2br(stripslashes($this->input->post('alasan'))),
				'syarat' => nl2br(stripslashes($this->input->post('syarat'))),
				'notes' => nl2br(stripslashes($this->input->post('notes'))),
				'status_app' => '1',
				'plafon' => str_replace(".","",$this->input->post('plafond')),
				'tenor' => $this->input->post('tenor'),
				'tgl_app' => date('Y-m-d H:i:s'),
				'flg_notif' => 0
			);

			$persetujuan = 'Rp. '.$this->input->post('plafond').' - '.$this->input->post('tenor').' Bulan';
			$alasan = $this->input->post('alasan');
			$syarat = $this->input->post('syarat');
			$notes = $this->input->post('notes');

			$whereTrack = array('id_order' => $this->input->post('id_order'));
			$dataTracking = array(
				'desc_caa' => 'Data disetujui manager sebesar '.$persetujuan.', menunggu persetujuan ketua',
				'create_date_caa' => date('Y-m-d H:i:s'),
				'status_caa' => 1,
			);

			$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);
			/*TO AO*/
			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com';//TO AO
			}
	       	$subject = 'INFO PERSETUJUAN';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<h4 style='font-family: verdana'>Calon nasabah $ao_to_email telah disetujui manager</h4>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<p>persetujuan manager : $persetujuan</p>
			<p>alasan : $alasan</p>
			<p>syarat : $syarat</p>
			<p>catatan : $notes</p>
			<br><br>
			<b><p>MENUNGGU PERSETUJUAN DARI KETUA</p></b>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
			$this->sendEmail($toemail,$subject,$message);
			/*________________________________________*/
			/*TO KETUA*/
			$toemail = 'heinrichricky@gmail.com';//EMAIL KETUA
	       	$subject = 'PERSETUJUAN';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<br>
			<center><h2 style='font-family: arial;'>DATA PERSETUJUAN </h2></center>

			<p style='font-family: verdana'>Data Calon nasabah telah telah lengkap, silahkan periksa kembali kelengkapan data dan lakukan persetujuan</p>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
			$this->sendEmail($toemail,$subject,$message);
			/*_____________________________________*/
		}else{
			$DataApproval = array(
				'id_order' => $this->input->post('id_order'),
				'user_id' => $this->session->userdata('id'),
				'jabatan' => $this->session->userdata('jabatan'),
				'alasan' => nl2br(stripslashes($this->input->post('alasan'))),
				'syarat' => nl2br(stripslashes($this->input->post('syarat'))),
				'notes' => nl2br(stripslashes($this->input->post('notes'))),
				'status_app' => '1',
				'plafon' => str_replace(".","",$this->input->post('plafond')),
				'tenor' => $this->input->post('tenor'),
				'tgl_app' => date('Y-m-d H:i:s'),
				'flg_notif' => 0
			);
			$whereTrack = array('id_order' => $this->input->post('id_order'));
			$persetujuan = $this->input->post('plafond').' - '.$this->input->post('tenor').' Bulan';

			$dataTracking = array(
				'desc_caa' => 'Data disetujui ketua sebesar '.$persetujuan,
				'create_date_caa' => date('Y-m-d H:i:s'),
				'status_caa' => 2,
				'desc_akad' => 'Proses akad',
				'create_date_akad' => date('Y-m-d H:i:s'),
				'status_akad' => 1,
			);

			$alasan = $this->input->post('alasan');
			$syarat = $this->input->post('syarat');
			$notes = $this->input->post('notes');

			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com';//TO AO
			}
	       	$subject = 'INFO PERSETUJUAN';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<h4 style='font-family: verdana'>Calon nasabah $ao_to_email telah disetujui ketua</h4>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<p>persetujuan ketua : $persetujuan</p>
			<p>alasan : $alasan</p>
			<p>syarat : $syarat</p>
			<p>catatan : $notes</p>
			<br>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
			$this->sendEmail($toemail,$subject,$message);
			$toemaillegal = 'fahmidwi45@gmail.com,arsyandi.ridho@gmail.com,mulyanapermana.mp@gmail.com';
			$subject = 'LEGAL';
			$message = "
			<div style='padding:2%;background-color:white;'>
				<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
				</div>
				<h4 style='font-family: verdana'>Calon nasabah $ao_to_email telah disetujui ketua, silahkan masukan biaya biaya</h4>
				<p>MARKETING : $ao_to_email</p>
				<p>Nama Calon debitur : $name_to_email</p>
				<p>NIK : $nik_to_email</p>
				<p>plafond : Rp. $plafond_to_email</p>
				<p>persetujuan ketua : $persetujuan</p>
				<br>
				<br><br><br><br><br>
				<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
					<center>
						<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
						<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
					</center>
				</div>
			";
			$this->sendEmail($toemaillegal,$subject,$message);
			/*________________________________________*/

			$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);

			$update = array('status_app' => '1');
			$statCaa = $this->business->update_data('los_caa',$update,$where);
		}

		$tgllastapprove = array('tgl_last_app' => date('Y-m-d H:i:s'));
		$this->business->update_data('los_caa',$tgllastapprove,$where);

		$queryCaaAproval = $this->business->add_data('los_caa_approval',$DataApproval);

		if ($queryCaaAproval) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function getDataApproval($value='')
	{
		$id_order = $this->uri->segment(3);
		$user_id = $this->session->userdata('id');
		$where = array('id_order' => $id_order, 'user_id' => $user_id);
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->row();
		echo json_encode($data);
	}

	public function ChangeApproval($value='')
	{
		$where = array(
			'id_order' => $this->input->post('id_order'),
			'user_id' => $this->session->userdata('id')
		);
		
		$DataApproval = array(
			'alasan' => $this->input->post('alasan_bag_edit'),
			'syarat' => $this->input->post('syarat_bag_edit'),
			'notes' => $this->input->post('notes_bag_edit'),
			'plafon' => str_replace(".","",$this->input->post('plafond')),
			'tenor' => $this->input->post('tenor_bag_edit'),
		);

		if ($this->business->update_data('los_caa_approval',$DataApproval,$where)) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function AddCaaReject($value='')
	{
		$DataReject = array(
			'id_order' => $this->input->post('id_order'),
			'user_id' => $this->session->userdata('id'),
			'jabatan' => $this->session->userdata('jabatan'),
			'notes' => nl2br(stripcslashes($this->input->post('notes'))),
			'status_app' => '2',
			'tgl_app' => date('Y-m-d H:i:s')
		);

		$ao_to_email =  $this->input->post('ao_to_email');
		$name_to_email =  $this->input->post('name_to_email');
		$nik_to_email =  $this->input->post('nik_to_email');
		$plafond_to_email =  $this->input->post('plafond_to_email');
		$notes = $this->input->post('notes');

		if ($this->session->userdata('jabatan') == 'manager') {
			$whereTrack = array('id_order' => $this->input->post('id_order'));
			$dataTracking = array(
				'desc_caa' => 'Data di tolak manager',
				'create_date_caa' => date('Y-m-d H:i:s'),
				'status_caa' => 3,
			);

			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com';//TO AO
			}
	       	$subject = 'INFO PENOLAKAN';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<h4 style='font-family: verdana'>Permohonan Pinjaman dibawah ini tidak dapat di proses / di tolak </h4>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<p>catatan penolakan: $notes</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
			$this->sendEmail($toemail,$subject,$message);

			$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);
		}else{
			$whereTrack = array('id_order' => $this->input->post('id_order'));
			$dataTracking = array(
				'desc_caa' => 'Data di setujui manager dan di tolak ketua',
				'create_date_caa' => date('Y-m-d H:i:s'),
				'status_caa' => 3,
			);

			if ($ao_to_email == 'Kantor') {
				$toemail = 'arsyandi.ridho@gmail.com, fahmidion1@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Adi suyadi') {
				$toemail = 'adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Budiawan') {
				$toemail = 'budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Rediana Saputra') {
				$toemail = 'redianasaputra4@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'M.Yakub') {
				$toemail = 'mu.yakub99@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Lukman') {
				$toemail = 'lukmanubay16@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Putra Nia') {
				$toemail = 'putrania1972@gmail.com, adisuyadi.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Amirudin') {
				$toemail = 'muhamadamirudin78@gmail.com, budiawan.kdpms@gmail.com, Heinrichricky@gmail.com';//TO AO
			}else if ($ao_to_email == 'Bambang Setiawan') {
				$toemail = 'Faiyzajavier@gmail.com';//TO AO
			}
	       	$subject = 'INFO PENOLAKAN';
	       	$message = "
		    <div style='padding:2%;background-color:white;'>
			<center><img src='http://103.31.232.30/webtools-kdpms/assets/images/bussines.png' margin-left:2%;></center>
			</div>
			<h4 style='font-family: verdana'>Calon nasabah $ao_to_email ditolak manager</h4>
			<p>MARKETING : $ao_to_email</p>
			<p>Nama Calon debitur : $name_to_email</p>
			<p>NIK : $nik_to_email</p>
			<p>plafond : Rp. $plafond_to_email</p>
			<p>catatan penolakan: $notes</p>
			<br><br><br><br><br>
			<div style='background-color: #e4e4e4; padding: 10px; font-family: verdana;'>
				<center>
					<p>2018 Koperasi Dana Pinjaman Mandiri Sejahtera</p>
					<p>JL. KH Abdullah Bin Nuh Ruko No. 46C, Sindang Barang Bogor Barat - Kota Bogor</p>
				</center>
			</div>
		    ";
			$this->sendEmail($toemail,$subject,$message);

			$this->business->update_data('los_order_tracking',$dataTracking,$whereTrack);
		}

		$where = array('id_order' => $this->input->post('id_order'));
		$update = array('status_app' => '2','tgl_last_app' => date('Y-m-d H:i:s'));

		$statCaa = $this->business->update_data('los_caa',$update,$where);
		$queryReject = $this->business->add_data('los_caa_approval',$DataReject);

		if ($queryReject && $statCaa) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function checkApproveManager($id_order)
	{
		$where = array('id_order' => $id_order, 'status_app' => '1', 'jabatan' => 'manager');
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->result();
		echo json_encode($data);
	}

	public function checkRejectManager($id_order)
	{
		$where = array('id_order' => $id_order, 'status_app' => '2', 'jabatan' => 'manager');
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->result();
		echo json_encode($data);
	}

	public function checkApproveKetua($id_order)
	{
		$where = array('id_order' => $id_order, 'status_app' => '1', 'jabatan' => 'ketua');
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->result();
		echo json_encode($data);
	}

	public function checkRejectKetua($id_order)
	{
		$where = array('id_order' => $id_order, 'status_app' => '2', 'jabatan' => 'ketua');
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->result();
		echo json_encode($data);
	}

	public function DataApprove($id_order)
	{
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_caa_approval',null,null,$where)->result();
		echo json_encode($data);
	}

	public function get_DetailCAA($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_caa',null,null,$where)->result();
		$lengh = $this->business->get_where('los_caa',null,null,$where)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}


	/*LEGAL - OFFERING LATTER*/
	public function CaaApprovalOfferingLatter($value='')
	{
		$data = $this->business->CAAOfferingLatter()->result();
		$lengh = $this->business->CAAOfferingLatter()->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function checkOrderInOffering($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_offering_letter',null,null,$where)->num_rows();
		echo json_encode(array('amount' => $data));
	}

	public function OfferingLatter($value='')
	{
		$startlimit = $this->uri->segment(3);
		$areakerja = $this->uri->segment(4);
		$keysearch = $this->uri->segment(5);
		$data = $this->business->OfferingLatter($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->OfferingLatter($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function searchOffering($value='')
	{
		$startlimit = 0;
		$areakerja = $this->input->post('areakerja');
		$keysearch = $this->input->post('keyword');
		$data = $this->business->OfferingLatter($startlimit,$areakerja,$keysearch)->result();
		$lengh = $this->business->OfferingLatter($startlimit,$areakerja,$keysearch)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_DetailOffering($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_offering_letter',null,null,$where)->result();
		$lengh = $this->business->get_where('los_offering_letter',null,null,$where)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function get_DetailBiaya($value='')
	{
		$id_order = $this->uri->segment(3);
		$where = array('id_order' => $id_order);
		$data = $this->business->get_where('los_lpdk_biaya',null,null,$where)->result();
		$lengh = $this->business->get_where('los_lpdk_biaya',null,null,$where)->num_rows();
		if ($lengh == 0) {
			echo json_encode(array('amount' => $lengh));
		}else{
			echo json_encode($data);
		}
	}

	public function saveAddOffering($value='')
	{

		$tanggalTahun = date('Y-m-d');
		$split 		  = explode('-',$tanggalTahun);
		$bulan 		  = $split[1];
		$tahun 		  = $split[0];
		$bulanRomawi  = $this->getBulanRomawi($bulan);
		$nokantor 	  = $this->session->userdata('kantor');

		$jumdatalast = $this->business->getNOofferingLastData()->num_rows();
		if ($jumdatalast > 0) {
			$Nolast 	 = $this->business->getNOofferingLastData()->row();
			$tahunData	 = explode('-',$Nolast->tgl_buat)[0];
			$NolastApk   = explode('/',$Nolast->nomor)[0];
			if ($tahunData != $tahun) {
				$nofix = '000001';
			}else if ($tahunData == $tahunData) {
				$no = $NolastApk + 1;
				$nodef = '1000000';
				$nosub = $nodef + $no;
				$nofix = substr($nosub,1,7);
			}else{
				echo "ada yang ga beress";die();
			}
		}else{
			$nofix = '000001';
		}

		$nomor  = $nofix.'/KDPMS-'.$nokantor.'/'.$bulanRomawi.'/'.$tahun;
		$dataOffering = array(
			'id_order' => $this->input->post('id_order'),
			'nomor' => $nomor,
			'jenis_pinjaman' => $this->input->post('jenis_pinjaman'),
			'suku_bunga' => $this->input->post('suku_bunga'),
			'provisi' => $this->input->post('provisi'),
			'administrasi' => $this->input->post('administrasi'),
			'premi_ass_jiwa' => $this->input->post('premi_ass_jiwa'),
			'premi_ass_kebakaran' => $this->input->post('premi_ass_kebakaran'),
			'premi_ass_tlo' => $this->input->post('premi_ass_tlo'),
			'tabungan' => $this->input->post('tabungan'),
			'roya' => $this->input->post('roya'),
			'pelunasan' => $this->input->post('pelunasan'),
			'notaris' => $this->input->post('notaris'),
			'kreditchecking' => $this->input->post('kreditchecking'),
			'fidusia' => $this->input->post('fidusia'),
			'lain_lain' => $this->input->post('lain_lain'),
			'user_id' => $this->session->userdata('id'),
			'tgl_buat' => date('Y-m-d H:i:s')
		);

		$BiayaBiaya =array(
			'id_order' => $this->input->post('id_order'),
			'provisi' => $this->input->post('provisi'),
			'admin_kredit' => $this->input->post('admin_kredit'),
			'notaris' => $this->input->post('notaris'),
			'premi_ass_kredit' => $this->input->post('premi_ass_kredit'),
			'premi_ass_kebakaran' => $this->input->post('premi_ass_kebakaran'),
			'adendum' => $this->input->post('adendum'),
			'pelunasan' => $this->input->post('pelunasan'),
			'tabungan' => $this->input->post('tabungan'),
			'biaya_lain_lain' => $this->input->post('lain_lain'),
			'biaya_matrai' => $this->input->post('biaya_matrai'),
		);

		$queryOffering = $this->business->add_data('los_lpdk_biaya',$BiayaBiaya);
		$queryBiaya = $this->business->add_data('los_offering_letter',$dataOffering);

		if ($queryOffering && $queryBiaya) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function saveEditOffering(){
		$where = array(
			'id_order' => $this->input->post('id_order'),
		);

		$dataOffering = array(
			'nomor' => $this->input->post('nomor'),
			'jenis_pinjaman' => $this->input->post('jenis_pinjaman'),
			'suku_bunga' => $this->input->post('suku_bunga'),
			'provisi' => $this->input->post('provisi'),
			'administrasi' => $this->input->post('administrasi'),
			'premi_ass_jiwa' => $this->input->post('premi_ass_jiwa'),
			'premi_ass_kebakaran' => $this->input->post('premi_ass_kebakaran'),
			'premi_ass_tlo' => $this->input->post('premi_ass_tlo'),
			'tabungan' => $this->input->post('tabungan'),
			'roya' => $this->input->post('roya'),
			'pelunasan' => $this->input->post('pelunasan'),
			'notaris' => $this->input->post('notaris'),
			'kreditchecking' => $this->input->post('kreditchecking'),
			'fidusia' => $this->input->post('fidusia'),
			'lain_lain' => $this->input->post('lain_lain'),
			'no_telp' => $this->input->post('no_telp'),
			'keterangan' => $this->input->post('keterangan'),
			'user_id' => $this->session->userdata('id'),
			'tgl_buat' => date('Y-m-d H:i:s')
		);

		$BiayaBiaya =array(
			'id_order' => $this->input->post('id_order'),
			'provisi' => $this->input->post('provisi'),
			'admin_kredit' => $this->input->post('admin_kredit'),
			'notaris' => $this->input->post('notaris'),
			'premi_ass_kredit' => $this->input->post('premi_ass_kredit'),
			'premi_ass_kebakaran' => $this->input->post('premi_ass_kebakaran'),
			'adendum' => $this->input->post('adendum'),
			'pelunasan' => $this->input->post('pelunasan'),
			'tabungan' => $this->input->post('tabungan'),
			'biaya_lain_lain' => $this->input->post('lain_lain')
		);

		$queryOffering = $this->business->update_data('los_offering_letter',$dataOffering,$where);
		$queryBiaya = $this->business->update_data('los_lpdk_biaya',$BiayaBiaya,$where);

		if ($queryOffering && $queryBiaya) {
			echo json_encode(array('msg' => 'success'));
		}else{
			echo json_encode(array('msg' => 'failed'));
		}
	}

	public function getBulanRomawi($bulan)
	{
		$b = '';
		switch ($bulan) {
			case '01':
				return $b = "I";
			case '02':
				return $b = "II";
			case '03':
				return $b = "III";
			case '04':
				return $b = "IV";
			case '05':
				return $b = "V";
			case '06':
				return $b = "VI";
				break;
			case '07':
				return $b = "VII";
				break;
			case '08':
				return $b = "VIII";
				break;
			case '09':
				return $b = "IX";
				break;
			case '10':
				return $b = "X";
				break;
			case '11':
				return $b = "XI";
				break;
			default:
				return $b = "XII";
				break;
		}
	}

	public function changeDate($date)
	{
		$dateex = explode('-',$date);
		$return = '';
		switch ($dateex[1]) {
			case '01':
				return $return = $dateex[2]." Januari ".$dateex[0];
			case '02':
				return $return = $dateex[2]." Februari ".$dateex[0];
			case '03':
				return $return = $dateex[2]." Maret ".$dateex[0];
			case '04':
				return $return = $dateex[2]." April ".$dateex[0];
			case '05':
				return $return = $dateex[2]." Mei ".$dateex[0];
			case '06':
				return $return = $dateex[2]." Juni ".$dateex[0];
				break;
			case '07':
				return $return = $dateex[2]." Juli ".$dateex[0];
				break;
			case '08':
				return $return = $dateex[2]." Agustus ".$dateex[0];
				break;
			case '09':
				return $return = $dateex[2]." September ".$dateex[0];
				break;
			case '10':
				return $return = $dateex[2]." Oktober ".$dateex[0];
				break;
			case '11':
				return $return = $dateex[2]." November ".$dateex[0];
				break;
			default:
				return $return = $dateex[2]." Desember ".$dateex[0];
				break;
		}
	}
}

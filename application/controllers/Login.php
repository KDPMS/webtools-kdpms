<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_business','business');
	}

	public function index()
	{
		/*if ($this->session->userdata('status') == 'login') {
			return redirect(base_url('Home'));
		}else{*/
			$this->load->view('halamanlogin');
		//}
	}
	public function aksi_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data = array(
				'user' => $username,
				'password' => md5($password)
		);

		$cek = $this->business->cek_login("user",$data)->num_rows();
		$get = $this->business->cek_login("user",$data)->result();

		foreach ($get as $h) {
			$id = $h->user_id;
			$username = $h->user;
			$kantor = $h->kd_cabang;
			$jabatan = $h->jabatan;
		}

		$getFoto = $this->business->get_where("los_foto_user",null,null,array('user_id' => $id));

		if ($getFoto->num_rows() == 1) {
			$foto = base_url('assets/foto_profile/'.$getFoto->row()->foto_user);
		}else{
			$foto = base_url('assets/foto_profile/user.jpg');
		}

		if ($cek > 0) {

			$data_session = array(
				'id' => $id,
				'username' => $username,
				'jabatan' => $jabatan,
				'kantor' => $kantor,
				'status' => 'login',
				'foto' => $foto,
			);

			//print_r($data_session);die();
			$this->session->set_userdata($data_session);
			$this->session->set_flashdata('suksesLog','Selamat datang <n style="font-weight:bold;">'.$this->session->userdata('username').'</n>, berdoa lah sebelum melakukan pekerjaan');
			redirect(base_url('tools'));
		}else{
			$this->session->set_flashdata('errLog','Anda tidak mempunyai akses atau username dan password salah');
			redirect(base_url('login'));
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}
}

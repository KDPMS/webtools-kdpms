<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tools extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_business','business');
	}

	public function index()
	{
		if (!$this->session->userdata('status')) {
      return redirect(base_url('Login'));
		}else{
			$this->load->view('halamantool');
		}
  }
}
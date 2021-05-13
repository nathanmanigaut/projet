<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
        $this->load->view('/back/partial/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partial/nav');
		} else {
			$this->load->view('/front/partial/nav');
		}
		$this->load->view('/back/dashboard');
		$this->load->view('/back/partial/footer');
	}
}
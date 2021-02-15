<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
        $this->load->view('/back/partials/header');
		$this->load->view('/back/partials/nav');
		$this->load->view('/back/dashboard');
		$this->load->view('/back/partials/footer');
	}
}
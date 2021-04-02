<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actu extends CI_Controller {

	public function index()
	{
        $this->load->view('/front/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/front/actu');
		$this->load->view('/front/partials/footer');
	}
}
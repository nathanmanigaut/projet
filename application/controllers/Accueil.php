<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accueil extends CI_Controller {

	public function index()
	{
        $this->load->view('/front/partial/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partial/nav');
		} else {
			$this->load->view('/front/partial/nav');
		}
		$this->load->view('/front/accueil');
		$this->load->view('/front/partial/footer');
	}
}
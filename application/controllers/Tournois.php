<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournois extends CI_Controller {

	public function index()
	{
		$this->load->model('Tournament_model','tournoi');
		$this->load->model('Game_model','game');
        $this->load->view('/front/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/front/tournois');
		$this->load->view('/front/partials/footer');
	}

}
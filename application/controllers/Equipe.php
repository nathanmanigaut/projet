<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipe extends CI_Controller {

	public function index()
	{
		$this->load->model('Game_model','game');
		$this->load->model('Team_model','team');
        $this->load->view('/back/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/back/equipe');
		$this->load->view('/back/partials/footer');
	}

	public function add_team(){

		$this->load->model('Team_model','team');
		$user_id = $this->session->id;
		$name = $this->input->post('name');
		$jeux_id = $this->input->post('jeux_id');
		$date = date("Y-m-d H:i:s");
		if(!empty($name) && !empty($user_id) && !empty($jeux_id) && !empty($date)){
			$data = array(
				'captain_id' => $user_id,
				'name' => $name,
				'jeux_id' => $jeux_id,
				'date_create' => $date,
				'date_update' => $date,
			);
			$this->team->inserts($data);
		header('Location: http://localhost/projet/equipe');
		} else {
			echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			document.location.href='http://localhost/projet/equipe';</script>";
		}
	}

	public function update_team(){

		$this->load->model('Team_model','team');
		$user_id = $this->session->id;
		$key ='captain_id';
		$name = $this->input->post('name');
		$jeux_id = $this->input->post('jeux_id');
		$date = date("Y-m-d H:i:s");
		if(!empty($name) && !empty($user_id) && !empty($jeux_id) && !empty($date)){
			$data = array(
				'captain_id' => $user_id,
				'name' => $name,
				'jeux_id' => $jeux_id,
				'date_update' => $date,
			);
			$this->team->updates($data, $key, $user_id);
		header('Location: http://localhost/projet/equipe');
		} else {
			echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			window.location='http://localhost/projet/equipe';</script>";
		}
	}
}
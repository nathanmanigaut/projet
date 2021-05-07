<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournois extends CI_Controller {

	public function index()
	{
		//charge les models
		$this->load->model('Tournament_model','tournoi');
		$this->load->model('Game_model','game');

		//requêtes à la base de données
		$tournaments = $this->tournoi->orderbys('date_start','ASC');
		$games = $this->game->gets();
		//formatage de la date pour l'affichage
		foreach($tournaments->result() as $tournament){
			$date_start = date_create($tournament->date_start);
			$date_start = $date_start->format('d-m-Y\ à H:i');
		}
		//initialisation du tableau pour passer des donnéess à la view
		$data = array (
			'tournaments'=>$tournaments,
			'games'=>$games,
			'date_start' => $date_start,
		);
		//chargement des views
        $this->load->view('/front/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/front/tournois',$data);
		$this->load->view('/front/partials/footer');
	}

}
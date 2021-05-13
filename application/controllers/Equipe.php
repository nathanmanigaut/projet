<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Equipe extends CI_Controller {

	public function index()
	{
		//charge les models
		$this->load->model('Game_model','game');
		$this->load->model('Team_model','team');

		//requêtes à la base de données
		$user_id = $this->session->id;
		$teams = $this->team->selects('*', 'captain_id', $user_id);
		$games = $this->game->gets();

		//initialisation du tableau pour passer des donnéess à la view
		$query = array(
			'teams'=>$teams,
			'games'=>$games
		);

		//chargement des views si l'utilisateur est connecté
		if(isset($this->session->id)){
        $this->load->view('/back//header');
		$this->load->view('/back/partial/nav');
		$this->load->view('/front/partial/nav');
		$this->load->view('/back/equipe',$query);
		$this->load->view('/back/partial/footer');
	} else {
		echo"<script type='text/javascript'>alert('Veuillez vous connecté ou vous inscrire pour accéder a cette page');
			document.location.href='http://localhost/projet/login';</script>";
		}	
	}

	public function add_team(){
		//charge le model
		$this->load->model('Team_model','team');

		//récuperation des post
		$user_id = $this->session->id;
		$name = $this->input->post('name');
		$jeux_id = $this->input->post('jeux_id');
		$date = date("Y-m-d H:i:s");

		//vérification si tous les champs sont remplis
		if(!empty($name) && !empty($user_id) && !empty($jeux_id) && !empty($date)){

			//préparation de la requête
			$data = array(
				'captain_id' => $user_id,
				'name' => $name,
				'jeux_id' => $jeux_id,
				'date_create' => $date,
				'date_update' => $date,
			);

			//execution de la requête
			$this->team->inserts($data);

			//preparation d'une requête
			$key = 'captain_id';

			//execution de la requête
			$queryteam = $this->team->selects('*', $key, $user_id);
			foreach($queryteam->result() as $team){

				//insertion de l'id de l'équipe dans la session
				$this->session->set_userdata('team_id',$team->id);
			}	
			//message d'erreur + redirection
		header('Location: http://localhost/projet/equipe');
		} else {

			//message d'erreur + redirection
			echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			document.location.href='http://localhost/projet/equipe';</script>";
		}
	}

	public function update_team(){

		//charge le model
		$this->load->model('Team_model','team');
		
		//récuperation des post
		$name = $this->input->post('name');
		$jeux_id = $this->input->post('jeux_id');
		$date = date("Y-m-d H:i:s");

		//vérification si tous les champs sont remplis
		if(!empty($name)  && !empty($jeux_id) && !empty($date)){

			//preparation de la requête
			$data = array(
				'name' => $name,
				'jeux_id' => $jeux_id,
				'date_update' => $date,
			);
			$user_id = $this->session->id;
			$key ='captain_id';

			//execution de la requête
			$this->team->updates($data, $key, $user_id);

			//redirection
			header('Location: http://localhost/projet/equipe');
		} else {

			//message d'erreur + redirection
			echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			window.location='http://localhost/projet/equipe';</script>";
		}
	}
}
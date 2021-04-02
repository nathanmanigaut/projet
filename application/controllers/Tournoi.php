<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tournoi extends CI_Controller {

	public function index()
	{
		$this->load->model('Tournament_model','tournoi');
		$this->load->model('Game_model','game');
        $this->load->view('/back/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/back/tournoi');
		$this->load->view('/back/partials/footer');
	}

	public function display($id){

		$data = array(
			'id'=> $id
		);

		$this->load->model('Tournament_model','tournoi');
		$this->load->model('Game_model','game');
		$this->load->model('Registered_model','registered');
		$this->load->model('Team_model','team');
		$this->load->view('/front/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/front/tournoi',$data);
		$this->load->view('/front/partials/footer');
	}
	
	public function add_tournament(){

		$this->load->model('Tournament_model','tournoi');
		$user_id = $this->session->id;
		$name = $this->input->post('name');
		$jeux_id = $this->input->post('jeux_id');
		$date_start = $this->input->post('date_start');
		$max_team = $this->input->post('max_team');
		$min_team = $this->input->post('min_team');
		$date = date("Y-m-d H:i:s");
		$end = 0;
		if(!empty($name) && !empty($user_id) && !empty($jeux_id) && !empty($date_start) && !empty($date) && !empty($max_team) && !empty($min_team)){
			$data = array(
				'create_id' => $user_id,
				'name' => $name,
				'jeux_id' => $jeux_id,
				'date_start' => $date_start,
				'max_team' => $max_team,
				'min_team' => $min_team,
				'date_create' => $date,
				'date_update' => $date,
				'end' => $end,
			);
			$this->tournoi->inserts($data);
		header('Location: http://localhost/projet/tournoi');
		} else {
			echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			document.location.href='http://localhost/projet/tournoi';</script>";
		}
	}

	public function update_tournament(){

		$this->load->model('Tournament_model','tournoi');
		$user_id = $this->session->id;
		$key = 'create_id';
		$query = $this->tournoi->selects('*', $key, $user_id);

		foreach($query->result() as $tournament){
			
			$id = 'id';
			$name = $this->input->post('name');
			$jeux_id = $this->input->post('jeux_id');
			$date_start = $this->input->post('date_start');
			$max_team = $this->input->post('max_team');
			$min_team = $this->input->post('min_team');
			$date = date("Y-m-d H:i:s");
			$end = 0;
			$tournament_id = $tournament->id;
			if($min_team > $max_team){
				$message = "Le nombre minimum ne peut pas depasser le nombre maximum";
				echo"<script type='text/javascript'>alert('$message');
				window.location = 'http://localhost/projet/tournoi'</script>";
			} else {
				if(!empty($name) && !empty($user_id) && !empty($jeux_id) &&  !empty($date_start) && !empty($date) && !empty($max_team) && !empty($min_team)){
				
					$data = array(
						'create_id' => $user_id,
						'name' => $name,
						'jeux_id' => $jeux_id,
						'date_start' => $date_start,
						'max_team' => $max_team,
						'min_team' => $min_team,
						'date_update' => $date,
						'end' => $end,
					);
					$this->tournoi->updates($data, $id, $tournament_id);
					header('Location: http://localhost/projet/tournoi');
				}
				
				else {
					echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
					window.location='http://localhost/projet/tournoi';</script>";
				}
			}
			
		}
	}
	
	public function register_tournament(){
		$this->load->model('Registered_model','registered');
		$this->load->model('Tournament_model','tournoi');
		$this->load->model('Team_model','team');
		$tournament_id = $this->input->post('tournament_id');
		
		if(isset($this->session->team_id)){
			$team_id = $this->session->team_id;
		} else if(isset($this->session->id)) {
			echo"<script type='text/javascript'>alert('Veuillez créer une équipe pour participer au tournoi');
					window.location='http://localhost/projet/equipe';</script>";
		} else {
			echo"<script type='text/javascript'>alert('Veuillez créer un compte pour créer une équipe et participer au tournoi');
					window.location='http://localhost/projet/equipe';</script>";
		}
		$date = date("Y-m-d H:i:s");
		
		$key = 'id';
		$querytournament = $this->tournoi->selects('*', $key, $tournament_id);
		$queryteam = $this->team->selects('*', $key, $team_id);
		foreach($querytournament->result() as $tournoi){
			foreach($queryteam->result() as $team){
				if($tournoi->jeux_id == $team->jeux_id){
					if(!empty($tournament_id) && !empty($team_id) && !empty($date)){
						$data = array(
							'tournament_id' => $tournament_id,
							'team_id'=> $team_id,
							'date_inscription' => $date,
						);
						$this->registered->inserts($data);
						header('Location: http://localhost/projet/tournoi/display/'.$tournament_id);
					}
				} else {
					echo"<script type='text/javascript'>alert('Veuillez inscire une équipe du même jeu que le tournoi');
					window.location='http://localhost/projet/equipe';</script>";
				}

			}
		}

		
	}
}

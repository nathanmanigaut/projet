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
		$nb_team = $this->input->post('nb_team');
		$date = date("Y-m-d H:i:s");
		if(!empty($name) && !empty($user_id) && !empty($jeux_id) && !empty($date_start) && !empty($date) && !empty($nb_team)){
			$data = array(
				'create_id' => $user_id,
				'name' => $name,
				'jeux_id' => $jeux_id,
				'date_start' => $date_start,
				'nb_team' => $nb_team,
				'date_create' => $date,
				'date_update' => $date,
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
			$nb_team = $this->input->post('nb_team');
			$date = date("Y-m-d H:i:s");
			$tournament_id = $tournament->id;
				if(!empty($name) && !empty($user_id) && !empty($jeux_id) &&  !empty($date_start) && !empty($date) && !empty($nb_team)){
				
					$data = array(
						'create_id' => $user_id,
						'name' => $name,
						'jeux_id' => $jeux_id,
						'date_start' => $date_start,
						'nb_team' => $nb_team,
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
	
	public function register_tournament(){
		//On récupère tous les modèle dont on a besoin
		$this->load->model('Registered_model','registered');
		$this->load->model('Tournament_model','tournoi');
		$this->load->model('Team_model','team');
		$this->load->model('Match_model','match');
		//On récupère l'id du tournoi
		$tournament_id = $this->input->post('tournament_id');
		
		//on verrifie si l'utilisateur à bien créer une équipe
		if(isset($this->session->team_id)){
			$team_id = $this->session->team_id;
		} else if(isset($this->session->id)) {
		//on verifie si c'est bien un utilisateur connécté	
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
		$queryregister_team = $this->registered->selects2('*', 'team_id', $team_id, 'tournament_id', $tournament_id);
		$queryregister_tournament = $this->registered->selects('*', 'tournament_id', $tournament_id);
		foreach($querytournament->result() as $tournament){
			foreach($queryteam->result() as $team){
				if($queryregister_team->num_rows() >= 1){
						echo"<script type='text/javascript'>alert('Votre equipe est déjà inscrite au tournoi');
						window.location='http://localhost/projet/tournois/' ;</script>";
				}else {
					if($tournament->jeux_id == $team->jeux_id){
						if(!empty($tournament_id) && !empty($team_id) && !empty($date)){
							$data = array(
								'tournament_id' => $tournament_id,
								'team_id'=> $team_id,
								'date_inscription' => $date,
							);
							$this->registered->inserts($data);
							$queryregister_tournament = $this->registered->selects('*', 'tournament_id', $tournament_id);
							if($queryregister_tournament->num_rows() == $tournament->nb_team ){
								$array_team = array();
								foreach($queryregister_tournament->result() as $register){
									array_push($array_team, $register->team_id);
								}
								for($i = 0; $i < $tournament->nb_team-1 ;$i++){
									$data = array(
										'tournament_id' => $tournament->id,
										'date_start'=> $tournament->date_start,
										'date_create'=>$date,
										'date_update'=>$date,
									);
									if(!empty($array_team)){
										$random_key = array_rand($array_team,1);
										$data['team_1'] = $array_team[$random_key];
										foreach($array_team as $key => $value){
											if($data['team_1'] == $value){
												unset($array_team[$key]); 
											} 
										}
										$random_key = array_rand($array_team,1);
										$data['team_2'] = $array_team[$random_key];
										foreach($array_team as $key => $value){
											if($data['team_2'] == $value){
												unset($array_team[$key]); 
											} 
										}
									} 
									
									$this->match->inserts($data);
									print_r($array_team);
									header('Location: http://localhost/projet/tournoi/display/'.$tournament_id);
								}
							}else {
								header('Location: http://localhost/projet/tournoi/display/'.$tournament_id);
							}
						}
					} else {
							echo"<script type='text/javascript'>alert('Veuillez inscire une équipe du même jeu que le tournoi');
							window.location='http://localhost/projet/equipe';</script>";
					}	
				}	
			}		
		}
	}		
}
	

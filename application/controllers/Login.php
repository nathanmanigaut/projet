<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
        $this->load->view('/front/partials/header');
		if(isset($this->session->id)){
			$this->load->view('/back/partials/nav');
		} else {
			$this->load->view('/front/partials/nav');
		}
		$this->load->view('/front/login');
		$this->load->view('/front/partials/footer');
	}

	public function signin()
	{
		$email = $this->input->post('email');
		$pseudo = $this->input->post('name');
		$mdp = $this->input->post('password');
		$password = password_hash($mdp, PASSWORD_DEFAULT);
		$date = date("Y-m-d H:i:s");
		if(!empty($email) && !empty($pseudo) && !empty($mdp)){
			$data = array(
				'email' => $email,
				'pseudo' => $pseudo,
				'password'=> $password,
				'date_create'=> $date,
				'date_update'=> $date,
			);
			$this->load->model('User_model','user');
			$this->user->inserts($data);
			
		} else {
			echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
			document.location.href='http://localhost/projet/login';</script>";
		}
		echo"<script type='text/javascript'>alert('Bienvenue sur notre site, il vous faut se connecter pour acceder à nos services');
			document.location.href='http://localhost/projet/login/';</script>";
	}

	public function connect()
	{
		$name = $this->input->post('name');
		$password = $this->input->post('password');

		
		if(!empty($name) && !empty($password)){
			
			$key = 'pseudo';
			$this->load->model('User_model','user');
			$this->load->model('Team_model','team');
			$query = $this->user->selects('*', $key, $name);
					
				if($query->num_rows() == 1){

					foreach($query->result() as $user){

						if(password_verify($password,$user->password)){

							$user_id = $user->id;
							$key = 'captain_id';
							$queryteam = $this->team->selects('*', $key, $user_id);
							if($queryteam->num_rows() >= 1){
								foreach($queryteam->result() as $team){
									$userdata = array (
										'id' => $user->id,
										'name' => $user->pseudo,
										'team_id'=> $team->id,
									);
								}
							} else {
								$userdata = array (
									'id' => $user->id,
									'name' => $user->pseudo,
								);
								session_start();
								$this->session->set_userdata($userdata);
								header('Location: http://localhost/projet/dashboard/');
							}
							session_start();
							$this->session->set_userdata($userdata);
							header('Location: http://localhost/projet/dashboard/');
							
						} else {
							echo"<script type='text/javascript'>alert('merci de renseigner un utilisateur ou mot de passe valide');
								document.location.href='http://localhost/projet/login';</script>";
						}
					}	
				} else {
					echo"<script type='text/javascript'>alert('merci de renseigner un utilisateur ou mot de passe valide');
						document.location.href='http://localhost/projet/login';</script>";
				} 
			    
		} else {
			echo"<script type='text/javascript'>alert('merci de renseigner un utilisateur ou mot de passe');
				document.location.href='http://localhost/projet/login';</script>";
		}
	}

	public function signout()
	{
		$this->session->sess_destroy();
		header('Location: http://localhost/projet/login/');
	}
}
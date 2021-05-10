<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function index()
	{
		//chargement des views
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
		//chargement du model 
		$this->load->model('User_model','user');

		//récupération des posts
		$email = $this->input->post('email');
		$pseudo = $this->input->post('name');
		$mdp = $this->input->post('password');
		$mdp_confirm = $this->input->post('password_confirm');
		$date = date("Y-m-d H:i:s");
			
			//verification si tous les champs sont remplis
			if(!empty($email) && !empty($pseudo) && !empty($mdp) && !empty($mdp_confirm)){
				if($mdp == $mdp_confirm){
					$password = password_hash($mdp, PASSWORD_DEFAULT);
					
					//préparation de la requête
				$data = array(
					'email' => $email,
					'pseudo' => $pseudo,
					'password'=> $password,
					'date_create'=> $date,
				);
				
				//execution de la requête
				$this->user->inserts($data);
				
				}else {
					//message d'erreur + redirection
					echo"<script type='text/javascript'>alert('Veuillez saisir deux mot de passe identique');
					document.location.href='http://localhost/projet/login';</script>";
				}
			}else{
				//message d'erreur + redirection
				echo"<script type='text/javascript'>alert('Veuillez remplir tous les champs');
				document.location.href='http://localhost/projet/login/';</script>";
			}
		

		//message de validation + redirection
		echo"<script type='text/javascript'>alert('Bienvenue sur notre site, il vous faut se connecter pour acceder à nos services');
			document.location.href='http://localhost/projet/login/';</script>";
	}

	public function connect()
	{

		//chargement des models
		$this->load->model('User_model','user');
		$this->load->model('Team_model','team');

		//récupération des posts
		$name = $this->input->post('name');
		$password = $this->input->post('password');

		//vérification si tous les champs sont remplis
		if(!empty($name) && !empty($password)){
			
			//préparation requête
			$key = 'pseudo';

			//execution requête
			$query = $this->user->selects('*', $key, $name);
					
				//vérification que l'utilisateur existe
				if($query->num_rows() == 1){

					foreach($query->result() as $user){

						//vérification que le mot de passe est bon
						if(password_verify($password,$user->password)){

							//préparation de la requête
							$user_id = $user->id;
							$key = 'captain_id';

							//execution de la requête
							$queryteam = $this->team->selects('*', $key, $user_id);

							//on verifie si l'utilisateur a une équipe
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
								//on commence une session
								session_start();

								//on insère les données de l'utilisateur dans la session
								$this->session->set_userdata($userdata);
								header('Location: http://localhost/projet/dashboard/');
							}
							//on commence une session
							session_start();

							//on insère les données de l'utilisateur dans la session
							$this->session->set_userdata($userdata);

							//redirection
							header('Location: http://localhost/projet/dashboard/');
							
						} else {
							//message d'erreur + redirection
							echo"<script type='text/javascript'>alert('merci de renseigner un utilisateur ou mot de passe valide');
								document.location.href='http://localhost/projet/login';</script>";
						}
					}	
				} else {
					//message d'erreur + redirection
					echo"<script type='text/javascript'>alert('merci de renseigner un utilisateur ou mot de passe valide');
						document.location.href='http://localhost/projet/login';</script>";
				} 
			    
		} else {
			//message d'erreur + redirection
			echo"<script type='text/javascript'>alert('merci de renseigner un utilisateur ou mot de passe');
				document.location.href='http://localhost/projet/login';</script>";
		}
	}

	public function signout()
	{
		//on détruit la session
		$this->session->sess_destroy();

		//redirection
		header('Location: http://localhost/projet/login/');
	}
}